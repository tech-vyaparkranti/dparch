<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class ServicesModel extends Model
{
    use HasFactory;

    protected $table = "services";

    const ID = "id";
    const IMAGE = "image";
    const BANNER_IMAGE = "banner_image";
    const PROJECT_NAME = "project_name";    
    const DESCRIPTION = "description";
    const GALLERY_IMAGES = "gallery_images"; // store as json string
    const STATUS = "status";
    const SORTING = "sorting";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const SLUG = "slug";
    const STATUS_LIVE = "live";
    const STATUS_DISABLED = "disabled";

    // Fillable fields for mass-assignment
    protected $fillable = [
        self::IMAGE,
        self::BANNER_IMAGE,
        self::PROJECT_NAME,
        self::DESCRIPTION,
        self::GALLERY_IMAGES,
        self::STATUS,
        self::SORTING,
        self::SLUG,
    ];

    // If you want gallery_images as array always
    protected $casts = [
        self::GALLERY_IMAGES => 'array',
    ];
    #"live","disabled"

    protected static function booted(): void
    {
        static::creating(function (ServicesModel $service) {
            $service->slug = Str::slug($service->project_name, '-');
        });

        static::updating(function (ServicesModel $service) {
            if ($service->isDirty('project_name')) {
                $service->slug = Str::slug($service->project_name, '-');
            }
        });
        
    }

}
