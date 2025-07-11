<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhyChooseUs;
use Yajra\DataTables\Facades\DataTables;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        return view('Dashboard.Pages.why-choose-us');
    }

   public function data(Request $request)
{
    $query = WhyChooseUs::query();

    return DataTables::of($query)
        ->addIndexColumn()
        ->editColumn('icon', function($row) {
            return $row->icon ? asset($row->icon) : '';
        })
        ->editColumn('status', function($row) {
            return ucfirst($row->status);
        })
        ->addColumn('action', function ($row) {
            $rowJson = base64_encode(json_encode([
                'id' => $row->id,
                'icon' => $row->icon,
                'title' => $row->title,
                'status' => $row->status,
                'sorting' => $row->sorting,
            ]));
$editBtn = '<button class="btn btn-primary btn-sm edit" data-row="'.$rowJson.'">
        <i class="fa fa-edit"></i> Edit
    </button> ';
                if ($row->status === 'live') {
                $statusBtn = '<button class="btn btn-danger btn-sm" onclick="Disable('.$row->id.')">Disable</button>';
            } else {
                $statusBtn = '<button class="btn btn-success btn-sm" onclick="Enable('.$row->id.')">Enable</button>';
            }
            return $editBtn . $statusBtn;
        })
        ->rawColumns(['action']) // Only 'action' returns HTML
        ->make(true);
}


    public function save(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');

        if ($action === 'insert') {
            $request->validate([
                'icon'    => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
                'title'   => 'required|string|max:255',
                'status'  => 'required|in:live,disabled',
                'sorting' => 'nullable|integer'
            ]);
            $iconPath = null;
            if($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('uploads/whychooseus', 'public');
                $iconPath = '/storage/' . $iconPath;
            }
            WhyChooseUs::create([
                'icon'    => $iconPath,
                'title'   => $request->title,
                'status'  => $request->status,
                'sorting' => $request->sorting,
            ]);
            return response()->json(['status' => true, 'message' => 'Added successfully']);
        } elseif ($action === 'update') {
            $row = WhyChooseUs::find($id);
            if (!$row) {
                return response()->json(['status' => false, 'message' => 'Record not found']);
            }
            $data = $request->only(['title', 'status', 'sorting']);
            if($request->hasFile('icon')) {
                // Optionally delete the old file
                if($row->icon && file_exists(public_path($row->icon))){
                    @unlink(public_path($row->icon));
                }
                $iconPath = $request->file('icon')->store('uploads/whychooseus', 'public');
                $data['icon'] = '/storage/' . $iconPath;
            }
            $row->update($data);
            return response()->json(['status' => true, 'message' => 'Updated successfully']);
        } elseif ($action === 'enable') {
            $row = WhyChooseUs::find($id);
            if ($row) {
                $row->status = 'live';
                $row->save();
                return response()->json(['status' => true, 'message' => 'Enabled successfully']);
            }
        } elseif ($action === 'disable') {
            $row = WhyChooseUs::find($id);
            if ($row) {
                $row->status = 'disabled';
                $row->save();
                return response()->json(['status' => true, 'message' => 'Disabled successfully']);
            }
        }

        return response()->json(['status' => false, 'message' => 'Invalid action']);
    }
}

