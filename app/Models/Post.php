<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $table = 'posts';
    protected $fillable = ['judul', 'slug', 'video_url', 'thumbnail', 'konten', 'deskripsi', 'tipe', 'status', ];
}