<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected $fillable = [
        'gallery_category_id',
        'title',
        'slug',
        'event_date',
        'location',
        'description',
        'cover_image',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'event_date'   => 'date',
        'is_featured'  => 'boolean',
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title) . '-' . time();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function items()
    {
        return $this->hasMany(GalleryItem::class)->orderBy('sort_order');
    }

    public function getCoverAttribute()
    {
        if ($this->cover_image) return $this->cover_image;
        $first = $this->items()->first();
        return $first ? $first->file_path : null;
    }
}
