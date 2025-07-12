<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    // If you want gallery_images as array always
    protected $casts = [
        self::GALLERY_IMAGES => 'array',
    ];
    #"live","disabled"
}
