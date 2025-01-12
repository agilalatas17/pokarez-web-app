<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\YouTube;
use Google\Service\YouTube\VideoSnippet;
use Google\Service\YouTube\VideoStatus;
use App\Models\Post;
use Exception;
use Google\Http\MediaFileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        
            if($request->kategori == 'artikel') {
                $request->validate(
                    [
                        'judul' => 'required',
                        'konten' => 'required',
                        'thumbnail' => 'image|mimes:jpeg,jpg,png,JPG,JPEG|max:10240',
                        'kategori' => 'required',
                    ],
                    [
                        'judul.required'=> 'Judul wajib diisi',
                        'konten.required'=> 'Konten artikel wajib diisi',
                        'thumbnail.image'=> 'Hanya gambar yang diperbolehkan',
                        'thumbnail.mimes'=> 'Format gambar hanya JPEG, JPG dan PNG',
                        'thumbnail.max'=> 'Size maksimum 10MB',
                        'kategori.required'=> 'Wajib memilih kategori',
                    ]
                );
            } else {
                $request->validate(
                    [
                        'judul' => 'required',
                        'deskripsi' => 'required',
                        'kategori' => 'required',
                        'video_url' => 'file|mimetypes:video/mp4,video/avi,video/mkv|max:150000', // Maks 150MB
                    ],
                    [
                        'judul.required'=> 'Judul wajib diisi',
                        'deskripsi.required'=> 'Deskripsi video wajib diisi',
                        'kategori.required'=> 'Wajib memilih kategori',
                        'video_url.mimetypes' => 'Format video hanya MP4, AVI, atau MKV',
                        'video_url.max' => 'Ukuran maksimum video adalah 150MB',
                    ]
                );
            }
 
            # upload gambar
            if($request->hasFile('thumbnail')){
                $image = $request->file('thumbnail');
                $image_name = time() . '_' . $image->getClientOriginalName();
                $path_location = public_path(getenv('THUMBNAILS_LOCATION'));
                # untuk host infinityfree
                // $path_location = base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails'));
                $image->move($path_location, $image_name);
            };

        
            # upload video
        if ($request->hasFile('video_url')) {
            $service = new Youtube($client);
            $snippet = new VideoSnippet();
            $status = new VideoStatus();
            $video_youtube = new Video();

            $snippet->setTitle($request->judul);
            $snippet->setDescription(Str::of($request->deskripsi)->stripTags());
            $status->setPrivacyStatus('unlisted');
            $video_youtube->setSnippet($snippet);
            $video_youtube->setStatus($status);

            $video_path = $request->file('video_url')->getRealPath();
            // $video_file = $request->file('video_url');
            // $video_path = file_get_contents($video_file->getPathname());
            // $video_mime = $video_file->getMimeType();

            # Upload video ke YouTube
            $chunkSizeBytes = 1 * 1024 * 1024; // 1MB per chunk
            $client->setDefer(true);

            $insertRequest = $service->videos->insert('snippet,status', $video_youtube);
            // $insertRequest = $service->videos->insert('snippet,status', $video_youtube, ['data' => $video_path, 'mimeType' => $video_mime]);
            $media = new MediaFileUpload($client, $insertRequest, 'application/octet-stream', null, true, $chunkSizeBytes);
            $media->setFileSize(filesize($video_path));

            $status = false;
            $handle = fopen($video_path, "rb");
            while (!$status && !feof($handle)) {
                $chunk = fread($handle, $chunkSizeBytes);
                $status = $media->nextChunk($chunk);

                if ($status && $status->getId()) {
                    $uploadedVideoId = $status->getId();
                }
            }
            fclose($handle);

            $client->setDefer(false);
        }

        $dataStore = [
            'judul'=> $request->judul,
            'slug'=> $this->generateSlug($request->judul),
            'deskripsi'=> $request->deskripsi,
            'konten'=> $request->konten,
            'kategori'=> $request->kategori,
            'status'=> $request->status,
            'thumbnail' => isset($image_name) ? $image_name : null,
            'user_id' => $user->id,
            'youtube_video_id' => $uploadedVideoId
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
        $apiKey = env('GOOGLE_API_KEY');
        $user = Auth::user();
        $youtubeId = $post->youtube_video_id;
        $googleToken = $user->google_token;
        
        $client = new Client();
        $client->setAuthConfig(base_path('google-oauth-client.json'));
        $client->setDeveloperKey($apiKey);
        $client->addScope(Youtube::YOUTUBE, Youtube::YOUTUBE_FORCE_SSL, Youtube::YOUTUBE_CHANNEL_MEMBERSHIPS_CREATOR);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        
        $client->setAccessToken([
            'access_token' => $googleToken,
        ]);

        $service = new Youtube($client);
        $snippet = new VideoSnippet();
        $video_youtube_data = new Video();
        
        if($request->kategori == 'artikel') {
            $request->validate(
                [
                    'judul' => 'required',
                    'konten' => 'required',
                    'thumbnail' => 'image|mimes:jpeg,jpg,png,JPG,JPEG|max:10240',
                    'kategori' => 'required',
                ],
                [
                    'judul.required'=> 'Judul wajib diisi',
                    'konten.required'=> 'Konten artikel wajib diisi',
                    'thumbnail.image'=> 'Hanya gambar yang diperbolehkan',
                    'thumbnail.mimes'=> 'Format gambar hanya JPEG, JPG dan PNG',
                    'thumbnail.max'=> 'Size maksimum 10MB',
                    'kategori.required'=> 'Wajib memilih kategori',
                ]
            );
        } else {
            $request->validate(
                [
                    'judul' => 'required',
                    'deskripsi' => 'required',
                    'kategori' => 'required',
                    'video_url' => 'file|mimetypes:video/mp4,video/avi,video/mkv|max:150000', // Maks 150MB
                ],
                [
                    'judul.required'=> 'Judul wajib diisi',
                    'deskripsi.required'=> 'Deskripsi video wajib diisi',
                    'kategori.required'=> 'Wajib memilih kategori',
                    'video_url.mimetypes' => 'Format video hanya MP4, AVI, atau MKV',
                    'video_url.max' => 'Ukuran maksimum video adalah 150MB',
                ]
            );
        }

        // update gambar
        if($post->kategori == 'artikel' && $request->hasFile('thumbnail')){
            if(isset($post->thumbnail) && file_exists(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail)) {
                unlink(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail);
            }

            # untuk host infinityfree
            // if(isset($post->thumbnail) && file_exists(base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')) . '/' . $post->thumbnail)) {
            //     unlink(base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')) . '/' . $post->thumbnail);
            // }

            $image = $request->file('thumbnail');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $path_location = base_path('../' . getenv('THUMBNAILS_LOCATION'));
            # untuk hosting di infinityfree
            // $path_location = public_path(env('THUMBNAILS_LOCATION')); 
            $image->move($path_location, $image_name);
        };

        if($post->kategori == 'video') {
            // Mendapatkan detail snippet untuk pra-edit
            $response = $service->videos->listVideos(
                'snippet',
                ['id' => $youtubeId]
            );
            
            $video = $response[0];
            $snippet = $video->snippet;

            $video_youtube_data->setId($youtubeId);
            $snippet->setTitle($request->judul);
            $snippet->setDescription(Str::of($request->deskripsi)->stripTags());
            $video_youtube_data->setSnippet($snippet);  
            
            $response = $service->videos->update('snippet', $video_youtube_data);
        }

        $dataUpdate = [
            'judul'=> $request->judul,
            'slug'=> $this->generateSlug($request->judul, $post->id),
            'deskripsi'=> $request->deskripsi,
            'konten'=> $request->konten,
            'status'=> $request->status,
            'thumbnail' => isset($image_name) ? $image_name : $post->thumbnail,
        ];

        Post::where('id', $post->id)->update($dataUpdate);
        
        return redirect()->route('admin.blogs.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $user = Auth::user();
        $client = new Client();
        $service = new Youtube($client);
        $apiKey = env('GOOGLE_API_KEY');
        $googleToken = $user->google_token;
        $youtubeId = $post->youtube_video_id;

        $client->setAuthConfig(base_path('google-oauth-client.json'));
        $client->setDeveloperKey($apiKey);
        // $client->addScope(Youtube::YOUTUBE, Youtube::YOUTUBE_FORCE_SSL, Youtube::YOUTUBE_CHANNEL_MEMBERSHIPS_CREATOR);
        // $client->setAccessType('offline');
        // $client->setApprovalPrompt('force');

        $client->setAccessToken([
            'access_token' => $googleToken,
        ]);

        if(isset($post->thumbnail) && file_exists(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail)) {
            unlink(public_path(getenv('THUMBNAILS_LOCATION')) . '/' . $post->thumbnail);
        }

        if(isset($post->video_url) && file_exists(public_path(getenv('VIDEOS_LOCATION')) . '/' . $post->video_url)) {
            unlink(public_path(getenv('VIDEOS_LOCATION')) . '/' . $post->video_url);
        }

        # untuk host infinityfree
        // if(isset($post->thumbnail) && file_exists(base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')) . '/' . $post->thumbnail)) {
        //     unlink(base_path('../' . env('THUMBNAILS_LOCATION', 'upload/thumbnails')) . '/' . $post->thumbnail);
        // }

        // if(isset($post->video_url) && file_exists(base_path('../' . env('VIDEOS_LOCATION', 'upload/videos')) . '/' . $post->video_url)) {
        //     unlink(base_path('../' . env('VIDEOS_LOCATION', 'upload/videos')) . '/' . $post->video_url);
        // }

        # hapus video di youtube
        if(isset($youtubeId)) {
            $service->videos->delete($youtubeId);
        }

        Post::where('id', $post->id)->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Data berhasil dihapus!');
    }

    private function generateSlug($judul, $id = null) {
        $slug = Str::slug($judul);

        # mengecek tabel post,
        # jika slug yang akan digenerate berasal dari id yang berbeda maka akan menambahkan count
        # jika berada pada id yang sama maka tidak akan menambahkan count nya
        $count = Post::where('slug', $slug)->when($id, function($query, $id){
            return $query->where('id', '!=', $id);
        })->count();

        if($count > 0) {
            $slug = $slug . "-" . ($count + 1);
        }

        return $slug;
    }
}