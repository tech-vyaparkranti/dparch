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
    // Show the project admin page
    public function servicesSlider()
    {
        return view("Dashboard.Pages.services");
    }

    // DataTable AJAX for projects
    public function data(Request $request)
    {
        $query = ServicesModel::select([
            'id',
            'image',
            'banner_image',
            'project_name',
            'description',
            'gallery_images',
            'status',
            'sorting'
        ]);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return $row->image ? $row->image : '';
            })
            ->editColumn('banner_image', function ($row) {
                return $row->banner_image ? $row->banner_image : '';
            })
            ->editColumn('gallery_images', function ($row) {
                // Gallery is stored as JSON array
                $galleries = $row->gallery_images ? json_decode($row->gallery_images, true) : [];
                if (is_array($galleries) && count($galleries)) {
                    $imgs = '';
                    foreach ($galleries as $img) {
                        $imgs .= '<img src="' . $img . '" style="max-width:32px; margin:2px;">';
                    }
                    return $imgs;
                }
                return '';
            })
            ->editColumn('status', function ($row) {
                return ucfirst($row->status);
            })
            ->addColumn('action', function ($row) {
                $rowJson = base64_encode(json_encode([
                    'id' => $row->id,
                    'image' => $row->image,
                    'banner_image' => $row->banner_image,
                    'project_name' => $row->project_name,
                    'description' => $row->description,
                    'gallery_images' => $row->gallery_images,
                    'status' => $row->status,
                    'sorting' => $row->sorting,
                ]));
                $editBtn = '<button class="btn btn-primary btn-sm edit" data-row="' . $rowJson . '"><i class="fa fa-edit"></i> Edit</button> ';
                if ($row->status === 'live') {
                    $statusBtn = '<button class="btn btn-danger btn-sm" onclick="Disable(' . $row->id . ')">Disable</button>';
                } else {
                    $statusBtn = '<button class="btn btn-success btn-sm" onclick="Enable(' . $row->id . ')">Enable</button>';
                }
                return $editBtn . $statusBtn;
            })
            ->rawColumns(['action', 'gallery_images'])
            ->make(true);
    }

    // Save/Insert/Update/Enable/Disable
    public function save(Request $request)
    {
        try {
            $action = $request->input('action');
            $id = $request->input('id');
            if ($action === 'insert') {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:4096',
                    'banner_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:4096',
                    'project_name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
                    'status' => 'required|in:live,disabled',
                    'sorting' => 'nullable|integer',
                ]);
                $imagePath = null;
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('uploads/projects', 'public');
                    $imagePath = '/storage/' . $imagePath;
                }
                $bannerImagePath = null;
                if ($request->hasFile('banner_image')) {
                    $bannerImagePath = $request->file('banner_image')->store('uploads/projects/banner', 'public');
                    $bannerImagePath = '/storage/' . $bannerImagePath;
                }
                $galleryPaths = [];
                if ($request->hasFile('gallery_images')) {
                    foreach ($request->file('gallery_images') as $img) {
                        $path = $img->store('uploads/projects/gallery', 'public');
                        $galleryPaths[] = '/storage/' . $path;
                    }
                }
                ServicesModel::create([
                    'image' => $imagePath,
                    'banner_image' => $bannerImagePath,
                    'project_name' => $request->project_name,
                    'description' => $request->description,
                    'gallery_images' => json_encode($galleryPaths),
                    'status' => $request->status,
                    'sorting' => $request->sorting ?? 0,
                ]);
                return response()->json(['status' => true, 'message' => 'Project added successfully']);
            } elseif ($action === 'update') {
                $project = ServicesModel::find($id);
                if (!$project) {
                    return response()->json(['status' => false, 'message' => 'Record not found']);
                }
                $data = $request->only(['project_name', 'description', 'status', 'sorting']);
                if ($request->hasFile('image')) {
                    if ($project->image && file_exists(public_path($project->image))) @unlink(public_path($project->image));
                    $imagePath = $request->file('image')->store('uploads/projects', 'public');
                    $data['image'] = '/storage/' . $imagePath;
                }
                if ($request->hasFile('banner_image')) {
                    if ($project->banner_image && file_exists(public_path($project->banner_image))) @unlink(public_path($project->banner_image));
                    $bannerPath = $request->file('banner_image')->store('uploads/projects/banner', 'public');
                    $data['banner_image'] = '/storage/' . $bannerPath;
                }
                if ($request->hasFile('gallery_images')) {
                    // Optionally, you can delete old gallery images
                    $galleryPaths = [];
                    foreach ($request->file('gallery_images') as $img) {
                        $path = $img->store('uploads/projects/gallery', 'public');
                        $galleryPaths[] = '/storage/' . $path;
                    }
                    $data['gallery_images'] = json_encode($galleryPaths);
                }
                $project->update($data);
                return response()->json(['status' => true, 'message' => 'Project updated successfully']);
            } elseif ($action === 'enable' || $action === 'disable') {
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
