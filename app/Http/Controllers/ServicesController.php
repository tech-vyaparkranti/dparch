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
            'main_image',
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
                $rowArray['sections'] = json_decode($rowArray['sections'], true);

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
                    'main_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:15360',
                    'banner_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:15360',
                    'project_name' => 'required|string|max:255',
                    'description' => 'required|string',
                    // The 'sections.*.images.*' validation here applies to new uploaded files.
                    // Max image size for section images is now consistent with main/banner images (15MB).
                    'sections.*.images.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:15360',
                    'sections.*.description' => 'required|string',
                    'status' => 'required|in:live,disabled',
                    'sorting' => 'nullable|integer',
                ]);

                $mainPath = $request->file('main_image')->store('uploads/projects/main', 'public');
                $bannerPath = $request->file('banner_image')->store('uploads/projects/banner', 'public');

                $sections = [];
                foreach ($request->sections as $section) {
                    $images = [];
                    if (isset($section['images'])) {
                        foreach ($section['images'] as $img) {
                            $imgPath = $img->store('uploads/projects/sections', 'public');
                            $images[] = '/storage/' . $imgPath;
                        }
                    }

                    $sections[] = [
                        'images' => $images,
                        'description' => $section['description'],
                    ];
                }

                ServicesModel::create([
                    'main_image' => '/storage/' . $mainPath,
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
                    // Validation for new section images (if uploaded).
                    // Max image size for section images is now consistent with main/banner images (15MB).
                    'sections.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:15360',
                    'sections.*.description' => 'required|string',
                    'status' => 'required|in:live,disabled',
                    'sorting' => 'nullable|integer',
                ]);

                $data = $request->only(['project_name', 'description', 'status', 'sorting']);

                // Handle main_image update
                if ($request->hasFile('main_image')) {
                    // Delete old image if it exists
                    if ($project->main_image && Storage::disk('public')->exists(str_replace('/storage/', '', $project->main_image))) {
                        Storage::disk('public')->delete(str_replace('/storage/', '', $project->main_image));
                    }
                    $mainPath = $request->file('main_image')->store('uploads/projects/main', 'public');
                    $data['main_image'] = '/storage/' . $mainPath;
                }

                // Handle banner_image update
                if ($request->hasFile('banner_image')) {
                    // Delete old image if it exists
                    if ($project->banner_image && Storage::disk('public')->exists(str_replace('/storage/', '', $project->banner_image))) {
                        Storage::disk('public')->delete(str_replace('/storage/', '', $project->banner_image));
                    }
                    $bannerPath = $request->file('banner_image')->store('uploads/projects/banner', 'public');
                    $data['banner_image'] = '/storage/' . $bannerPath;
                }

                // --- Handle sections update: Ensure previous images are retained if not explicitly changed ---
                $newSectionsData = [];
                // Decode existing sections from the database to compare/merge
                $existingSectionsInDb = json_decode($project->sections, true) ?? [];

                foreach ($request->sections as $sectionIndex => $sectionRequestData) {
                    $imagesForThisSection = [];

                    // 1. Collect images from previous submission (explicitly retained from frontend)
                    // The frontend should send paths of images it intends to keep via 'existing_images'.
                    if (isset($sectionRequestData['existing_images']) && is_array($sectionRequestData['existing_images'])) {
                        // Filter out any potentially invalid/empty entries if frontend sends them.
                        $imagesForThisSection = array_filter($sectionRequestData['existing_images']);
                    }

                    // 2. Add newly uploaded images for this specific section
                    if (isset($sectionRequestData['images']) && is_array($sectionRequestData['images'])) {
                        foreach ($sectionRequestData['images'] as $img) {
                            if ($img instanceof \Illuminate\Http\UploadedFile) {
                                $imgPath = $img->store('uploads/projects/sections', 'public');
                                $imagesForThisSection[] = '/storage/' . $imgPath;
                            }
                        }
                    }

                    // 3. IMPORTANT: If no new images were uploaded AND no existing_images were explicitly provided
                    // (meaning the user only changed description or didn't touch image inputs),
                    // then retrieve the images from the corresponding old section in the database.
                    if (empty($imagesForThisSection) && isset($existingSectionsInDb[$sectionIndex]['images'])) {
                        $imagesForThisSection = $existingSectionsInDb[$sectionIndex]['images'];
                    }

                    $newSectionsData[] = [
                        'images' => $imagesForThisSection,
                        'description' => $sectionRequestData['description'],
                    ];
                }

                $data['sections'] = json_encode($newSectionsData);

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