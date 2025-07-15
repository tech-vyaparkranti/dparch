<?php

namespace App\Http\Controllers;

use App\Models\ServicesModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    public function servicesSlider()
    {
        return view("Dashboard.Pages.services");
    }

    public function data(Request $request)
    {
        $query = ServicesModel::select([
            'id',
            'banner_image',
            'project_name',
            'description',
            'sections',
            'status',
            'sorting'
        ]);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('banner_image', fn($row) => $row->banner_image ?? '')
            ->editColumn('status', fn($row) => ucfirst($row->status))
            ->addColumn('action', function ($row) {
                $rowArray = $row->toArray();
                $rowArray['sections'] = json_decode($rowArray['sections'], true); // decode before sending

                $rowJson = base64_encode(json_encode($rowArray));
                $editBtn = '<button class="btn btn-primary btn-sm edit" data-row="' . $rowJson . '"><i class="fa fa-edit"></i> Edit</button>';
                $statusBtn = $row->status === 'live'
                    ? '<button class="btn btn-danger btn-sm" onclick="Disable(' . $row->id . ')">Disable</button>'
                    : '<button class="btn btn-success btn-sm" onclick="Enable(' . $row->id . ')">Enable</button>';
                return $editBtn . ' ' . $statusBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function save(Request $request)
    {
        try {
            $action = $request->input('action');
            $id = $request->input('id');

            if ($action === 'insert') {
                $request->validate([
                    'banner_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:4096',
                    'project_name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'sections.*.image' => 'required|image|mimes:jpeg,png,jpg,svg|max:4096',
                    'sections.*.description' => 'required|string',
                    'status' => 'required|in:live,disabled',
                    'sorting' => 'nullable|integer',
                ]);

                $bannerPath = $request->file('banner_image')->store('uploads/projects/banner', 'public');

                $sections = [];
                foreach ($request->sections as $section) {
                    $imgPath = $section['image']->store('uploads/projects/sections', 'public');
                    $sections[] = [
                        'image' => '/storage/' . $imgPath,
                        'description' => $section['description'],
                    ];
                }

                ServicesModel::create([
                    'banner_image' => '/storage/' . $bannerPath,
                    'project_name' => $request->project_name,
                    'description' => $request->description,
                    'sections' => json_encode($sections),
                    'status' => $request->status,
                    'sorting' => $request->sorting ?? 0,
                ]);

                return response()->json(['status' => true, 'message' => 'Project added successfully']);
            }

            if ($action === 'update') {
                $project = ServicesModel::find($id);
                if (!$project) return response()->json(['status' => false, 'message' => 'Record not found']);

                $request->validate([
                    'project_name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'sections.*.image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
                    'sections.*.description' => 'required|string',
                    'status' => 'required|in:live,disabled',
                    'sorting' => 'nullable|integer',
                ]);

                $data = $request->only(['project_name', 'description', 'status', 'sorting']);

                if ($request->hasFile('banner_image')) {
                    if ($project->banner_image && file_exists(public_path($project->banner_image))) {
                        @unlink(public_path($project->banner_image));
                    }
                    $bannerPath = $request->file('banner_image')->store('uploads/projects/banner', 'public');
                    $data['banner_image'] = '/storage/' . $bannerPath;
                }

                $sections = [];
                foreach ($request->sections as $section) {
                    if (isset($section['image']) && $section['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $imgPath = $section['image']->store('uploads/projects/sections', 'public');
                        $image = '/storage/' . $imgPath;
                    } else {
                        $image = $section['existing_image'] ?? null;
                    }

                    $sections[] = [
                        'image' => $image,
                        'description' => $section['description'],
                    ];
                }

                $data['sections'] = json_encode($sections);

                $project->update($data);

                return response()->json(['status' => true, 'message' => 'Project updated successfully']);
            }

            if (in_array($action, ['enable', 'disable'])) {
                $project = ServicesModel::find($id);
                if ($project) {
                    $project->status = $action === 'enable' ? 'live' : 'disabled';
                    $project->save();
                    return response()->json(['status' => true, 'message' => ucfirst($action) . 'd successfully']);
                }
            }

            return response()->json(['status' => false, 'message' => 'Invalid action']);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}
