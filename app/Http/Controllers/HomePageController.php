<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
     public function index() {
        // mengambil postingan terbaru
        $data = Post::where('status', 'publish')->orderBy('id', 'desc')->latest()->take(3)->get();

        return view('home-page', ['data' => $data]);
    }
}