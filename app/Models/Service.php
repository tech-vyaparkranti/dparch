<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $table = "service_projects";
    protected $fillable = [
        'service_name',
        'image',
        'status',
        'sorting',
        'slug',
    ];

    public const SERVICE_NAME = "service_name";
    public const SERVICE_IMAGE = "image";
    public const POSITION = "sorting";
    public const STATUS = "status";
    public const SLUG = 'slug';
    public const ID = "id";

    public static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = \Str::slug($service->service_name);
            }
        });
        static::updating(function ($service) {
            if ($service->isDirty('service_name')) {
                $service->slug = \Str::slug($service->service_name);
            }
        });
    }

}
