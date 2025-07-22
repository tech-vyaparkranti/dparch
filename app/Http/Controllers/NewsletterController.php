<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;



class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:subscribers,email',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        Subscriber::create([
            'email' => $request->email
        ]);

        return response()->json(['success' => 'Thank you for subscribing!']);
    }

    public function datatable(Request $request)
{
    if ($request->ajax()) {
        $data = Subscriber::select(['id', 'email', 'created_at']);

        return datatables()->of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)
                    ->timezone('Asia/Kolkata')
                    ->format('d M Y, h:i A');
            })
            ->make(true);
    }
}
}

