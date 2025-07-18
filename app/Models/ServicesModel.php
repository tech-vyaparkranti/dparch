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
        'banner_image',
        'project_name',
        'description',
        'sections',      // NEW field: array of image + description
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
