<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUsModel;
use App\Traits\CommonFunctions;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;



class ContactUsController extends Controller
{
    use CommonFunctions;
    use ResponseAPI;
    // public function saveContactUsDetails(ContactUsRequest $request){
    //     try{
    //         $check = ContactUsModel::where([
    //             [ContactUsModel::EMAIL,$request->input(ContactUsModel::EMAIL)],
    //             [ContactUsModel::PHONE_NUMBER,$request->input(ContactUsModel::PHONE_NUMBER)],
    //         ])->whereRaw("date(created_at)=date(now())")->first();
    //         if($check){
    //             $response = $this->error("You alread sent a message for today.");
    //         }else{
    //             $newContactUs = new ContactUsModel();
    //             $newContactUs->{ContactUsModel::FIRST_NAME} = $request->input(ContactUsModel::FIRST_NAME);
    //             $newContactUs->{ContactUsModel::LAST_NAME} = $request->input(ContactUsModel::LAST_NAME);
    //             $newContactUs->{ContactUsModel::EMAIL} = $request->input(ContactUsModel::EMAIL);
    //             $newContactUs->{ContactUsModel::COUNTRY_CODE} = $request->input(ContactUsModel::COUNTRY_CODE);
    //             $newContactUs->{ContactUsModel::PHONE_NUMBER} = $request->input(ContactUsModel::PHONE_NUMBER);
    //             $newContactUs->{ContactUsModel::MESSAGE} = $request->input(ContactUsModel::MESSAGE);
    //             $newContactUs->{ContactUsModel::IP_ADDRESS} = $this->getIp();
    //             $newContactUs->{ContactUsModel::USER_AGENT} = $request->userAgent();
    //             $newContactUs->save();
    //             $this->sendContactUsEmail($newContactUs);
    //             $response = $this->success("Thank you for your message. We will contact you shortly.",[]);
    //         }
    //     }catch(Exception $exception){
    //         report($exception);
    //         $response = $this->error("Something went wrong. ".$exception->getMessage());
    //     }
    //     return response()->json($response);
    // }

    public function saveContactUsDetails(ContactUsRequest $request): JsonResponse
{
    try {
        // Check if user already submitted today
        $check = ContactUsModel::where([
            [ContactUsModel::EMAIL, $request->input(ContactUsModel::EMAIL)],
            [ContactUsModel::PHONE_NUMBER, $request->input(ContactUsModel::PHONE_NUMBER)],
        ])
        ->whereRaw("date(created_at) = date(now())")
        ->first();
        
        if ($check) {
            return response()->json([
                'status' => false,
                'message' => 'You have already sent a message today. Please try again tomorrow.'
            ], 200); // Use 200 status code for business logic errors
        }
        
        // Create new contact entry
        $newContactUs = new ContactUsModel();
        $newContactUs->{ContactUsModel::FIRST_NAME} = $request->input(ContactUsModel::FIRST_NAME);
        $newContactUs->{ContactUsModel::LAST_NAME} = $request->input(ContactUsModel::LAST_NAME);
        $newContactUs->{ContactUsModel::EMAIL} = $request->input(ContactUsModel::EMAIL);
        $newContactUs->{ContactUsModel::COUNTRY_CODE} = $request->input(ContactUsModel::COUNTRY_CODE);
        $newContactUs->{ContactUsModel::PHONE_NUMBER} = $request->input(ContactUsModel::PHONE_NUMBER);
        $newContactUs->{ContactUsModel::MESSAGE} = $request->input(ContactUsModel::MESSAGE);
        $newContactUs->{ContactUsModel::IP_ADDRESS} = $this->getIp();
        $newContactUs->{ContactUsModel::USER_AGENT} = $request->userAgent();
        
        if (!$newContactUs->save()) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to save your message. Please try again.'
            ], 500);
        }
        
        // Send email (wrap in try-catch to prevent email failures from breaking the flow)
        try {
            $this->sendContactUsEmail($newContactUs);
        } catch (\Exception $emailException) {
            // Log email error but don't break the flow
            \Log::error('Contact form email failed: ' . $emailException->getMessage());
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Thank you for your message. We will contact you shortly.'
        ]);
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        return response()->json([
            'status' => false,
            'message' => 'Please check your form data.',
            'errors' => $e->errors()
        ], 422);
        
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Contact form error: ' . $e->getMessage());
        
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong. Please try again later.'
        ], 500);
    }
}


    public function manageContactUs(){
        return view("Dashboard.Pages.manageContactUs");
    }

    public function ContactUsData(){


        $query = ContactUsModel::select(
            ContactUsModel::FIRST_NAME,
            ContactUsModel::LAST_NAME,
            ContactUsModel::EMAIL,
            ContactUsModel::COUNTRY_CODE,
            ContactUsModel::PHONE_NUMBER,
            ContactUsModel::MESSAGE,
            ContactUsModel::IP_ADDRESS,
            ContactUsModel::ID,
            DB::raw("date_format(".ContactUsModel::CREATED_AT.", '%M %d %Y %r') as created_at_date")
        );
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }
}
