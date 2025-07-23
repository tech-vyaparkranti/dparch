<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServicesModel extends Model
{
    use HasFactory;

    protected $table = "services";

    protected $fillable = [
        'main_image',       // ✅ newly added field for main image
        'banner_image',
        'project_name',
        'description',
        'sections',         // array of multiple images + description per section
        'status',
        'sorting',
        'slug',
    ];

    protected $casts = [
        'sections' => 'array',
    ];

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
