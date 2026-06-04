<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = ['gallery_id', 'file_path', 'file_type', 'caption', 'sort_order'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
