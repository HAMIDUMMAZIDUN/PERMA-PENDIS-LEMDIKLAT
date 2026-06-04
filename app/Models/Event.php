<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'start_date',
        'end_date',
        'cover_image',
        'type',
        'registration_url',
        'contact_person',
        'is_published',
        'is_featured',
    ];

    protected $casts = [
        'start_date'   => 'datetime',
        'end_date'     => 'datetime',
        'is_published' => 'boolean',
        'is_featured'  => 'boolean',
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

    public function getTypeColorAttribute(): string
    {
        return match ($this->type) {
            'seminar'      => 'bg-blue-100 text-blue-700',
            'pelatihan'    => 'bg-green-100 text-green-700',
            'rapat'        => 'bg-yellow-100 text-yellow-700',
            'webinar'      => 'bg-purple-100 text-purple-700',
            'musyawarah'   => 'bg-orange-100 text-orange-700',
            default        => 'bg-gray-100 text-gray-600',
        };
    }

    public function getTypeCalendarColorAttribute(): string
    {
        return match ($this->type) {
            'seminar'    => '#3b82f6',
            'pelatihan'  => '#22c55e',
            'rapat'      => '#f59e0b',
            'webinar'    => '#a855f7',
            'musyawarah' => '#f97316',
            default      => '#6b7280',
        };
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }
}
