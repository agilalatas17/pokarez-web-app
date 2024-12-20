<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
     protected $table = 'posts';
    protected $fillable = ['judul', 'slug', 'video_url', 'thumbnail', 'konten', 'deskripsi', 'kategori', 'status', 'user_id' ];

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}