<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Yajra\DataTables\Facades\DataTables;

class TeamMemberController extends Controller
{
    // Show all team members (for frontend website)
    public function showTeam()
    {
        $teamMembers = TeamMember::where('status', 'live')
            ->orderBy('sorting', 'asc')
            ->get();
        return view('your-team-section-blade', compact('teamMembers'));
    }

    // Show admin list page
    public function index()
    {
        return view('Dashboard.Pages.team-members');
    }

    // DataTable AJAX: admin listing
    public function data(Request $request)
    {
        $query = TeamMember::query();

        return DataTables::of($query)
            ->addIndexColumn()

            ->editColumn('image', function($row) {
            return $row->image ? asset($row->image) : '';
        })
            ->editColumn('status', function($row) {
                return ucfirst($row->status);
            })
            ->addColumn('action', function($row) {
                $rowJson = base64_encode(json_encode([
                    'id' => $row->id,
                    'image' => $row->image,
                    'name' => $row->name,
                    'designation' => $row->designation,
                    'status' => $row->status,
                    'sorting' => $row->sorting,
                ]));
                $editBtn = '<button class="btn btn-primary btn-sm edit" data-row="'.$rowJson.'"><i class="fa fa-edit"></i> Edit</button> ';
                if ($row->status === 'live') {
                    $statusBtn = '<button class="btn btn-danger btn-sm" onclick="Disable('.$row->id.')">Disable</button>';
                } else {
                    $statusBtn = '<button class="btn btn-success btn-sm" onclick="Enable('.$row->id.')">Enable</button>';
                }
                return $editBtn . $statusBtn;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }

    // Admin: Store new member
    public function save(Request $request)
    {
        $action = $request->input('action');
        $id = $request->input('id');

        if ($action === 'insert') {
            $request->validate([
                'name' => 'required|string|max:100',
                'designation' => 'required|string|max:100',
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
            $data = $request->only(['name', 'designation', 'status', 'sorting']);
            if ($request->hasFile('image')) {
                // Optionally delete the old file
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
