<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'download_category_id',
        'title',
        'description',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'is_public',
        'download_count',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_public'  => 'boolean',
        'is_active'  => 'boolean',
        'download_count' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(DownloadCategory::class, 'download_category_id');
    }

    /**
     * Get human-readable file size from bytes.
     */
    public static function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) return number_format($bytes / 1073741824, 2) . ' GB';
        if ($bytes >= 1048576)    return number_format($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)       return number_format($bytes / 1024, 2) . ' KB';
        return $bytes . ' Bytes';
    }
}
