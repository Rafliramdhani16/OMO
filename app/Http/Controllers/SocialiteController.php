<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // Google Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $socialUser->id)->first();

            if (!$user) {
                $user = User::create([
                    'google_id' => $socialUser->id,
                    'fullname' => $socialUser->name,
                    'username' => explode('@', $socialUser->email)[0],
                    'email' => $socialUser->email,
                    'password' => Hash::make('password' . $socialUser->email . $socialUser->id . time()),
                    'image' => $socialUser->avatar,
                    'google_token' => $socialUser->token,
                    'google_refresh_token' => $socialUser->refreshToken,
                ]);
            }

            Auth::login($user);

            return redirect()->intended('/')
                ->with('success', "Selamat datang kembali, {$user->fullname}! 👋");
                
        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi!');
        }
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
                
                $user = User::firstOrCreate(
                    ['email' => $data['data']['email']],
                    [
                        'fullname' => $data['data']['fullname'],
                        'username' => explode('@', $data['data']['email'])[0],
                        'image' => $data['data']['image'],
                        'password' => Hash::make('password' . $data['data']['email'] . $data['data']['uuid'] . time()),
                    ]
                );

                Auth::login($user);
                return redirect()->intended('/')
                    ->with('success', "Selamat datang kembali, {$user->fullname}! 👋");

            } catch (Exception $e) {
                return redirect()->route('login')
                    ->with('error', "Terjadi kesalahan saat login dengan DiAkun. Silakan coba lagi!");
            }
        }
        return redirect('/login');
    }
}