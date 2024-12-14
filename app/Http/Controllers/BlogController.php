<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->search;
        $data = Post::where('user_id', $user->id)->where(function($query) use ($search) {
            if($search) {
                $query->where('judul', 'like', "%{$search}%")->orWhere('konten', 'like', "%{$search}%");
            }
        })->orderBy('id', 'desc')->paginate(10)->withQueryString();

        
        return view('admin.blogs.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => 'required',
                'konten' => 'required',
                'thumbnail' => 'image|mimes:jpeg,jpg,png,JPG,JPEG|max:10240',
                'kategori' => 'required',

            ],
            [
                'judul.required'=> 'Judul wajib diisi',
                'konten.required'=> 'Konten wajib diisi',
                'thumbnail.image'=> 'Hanya gambar yang diperbolehkan',
                'thumbnail.mimes'=> 'Format gambar hanya JPEG, JPG dan PNG',
                'thumbnail.max'=> 'Size maksimum 10MB',
                'kategori.required'=> 'Wajib memilih kategori',
            ]
        );

        // upload gambar
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $path_location = public_path(getenv('THUMBNAILS_LOCATION'));
            $image->move($path_location, $image_name);
        };

        $dataStore = [
            'judul'=> $request->judul,
            'slug'=> $this->generateSlug($request->judul),
            'deskripsi'=> $request->deskripsi,
            'konten'=> $request->konten,
            'kategori'=> $request->kategori,
            'status'=> $request->status,
            'thumbnail' => isset($image_name) ? $image_name : null,
            'user_id' => Auth::user()->id
        ];

        Post::create($dataStore);
        
        return redirect()->route('admin.blogs.index')->with('success', 'Data berhasil ditambahkan');
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
                'kategori' => 'required',

            ],
            [
                'judul.required'=> 'Judul wajib diisi',
                'konten.required'=> 'Konten wajib diisi',
                'thumbnail.image'=> 'Hanya gambar yang diperbolehkan',
                'thumbnail.mimes'=> 'Format gambar hanya JPEG, JPG dan PNG',
                'thumbnail.max'=> 'Size maksimum 10MB',
                'kategori.required'=> 'Wajib memilih kategori',
            ]
        );

        // upload gambar
        if($request->hasFile('thumbnail')){
            if(isset($post->thumbnail) && file_exists(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail)) {
                unlink(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail);
            }

            $image = $request->file('thumbnail');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $path_location = public_path(getenv('THUMBNAILS_LOCATION'));
            $image->move($path_location, $image_name);
        };

         $dataUpdate = [
            'judul'=> $request->judul,
            'slug'=> $this->generateSlug($request->judul, $post->id),
            'deskripsi'=> $request->deskripsi,
            'konten'=> $request->konten,
            'kategori'=> $request->kategori,
            'status'=> $request->status,
            'thumbnail' => isset($image_name) ? $image_name : $post->thumbnail
        ];

        Post::where('id', $post->id)->update($dataUpdate);
        
        return redirect()->route('admin.blogs.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(isset($post->thumbnail) && file_exists(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail)) {
            unlink(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail);
        }
        Post::where('id', $post->id)->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Data berhasil dihapus!');
    }

    private function generateSlug($judul, $id = null) {
        $slug = Str::slug($judul);

        // mengecek tabel post,
        // jika slug yang akan digenerate berasal dari id yang berbeda maka akan menambahkan count
        // jika berada pada id yang sama maka tidak akan menambahkan count nya
        $count = Post::where('slug', $slug)->when($id, function($query, $id){
            return $query->where('id', '!=', $id);
        })->count();

        if($count > 0) {
            $slug = $slug . "-" . ($count + 1);
        }

        return $slug;
    }
}