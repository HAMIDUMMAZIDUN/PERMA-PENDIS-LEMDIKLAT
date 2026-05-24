<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    protected $fillable = ['name', 'role', 'category', 'photo', 'color', 'is_leader', 'sort_order'];
}
