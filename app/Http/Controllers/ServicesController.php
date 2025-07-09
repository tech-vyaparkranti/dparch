<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicesRequest;
use App\Models\ServicesModel;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactUsModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    use CommonFunctions;
    //

    public function servicesSlider(){
        return view("Dashboard.Pages.services");
    }

    public function servicesData(){
        $query = ServicesModel::select(ServicesModel::IMAGE,
        ServicesModel::ID,
        ServicesModel::HEADING_TOP,
        ServicesModel::HEADING_BOTTOM,
        ServicesModel::HEADING_MIDDLE,
        ServicesModel::SLIDE_SORTING,
        ServicesModel::SLIDE_STATUS);
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row){
                $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                
                $btn_disable = ' <a   href="javascript:void(0)" onclick="Disable('.$row->{ServicesModel::ID}.')" class="btn btn-danger btn-sm">Disable Slide</a>';
                $btn_enable = ' <a   href="javascript:void(0)" onclick="Enable('.$row->{ServicesModel::ID}.')" class="btn btn-primary btn-sm">Enable Slide</a>';
                if($row->{ServicesModel::SLIDE_STATUS}==ServicesModel::SLIDE_STATUS_DISABLED){
                    return $btn_edit.$btn_enable;
                }else{
                    return $btn_edit.$btn_disable;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function servicesSaveSlide(ServicesRequest $request){
        try{
            switch($request->input("action")){
                case "insert":
                    $return = $this->insertSlide($request);
                    break;
                case "update":
                    $return = $this->updateSlide($request);
                    break;
                case "enable":
                case "disable":
                    $return = $this->enableDisableSlide($request);
                    break;
                default:
                $return = ["status"=>false,"message"=>"Unknown case","data"=>""];
            }
        }catch(Exception $exception){
            $return = $this->reportException($exception);
        }
        return response()->json($return);
    }

    public function insertSlide(ServicesRequest $request){
        $imageUpload = $this->slideImageUpload($request);
        if($imageUpload["status"]){
            $ServicesModel = new ServicesModel();
            $ServicesModel->{ServicesModel::IMAGE} = $imageUpload["data"];
            $ServicesModel->{ServicesModel::HEADING_TOP} = $request->input(ServicesModel::HEADING_TOP);
            $ServicesModel->{ServicesModel::HEADING_MIDDLE} = $request->input(ServicesModel::HEADING_MIDDLE);
            $ServicesModel->{ServicesModel::HEADING_BOTTOM} = $request->input(ServicesModel::HEADING_BOTTOM);
            $ServicesModel->{ServicesModel::SLIDE_STATUS} = $request->input(ServicesModel::SLIDE_STATUS);
            $ServicesModel->{ServicesModel::SLIDE_SORTING} = $request->input(ServicesModel::SLIDE_SORTING);           
            $ServicesModel->{ServicesModel::STATUS} = 1;
            $ServicesModel->{ServicesModel::CREATED_BY} = Auth::user()->id;
            $ServicesModel->save();
            $return = ["status"=>true,"message"=>"Saved successfully","data"=>null];
            $this->forgetSlides();
        }else{
            $return = $imageUpload;
        }
        return $return;
    }

    public function slideImageUpload(ServicesRequest $request){
        $maxId = ServicesModel::max(ServicesModel::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request,"image","/website/uploads/Slider/","slide_$maxId");
    }

    public function updateSlide(ServicesRequest $request){
        $check = ServicesModel::where([ServicesModel::ID=>$request->input(ServicesModel::ID),ServicesModel::STATUS=>1])->first();
        if($check){
            if($request->input(ServicesModel::IMAGE)){
                $imageUpload =$this->slideImageUpload($request);
                if($imageUpload["status"]){
                    $check->{ServicesModel::IMAGE} = $imageUpload["data"];
                    $check->{ServicesModel::SLIDE_SORTING} = $request->input(ServicesModel::SLIDE_SORTING);
                    $check->{ServicesModel::HEADING_TOP} = $request->input(ServicesModel::HEADING_TOP);
                    $check->{ServicesModel::HEADING_MIDDLE} = $request->input(ServicesModel::HEADING_MIDDLE);
                    $check->{ServicesModel::HEADING_BOTTOM} = $request->input(ServicesModel::HEADING_BOTTOM);
                    $check->{ServicesModel::SLIDE_STATUS} = $request->input(ServicesModel::SLIDE_STATUS);
                    $check->{ServicesModel::UPDATED_BY} = Auth::user()->id;
                    $check->save();
                    $this->forgetSlides();
                    $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];
                }else{
                    $return = $imageUpload;
                }
            }else{
                $check->{ServicesModel::SLIDE_SORTING} = $request->input(ServicesModel::SLIDE_SORTING);
                $check->{ServicesModel::HEADING_TOP} = $request->input(ServicesModel::HEADING_TOP);
                $check->{ServicesModel::HEADING_MIDDLE} = $request->input(ServicesModel::HEADING_MIDDLE);
                $check->{ServicesModel::HEADING_BOTTOM} = $request->input(ServicesModel::HEADING_BOTTOM);
                $check->{ServicesModel::SLIDE_STATUS} = $request->input(ServicesModel::SLIDE_STATUS);
                $check->{ServicesModel::UPDATED_BY} = Auth::user()->id;
                $check->save();
                $this->forgetSlides();
                $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];            
            }
        }else{
            $return = ["status"=>false,"message"=>"Details not found.","data"=>null];
        }
        return $return;
    }

    // public function enableDisableSlide(ServicesRequest $request){
    //     $check = ServicesModel::find($request->input(ServicesModel::ID));
    //     if($check){
    //         $check->{ServicesModel::UPDATED_BY} = Auth::user()->id;
    //         if($request->input("action")=="enable"){
    //             $check->{ServicesModel::SLIDE_STATUS} = ServicesModel::SLIDE_STATUS_LIVE;
    //             $return = ["status"=>true,"message"=>"Enabled successfully.","data"=>""];
    //         }else{
    //             $check->{ServicesModel::SLIDE_STATUS} = ServicesModel::SLIDE_STATUS_DISABLED;
    //             $return = ["status"=>true,"message"=>"Disabled successfully.","data"=>""];
    //         }
    //         $this->forgetSlides();
    //         $check->save();
    //     }else{
    //         $return = ["status"=>false,"message"=>"Details not found.","data"=>""];
    //     }
    //     return $return;
    // }
    public function enableDisableSlide(ServicesRequest $request) {
        $check = ServicesModel::find($request->input(ServicesModel::ID));
        
        if ($check) {
            $check->{ServicesModel::UPDATED_BY} = Auth::user()->id;
            
            if ($request->input("action") == "enable") {
                $check->{ServicesModel::SLIDE_STATUS} = ServicesModel::SLIDE_STATUS_LIVE;
                $return = ["status" => 1, "message" => "Enabled successfully.", "data" => ""];
            } else {
                $check->{ServicesModel::SLIDE_STATUS} = ServicesModel::SLIDE_STATUS_DISABLED;
                $return = ["status" => 1, "message" => "Disabled successfully.", "data" => ""];
            }
            
            $this->forgetSlides();
            $check->save();
        } else {
            $return = ["status" => 0, "message" => "Details not found.", "data" => ""];
        }
        
        return $return;
    }
    

    public function managecontactdata(Request $request)
{
    if ($request->ajax()) {
        $data = ContactUsModel::query();

        // If no data, add 2 static dummy rows
        if ($data->count() == 0) {
            $static = collect([
                [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john@example.com',
                    'country_code' => '+1',
                    'phone_number' => '1234567890',
                    'message' => 'This is a static message.',
                    'ip_address' => '127.0.0.1',
                    'user_agent' => 'Static UA',
                    'status' => 'new',
                    'created_at' => now(),
                ],
                [
                    'first_name' => 'Jane',
                    'last_name' => 'Smith',
                    'email' => 'jane@example.com',
                    'country_code' => '+44',
                    'phone_number' => '9876543210',
                    'message' => 'Another static message.',
                    'ip_address' => '192.168.1.1',
                    'user_agent' => 'Static UA 2',
                    'status' => 'read',
                    'created_at' => now(),
                ],
            ]);

            return DataTables::of($static)
                ->addIndexColumn()
                ->make(true);
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    abort(403);
}
}
