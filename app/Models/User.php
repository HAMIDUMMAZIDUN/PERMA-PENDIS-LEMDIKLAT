<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'username', 'password', 'role_id', 'user_profile_id', 'is_activated',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_activated' => 'boolean',
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

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'user_profile_id');
    }

    public function isAdmin(): bool
    {
        return $this->role_id <= 2;
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->profile?->name ?: $this->username;
    }

    public function getInitialsAttribute(): string
    {
        $name = $this->display_name;
        $words = explode(' ', $name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials ?: strtoupper(substr($name, 0, 2));
    }
}
