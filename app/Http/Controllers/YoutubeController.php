<?php

namespace App\Http\Controllers;

use Google\Client;
use Illuminate\Http\Request;

class YoutubeController extends Controller {
    public function getClient() {
        $client = new Client();
        $client->setAuthConfig(base_path('youtube-services.json'));
        $client->addScope('https://www.googleapis.com/auth/youtube.upload');
        $client->setRedirectUri('http://localhost:8000/dashboard/youtube/callback');

        // Mengatur access type ke offline untuk mendapatkan refresh token
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        return $client; 
    }

    public function authenticate() {
        $client = $this->getClient();
        $authUrl = $client->createAuthUrl();
        
        return redirect($authUrl);
    }

    public function callback(Request $request) {
        $client = $this->getClient();
        $token = $client->fetchAccessTokenWithAuthCode($request->code);
        session(['youtube_access_token' => $token]);

        return redirect()->route('admin.blogs.index')->with('success', 'Authentication Youtube successful!');
    }
}