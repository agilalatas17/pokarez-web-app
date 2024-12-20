<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogDetailController extends Controller
{
    public function detail($slug) {
        $data = Post::where('status', 'publish')->where('slug', $slug)->firstOrFail();

        return view('blog-detail-page', compact('data'));
    }
}