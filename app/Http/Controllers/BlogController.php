<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\YouTube;
use Google\Service\YouTube\VideoSnippet;
use Google\Service\YouTube\VideoStatus;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Google\Http\MediaFileUpload;
use Google\Service\YouTube\Video;
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
     * YOUTUBE UPLOAD
     */
    // public function uploadVideoToYotube($videoPath, $judul, $deskripsi) {
    //     $user = Auth::user();
    //     $googleToken = $user->google_token;
    //     $googleRefreshToken = $user->google_refresh_token;

    //     $client = new Client();
    //     $client->setClientId(env('GOOGLE_CLIENT_ID'));
    //     $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    //     $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    //     $client->addScope(YouTube::YOUTUBE_UPLOAD);
    //     $client->setAccessToken([
    //         'access_token' => $googleToken,
    //         'expires_in' => 10800, // 3jam
    //     ]);

    //      // Periksa apakah token sudah kedaluwarsa
    //     if ($client->isAccessTokenExpired()) {
    //         // Gunakan refresh token untuk mendapatkan token baru
    //         $newToken = $client->fetchAccessTokenWithRefreshToken($googleRefreshToken);
            
    //         // Perbarui token di database
    //         $user->update([
    //             'google_token' => $newToken['access_token'],
    //         ]);

    //         $client->setAccessToken($newToken);
    //     }

    //     $youtube = new YouTube($client);
    //     $video = new Video();
    //     $snippet = new VideoSnippet();
    //     $status = new VideoStatus();
         
    //     $snippet->setTitle($judul);
    //     $snippet->setDescription($deskripsi);
         
    //     $status->setPrivacyStatus('private');

    //     $video->setSnippet($snippet);
    //     $video->setStatus($status);

    //     $chunkSizeBytes = 1 * 1024 * 1024; // 1 MB
    //     $client->setDefer(true);

    //     $insertRequest = $youtube->videos->insert('snippet,status', $video);
    //     $media = new MediaFileUpload($client, $insertRequest, 'video/*', null, true, $chunkSizeBytes);
    //     $media->setFileSize(filesize($videoPath));

    //     // Upload video dalam chunk
    //     $handle = fopen($videoPath, 'rb');
    //         while (!feof($handle)) {
    //         $chunk = fread($handle, $chunkSizeBytes);
    //         $status = $media->nextChunk($chunk);
    //     }
    //     fclose($handle);

    //     $client->setDefer(false);

    //     return $status; // Mengembalikan respons dari YouTube
    // }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $apiKey = env('GOOGLE_API_KEY');
        $user = Auth::user();
        $googleToken = $user->google_token;
        $googleRefreshToken = $user->google_refresh_token;

        $client = new Client();
        $client->setAuthConfig(base_path('google-oauth-client.json'));
        $client->setDeveloperKey($apiKey);
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(YouTube::YOUTUBE_UPLOAD, Youtube::YOUTUBE);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        $client->setAccessToken([
            'access_token' => $googleToken,
            'expires_in' => 7200, // 2jam
        ]);

        $request->validate(
            [
                'judul' => 'required',
                'konten' => 'required',
                'thumbnail' => 'image|mimes:jpeg,jpg,png,JPG,JPEG|max:10240',
                'kategori' => 'required',
                'video' => 'file|mimetypes:video/mp4,video/avi,video/mkv|max:51200', // Maks 50MB
            ],
            [
                'judul.required'=> 'Judul wajib diisi',
                'konten.required'=> 'Konten wajib diisi',
                'thumbnail.image'=> 'Hanya gambar yang diperbolehkan',
                'thumbnail.mimes'=> 'Format gambar hanya JPEG, JPG dan PNG',
                'thumbnail.max'=> 'Size maksimum 10MB',
                'kategori.required'=> 'Wajib memilih kategori',
                'video.mimetypes' => 'Format video hanya MP4, AVI, atau MKV',
                'video.max' => 'Ukuran maksimum video adalah 50MB',
            ]
        );

        // upload gambar
        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $path_location = public_path(getenv('THUMBNAILS_LOCATION'));
            // $path_location = base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')); // untuk host infinityfree
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
            'user_id' => $user->id
        ];

        $post = Post::create($dataStore);

        if ($request->hasFile('video_url')) {
            $video = $request->file('video_url');
            // $video_name = $video->getClientOriginalName();
            $video_name = time() . '_' . $video->getClientOriginalName();
            $video_path_location = public_path('upload/videos');
            $video->move($video_path_location, $video_name);

            // Periksa apakah token sudah kedaluwarsa
            // if ($client->isAccessTokenExpired()) {
            //     // Gunakan refresh token untuk mendapatkan token baru
            //     $newToken = $client->fetchAccessTokenWithRefreshToken($googleRefreshToken);
                
            //     // Perbarui token di database
            //     $user->update([
            //         'google_token' => $newToken['access_token'],
            //     ]);

            //     $client->setAccessToken($newToken);
            // } else {
            //     $client->setAccessToken([
            //         'access_token' => $googleToken,
            //         'expires_in' => 7200, // 2 jam
            //     ]);
            // }
            
            $service = new Youtube($client);
            $snippet = new VideoSnippet();
            $status = new VideoStatus();
            $video_youtube = new Video();

            $snippet->setTitle($request->judul);
            $snippet->setDescription(Str::of($request->konten)->stripTags());
            $status->setPrivacyStatus('private');
            $video_youtube->setSnippet($snippet);
            $video_youtube->setStatus($status);

            $videoFile = public_path('upload/videos' . '/' . $video_name);

            // dd($videoFile);

            $response = $service->videos->insert(
                'snippet,status',
                $video_youtube,
                array(
                    'data' => file_get_contents($videoFile),
                    'mimeType' => 'application/octet-stream',
                    'uploadType' => 'multipart'
                )
            );

            // Menyimpan ID video YouTube ke dalam post
            $post->youtube_video_id = $response->getId(); // Menyimpan ID video YouTube
            $post->save();
        }
        
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

        // update gambar
        if($request->hasFile('thumbnail')){
            if(isset($post->thumbnail) && file_exists(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail)) {
                unlink(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail);
            }

            // untuk host infinityfree
            // if(isset($post->thumbnail) && file_exists(base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')) . '/' . $post->thumbnail)) {
            //     unlink(base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')) . '/' . $post->thumbnail);
            // }

            $image = $request->file('thumbnail');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $path_location = base_path('../' . getenv('THUMBNAILS_LOCATION'));
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

        // untuk host infinityfree
        // if(isset($post->thumbnail) && file_exists(base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')) . '/' . $post->thumbnail)) {
        //     unlink(base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')) . '/' . $post->thumbnail);
        // }

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