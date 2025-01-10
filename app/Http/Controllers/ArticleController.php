<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticles() {
        $data = Post::where('status', 'publish')->where('kategori', 'artikel')->orderBy('created_at', 'desc')->get();
        
        return view('blogs.articles-page', compact('data'));
    }

    public function showVideos() {
        $data = Post::where('status', 'publish')->where('kategori', 'video')->orderBy('created_at', 'desc')->get();

        return view('blogs.videos-page', compact('data'));
    }
}