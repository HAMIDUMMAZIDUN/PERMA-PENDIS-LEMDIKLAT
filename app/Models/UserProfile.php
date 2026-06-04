<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserProfile extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city', 'profile_picture',
        'member_number', 'wilayah', 'province', 'institution',
        'study_program', 'nim', 'membership_status', 'kta_issued_at', 'kta_expired_at',
    ];

    protected $casts = [
        'kta_issued_at'  => 'date',
        'kta_expired_at' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
