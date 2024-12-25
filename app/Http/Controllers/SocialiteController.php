<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // Google Login
    
        public function redirect() {
            return Socialite::driver('google')->redirect();
        }
    
        public function callback() {
            $socialUser = Socialite::driver('google')->user();
    
    
            $registeredUser = User::where("google_id", $socialUser->id)->first();
    
            if (!$registeredUser) {
                $registeredUser = User::updateOrCreate([
                    'google_id' => $socialUser->id,
                ], [
                    'fullname' => $socialUser->name,
                    'username' => $socialUser->name,
                    'email' => $socialUser->email,
                    'password' => Hash::make('123'),
                    'image' => $socialUser->avatar,
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                ]);
            }
    
            Auth::login($registeredUser);
    
            return redirect('/');
        }

    // DiAkun Login
    public function redirectToDiAkun()
    {
        return redirect()->to("https://sso.bhadrikais.my.id/signin/" . env('TOKEN_DIAKUN'));
    }

    public function handleDiAkunCallback(string $token = null)
    {
        if ($token !== null) {
            try {
                $client = new Client();
                $response = $client->request('POST', 'https://sso.bhadrikais.my.id/otentikasi/login/' . env('TOKEN_DIAKUN'), [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token,
                    ]
                ]);

                $data = json_decode($response->getBody(), true);

                if (!isset($data['data'])) {
                    return redirect()->route('login')
                        ->with('error', 'Data dari server tidak valid.');
                }

                $user = User::firstOrCreate(
                    ['email' => $data['data']['email']],
                    [
                        'fullname' => $data['data']['fullname'],
                        'username' => $data['data']['username'],
                        'image' => $data['data']['image'],
                        'password' => Hash::make(Str::random(16)),
                    ]
                );

                Auth::login($user);

                return redirect()->intended('/')
                    ->with('success', "Selamat datang kembali, {$user->fullname}! 👋");
            } catch (Exception $e) {
                Log::error('DiAkun Login Error: ' . $e->getMessage());
                return redirect()->route('login')
                    ->with('error', 'Terjadi kesalahan saat login dengan DiAkun. Silakan coba lagi!');
            }
        }

        return redirect()->route('login');
    }
}
