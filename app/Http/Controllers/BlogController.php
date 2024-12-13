<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::all();
        $user = Auth::user();
        $data = Post::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);

        
        return view('admin.blogs.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $data = $post;
        return view('admin.blogs.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'judul' => 'required',
                'konten' => 'required',
                'thumbnail' => 'image|mimes:jpeg,jpg,png,JPG,JPEG|max:10240',
                'tipe' => 'required',

            ],
            [
                'judul.required'=> 'Judul wajib diisi',
                'konten.required'=> 'Konten wajib diisi',
                'thumbnail.image'=> 'Hanya gambar yang diperbolehkan',
                'thumbnail.mimes'=> 'Format gambar hanya JPEG, JPG dan PNG',
                'thumbnail.max'=> 'Size maksimum 10MB',
                'tipe.required'=> 'Wajib memilih kategori',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}