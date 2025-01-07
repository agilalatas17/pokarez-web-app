<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller {
    public function redirect() {
        return Socialite::driver('google')->scopes([
            'https://www.googleapis.com/auth/youtube.upload',
            'https://www.googleapis.com/auth/youtube.readonly'
        ])->with(['access_type' => 'offline', 'prompt' => 'consent'])->redirect();
    }

    public function callback() {
        try{
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // ngecek existing users
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if($user) {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Jika pengguna belum ada, buat pengguna baru
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make('password'), // default kata sandi
                ]);
            }

            Auth::login($user, true);

            return redirect()->route('admin.blogs.index')->with('success', 'Authentication Google successful!');
        } catch(Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}