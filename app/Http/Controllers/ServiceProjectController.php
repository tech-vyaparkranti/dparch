<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Traits\CommonFunctions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ServiceProjectController extends Controller
{
    use CommonFunctions;

    public function index()
    {
        return view("Dashboard.Pages.ourServicesAdmin");
    }

    public function saveOurServicesMaster(ServiceRequest $request)
    {
        Cache::forget("service_projects");
        switch ($request->input("action")) {
            case "insert":
                $return = $this->insertData($request);
                break;
            case "update":
                $return = $this->updateData($request);
                break;
            case "enable":
                $return = $this->enableRow($request);
                break;
            case "disable":
                $return = $this->disableRow($request);
                break;
            default:
                $return = ["status" => false, "message" => "Unknown action.", "data" => null];
        }
        return response()->json($return);
    }

    public function ImageUpload(ServiceRequest $request)
    {
        $maxId = Service::max(Service::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request, Service::SERVICE_IMAGE, "/website/uploads/service_images/", "service_image_$maxId");
    }
    public function insertData(ServiceRequest $request)
    {
        $checkDuplicate = Service::where(Service::SERVICE_NAME, $request->input(Service::SERVICE_NAME))->first();

        if ($checkDuplicate) {
            $return = $this->returnMessage("Service name is already taken");
        } else {
            $image_url = "";
            $imageUpload = $this->ImageUpload($request);
            if ($imageUpload["status"]) {
                $image_url = $imageUpload["data"];
            } else {
                return $imageUpload;
            }
            $createNewRow = new Service();
            $createNewRow->{Service::SERVICE_NAME} = $request->input(Service::SERVICE_NAME);
            $createNewRow->{Service::SERVICE_IMAGE} = $image_url;
            $createNewRow->{Service::POSITION} = $request->input(Service::POSITION);
            $createNewRow->{Service::STATUS} = $request->status;
            $createNewRow->save();
            $return = $this->returnMessage("Saved successfully.", true);
        }
        return $return;
    }

    public function  updateData(ServiceRequest $request)
    {
        $checkDuplicate = Service::where([
            [Service::SERVICE_NAME, $request->input(Service::SERVICE_NAME)],
            [Service::ID, "<>", $request->input(Service::ID)]
        ])->first();

        if ($checkDuplicate) {
            $return = $this->returnMessage("Service name is already taken");
        } else {
            $updateModel = Service::find($request->input(Service::ID));
            $image_url = $updateModel->{Service::SERVICE_IMAGE};
            if($request->file(Service::SERVICE_IMAGE)){
                $imageUpload = $this->ImageUpload($request);
                if ($imageUpload["status"]) {
                    $image_url = $imageUpload["data"];
                } else {
                    return $imageUpload;
                }
            }          
            
            
            $updateModel->{Service::SERVICE_NAME} = $request->input(Service::SERVICE_NAME);
            $updateModel->{Service::SERVICE_IMAGE} = $image_url;
            $updateModel->{Service::POSITION} = $request->input(Service::POSITION);
            $updateModel->{Service::STATUS} = $request->status;
            $updateModel->save();
            $return = $this->returnMessage("Saved successfully.", true);
        }
        return $return;
    }

    public function enableRow(ServiceRequest $request)
    {
        $check = Service::where(Service::ID, $request->input(Service::ID))->first();
        if ($check) {
            $check->{Service::STATUS} = 'live';
            $check->save();
             
            $return = $this->returnMessage("Enabled successfully.", true);
        } else {
            $return = $this->returnMessage("Details not found.");
        }
        return $return;
    }

    public function disableRow(ServiceRequest $request)
    {
        $check = Service::where(Service::ID, $request->input(Service::ID))->first();
        if ($check) {
            $check->{Service::STATUS} = "disable";
            $check->save();
             
            $return = $this->returnMessage("Disabled successfully.", true);
        } else {
            $return = $this->returnMessage("Details not found.");
        }
        return $return;
    }

    // public function ourServicesData()
    // {

    //     $query = Service::select(
    //         'service_name',
    //     'image',
    //     'status',
    //     'sorting','id'
    //     );
    //     return DataTables::of($query)
    //         ->addIndexColumn()
    //         ->addColumn('action', function ($row) {
    //             $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm mt-2">Edit</a>';

    //             $btn_disable = ' <a   href="javascript:void(0)" onclick="Disable(' . $row->id . ')" class="btn btn-danger btn-sm mt-2">Disable</a>';
    //             $btn_enable = ' <a   href="javascript:void(0)" onclick="Enable(' . $row->id . ')" class="btn btn-primary btn-sm mt-2">Live</a>';
    //             if ($row->status == "live") {
    //                 return $this->addDiv($btn_edit . $btn_disable);
    //             } else {
    //                 return $this->addDiv($btn_edit . $btn_enable);
    //             }
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }
    public function ourServicesData()
    {
        $query = Service::select(
            'service_name',
            'image',
            'status',
            'sorting',
            'id'
        );

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $row_json = base64_encode(json_encode($row->toArray()));

                $btn_edit = '<a data-row="' . $row_json . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm mt-2">Edit</a>';
                $btn_disable = '<a href="javascript:void(0)" onclick="Disable(' . $row->id . ')" class="btn btn-danger btn-sm mt-2">Disable</a>';
                $btn_enable = '<a href="javascript:void(0)" onclick="Enable(' . $row->id . ')" class="btn btn-primary btn-sm mt-2">Live</a>';

                return $this->addDiv($btn_edit . ($row->status == 'live' ? $btn_disable : $btn_enable));
            })
            ->rawColumns(['action'])
            ->make(true);
    }


}
