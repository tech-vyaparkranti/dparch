<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Yajra\DataTables\Facades\DataTables;

class TeamMemberController extends Controller
{
    public function index()
    {
        return view('Dashboard.Pages.team-members');
    }

    public function data(Request $request)
    {
        $query = TeamMember::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return $row->image ? asset($row->image) : '';
            })
            ->editColumn('status', function ($row) {
                return ucfirst($row->status);
            })
            ->addColumn('action', function ($row) {
                $rowJson = base64_encode(json_encode([
                    'id' => $row->id,
                    'image' => $row->image,
                    'name' => $row->name,
                    'designation' => $row->designation,
                    'short_description' => $row->short_description,
                    'status' => $row->status,
                    'sorting' => $row->sorting,
                ]));
                $editBtn = '<button class="btn btn-primary btn-sm edit" data-row="' . $rowJson . '"><i class="fa fa-edit"></i> Edit</button> ';
                $statusBtn = $row->status === 'live'
                    ? '<button class="btn btn-danger btn-sm" onclick="Disable(' . $row->id . ')">Disable</button>'
                    : '<button class="btn btn-success btn-sm" onclick="Enable(' . $row->id . ')">Enable</button>';
                return $editBtn . $statusBtn;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }

    public function save(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');

        if ($action === 'insert') {
            $request->validate([
                'name' => 'required|string|max:100',
                'designation' => 'required|string|max:100',
                'short_description' => 'nullable|string|max:500',
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'status' => 'required|in:live,disabled',
                'sorting' => 'nullable|integer'
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/team', 'public');
                $imagePath = '/storage/' . $imagePath;
            }

            TeamMember::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'short_description' => $request->short_description,
                'image' => $imagePath,
                'status' => $request->status,
                'sorting' => $request->sorting ?? 0,
            ]);

            return response()->json(['status' => true, 'message' => 'Added successfully']);

        } elseif ($action === 'update') {
            $row = TeamMember::find($id);
            if (!$row) {
                return response()->json(['status' => false, 'message' => 'Record not found']);
            }

            $data = $request->only(['name', 'designation', 'short_description', 'status', 'sorting']);

            if ($request->hasFile('image')) {
                if ($row->image && file_exists(public_path($row->image))) {
                    @unlink(public_path($row->image));
                }
                $imagePath = $request->file('image')->store('uploads/team', 'public');
                $data['image'] = '/storage/' . $imagePath;
            }

            $row->update($data);
            return response()->json(['status' => true, 'message' => 'Updated successfully']);

        } elseif ($action === 'enable') {
            $row = TeamMember::find($id);
            if ($row) {
                $row->status = 'live';
                $row->save();
                return response()->json(['status' => true, 'message' => 'Enabled successfully']);
            }

        } elseif ($action === 'disable') {
            $row = TeamMember::find($id);
            if ($row) {
                $row->status = 'disabled';
                $row->save();
                return response()->json(['status' => true, 'message' => 'Disabled successfully']);
            }
        }

        return response()->json(['status' => false, 'message' => 'Invalid action']);
    }
}
