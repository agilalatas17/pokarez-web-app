<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $data = Post::where('status', 'publish')->where('kategori', 'artikel')->orderBy('created_at', 'desc')->get();
        
        return view('articles-page', compact('data'));
    }
}