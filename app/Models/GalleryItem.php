<?php

namespace App\Models;

use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class GalleryItem extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $table = "gallery_items";

    const TABLE_NAME = "gallery_items";

    const ID = 'id';
    const LOCAL_IMAGE = 'local_image';
    const IMAGE_LINK = 'image_link';
    const ALTERNATE_TEXT = 'alternate_text';
    const LOCAL_VIDEO = 'local_video';
    const VIDEO_LINK = 'video_link';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const POSITION = 'position';
    const VIEW_STATUS = 'view_status';
    const FILTER_CATEGORY = "filter_category";
    const STATUS = 'status';
    const CREATED_BY = 'created_by';
    const CREATED_AT = 'created_at';
    const UPDATED_BY = 'updated_by';
    const UPDATED_AT = 'updated_at';
    const VIEW_STATUS_VISIBLE = "visible";

    const IMAGE_UPLOAD_PATH = "/upload/gallery/images/";
    const VIDEO_UPLOAD_PATH = "/upload/gallery/videos/";

    public function addGalleryItem(Request $request)
    {
        try{
            $insert = [
                self::IMAGE_LINK=>$request->input(self::IMAGE_LINK),
                self::VIDEO_LINK=>$request->input(self::VIDEO_LINK),
                self::ALTERNATE_TEXT=>$request->input(self::ALTERNATE_TEXT),
                self::TITLE=>$request->input(self::TITLE),
                self::DESCRIPTION=>$request->input(self::DESCRIPTION),
                self::POSITION=>$request->input(self::POSITION),
                self::VIEW_STATUS=>$request->input(self::VIEW_STATUS),
                self::FILTER_CATEGORY=>$request->input(self::FILTER_CATEGORY),
                self::STATUS=>1,
                self::CREATED_BY=>Auth::user()->id,
            ];
            $maxId = GalleryItem::max(self::ID);
            if(empty($maxId)){
                $maxId = 1;
            }else{
                $maxId++;
            }
            if($request->file(self::LOCAL_IMAGE)){
                foreach($request->file(self::LOCAL_IMAGE) as $galleryItem){
                    $fileName = $galleryItem->getClientOriginalName();
                    $fileName = "Img_$maxId".preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
                    $galleryItem->move(public_path().self::IMAGE_UPLOAD_PATH, $fileName);
                    $insert[self::LOCAL_IMAGE] = self::IMAGE_UPLOAD_PATH.$fileName;
                    GalleryItem::insert($insert);
                    $maxId++;
                }
            }
            if($request->file(self::LOCAL_VIDEO)){
                $insert[self::LOCAL_IMAGE] = null; // This line seems problematic if you're adding a video after potentially adding an image in the loop above. Consider separate logic for video entries.
                $video = $request->file(self::LOCAL_VIDEO);
                $fileName = $video->getClientOriginalName();
                $fileName = "Video_$maxId".preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
                $video->move(public_path().self::VIDEO_UPLOAD_PATH, $fileName);
                $insert[self::LOCAL_VIDEO] = self::VIDEO_UPLOAD_PATH.$fileName;
                GalleryItem::insert($insert);
            }
            if($request->input(self::VIDEO_LINK)){
                $insert[self::VIDEO_LINK] = $request->input(self::VIDEO_LINK);
                // If you are only inserting video link, ensure other file related fields are nullified if needed
                // $insert[self::LOCAL_IMAGE] = null;
                // $insert[self::LOCAL_VIDEO] = null;
                GalleryItem::insert($insert);
            }
            Cache::forget("galleryImages");
            return ["status"=>true,"message"=>"Gallery Item saved.","data"=>"null"];

        }catch(Exception $exception){
            $this->reportException($exception);
            return ["status"=>false,"message"=>"Something went wrong.","data"=>"null"];
        }
    }

    public function updateGalleryItem(Request $request){
        try{
            $check = self::where([
                [self::ID,$request->input(self::ID)],
                [self::STATUS,1]])->first();

            if($check){
                $update = [
                    self::IMAGE_LINK=>$request->input(self::IMAGE_LINK),
                    self::VIDEO_LINK=>$request->input(self::VIDEO_LINK),
                    self::ALTERNATE_TEXT=>$request->input(self::ALTERNATE_TEXT),
                    self::TITLE=>$request->input(self::TITLE),
                    self::DESCRIPTION=>$request->input(self::DESCRIPTION),
                    self::POSITION=>$request->input(self::POSITION),
                    self::VIEW_STATUS=>$request->input(self::VIEW_STATUS),
                    self::FILTER_CATEGORY=>$request->input(self::FILTER_CATEGORY),
                    self::UPDATED_BY=>Auth::user()->id,
                ];

                // Handle LOCAL_IMAGE update
                if($request->hasFile(self::LOCAL_IMAGE)){
                    // Delete old image if it exists
                    if($check->{self::LOCAL_IMAGE} && File::exists(public_path($check->{self::LOCAL_IMAGE}))){
                        File::delete(public_path($check->{self::LOCAL_IMAGE}));
                    }

                    $galleryItem = $request->file(self::LOCAL_IMAGE)[0]; // Assuming single image for update
                    $fileName = "Img_".$check->{self::ID}.preg_replace('/[^A-Za-z0-9.\-]/', '', $galleryItem->getClientOriginalName()); // Use the current ID for consistent naming
                    $galleryItem->move(public_path().self::IMAGE_UPLOAD_PATH, $fileName);
                    $update[self::LOCAL_IMAGE] = self::IMAGE_UPLOAD_PATH.$fileName;
                    $update[self::LOCAL_VIDEO] = null; // If a new image is uploaded, clear any local video
                    $update[self::VIDEO_LINK] = null; // Clear any video link if a new image is uploaded
                } else {
                    // If no new image is uploaded, ensure local_image is not nullified if it had a value
                    // This is implicitly handled if not added to $update array
                    // However, if the user explicitly wants to remove an image without uploading a new one,
                    // you'd need a checkbox or similar mechanism on the frontend.
                }

                // Handle LOCAL_VIDEO update
                if($request->hasFile(self::LOCAL_VIDEO)){
                    // Delete old video if it exists
                    if($check->{self::LOCAL_VIDEO} && File::exists(public_path($check->{self::LOCAL_VIDEO}))){
                        File::delete(public_path($check->{self::LOCAL_VIDEO}));
                    }

                    $video = $request->file(self::LOCAL_VIDEO);
                    $fileName = "Video_".$check->{self::ID}.preg_replace('/[^A-Za-z0-9.\-]/', '', $video->getClientOriginalName()); // Use the current ID for consistent naming
                    $video->move(public_path().self::VIDEO_UPLOAD_PATH, $fileName);
                    $update[self::LOCAL_VIDEO] = self::VIDEO_UPLOAD_PATH.$fileName;
                    $update[self::LOCAL_IMAGE] = null; // If a new video is uploaded, clear any local image
                    $update[self::IMAGE_LINK] = null; // Clear any image link if a new video is uploaded
                } else {
                    // If no new video is uploaded, ensure local_video is not nullified
                }

                // Update IMAGE_LINK and VIDEO_LINK even if no files are uploaded
                // These will overwrite existing links if provided in the request
                $update[self::IMAGE_LINK] = $request->input(self::IMAGE_LINK);
                $update[self::VIDEO_LINK] = $request->input(self::VIDEO_LINK);

                // If both local_image and local_video were present in the original record
                // and neither is being updated, you might need specific logic.
                // For now, if a local file is provided, external links are cleared.
                // This assumes a gallery item is either a local image, local video, image link, or video link, but not a combination.
                // If combinations are allowed, this logic needs refinement.

                // Perform the update
                GalleryItem::where(self::ID,$check->{self::ID})->update($update);

                Cache::forget("galleryImages");
                $return = ["status"=>true,"message"=>"Gallery Item updated successfully.","data"=>"null"];
            } else {
                $return = ["status"=>false,"message"=>"Gallery Item not found.","data"=>"null"];
            }
            return $return;
        }catch(Exception $exception){
            $this->reportException($exception);
            return ["status"=>false,"message"=>"Something went wrong.","data"=>"null"];
        }
    }


    /**
     * getAllGalleryImages
     *
     * @return void
     */
    public function getAllGalleryImages(){
        return self::where([
            [self::STATUS,1],
            [self::VIEW_STATUS,self::VIEW_STATUS_VISIBLE]
        ])->select(self::LOCAL_IMAGE,
        self::IMAGE_LINK,self::ALTERNATE_TEXT,self::TITLE,self::DESCRIPTION)
        ->whereNULL(self::VIDEO_LINK)
        ->whereNULL(self::LOCAL_VIDEO)->orderBy(self::POSITION,'asc')->get();
    }

    /**
     * deleteGalleryItem
     *
     * @param  mixed $requestData
     * @return void
     */
    public function deleteGalleryItem($requestData){

        try {
            $check = self::where([
                [self::ID, $requestData[self::ID]],
                [self::STATUS,1],
            ])->first();
            if($check){
                $check->{self::STATUS} = 0;
                $check->{self::UPDATED_BY} = Auth::id();
                $check->save();
                $return = ["status" => true, "message" => "Deleted", "data" => null];
            } else {
                $return = ["status" => false, "message" => "Record not found", "data" => null];
            }
        } catch (Exception $exception) {
            $return = ["status" => false, "message" => $exception->getMessage(), "data" => null];
        }
        return $return;
    }

    /**
     * getAllGalleryVideos
     *
     * @return void
     */
    public function getAllGalleryVideos(){
        return self::where([
            [self::STATUS,1],
            [self::VIEW_STATUS,self::VIEW_STATUS_VISIBLE]
        ])->select(self::LOCAL_VIDEO,
        self::VIDEO_LINK,self::ALTERNATE_TEXT,self::TITLE,self::DESCRIPTION)
        ->whereNULL(self::IMAGE_LINK)
        ->whereNULL(self::LOCAL_IMAGE)->orderBy(self::POSITION,'asc')->get();
    }
}

