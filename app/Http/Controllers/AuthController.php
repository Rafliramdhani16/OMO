<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Exception;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email:rfc,dns',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!'
        ]);

        if (Auth::attempt($validatedData, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            return redirect()->intended('/')
                ->with('success', "Selamat datang kembali, {$user->name}! 👋");
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password yang Anda masukkan salah. Silakan coba lagi! 🔒');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password2' => 'required|string|min:8|same:password',
        ], [
            'name.required' => 'Nama wajib diisi!',
            'name.max' => 'Nama terlalu panjang!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
            'password2.same' => 'Konfirmasi password tidak cocok!'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['image'] = 'https://ui-avatars.com/api/?name=' . urlencode($validatedData['name']) . '&background=random&color=ffffff';

        User::create($validatedData);

        return redirect()
            ->route('auth.login')
            ->with('success', 'Selamat! Akun Anda berhasil dibuat. Silakan login untuk melanjutkan. 🎉');
    }

    public function logout(Request $request)
    {
        $name = Auth::user()->name;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('front.index')
            ->with('success', "Sampai jumpa kembali, {$name}! 👋");
    }

    public function showForgetPassword()
    {
        return view('auth.lupapassword');
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email:rfc,dns'
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam Anda. 📧');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Maaf, kami tidak dapat menemukan akun dengan email tersebut. 😢');
    }

    public function showResetPassword(Request $request)
    {
        return view('auth.ubahpassword', [
            'token' => $request->token,
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
        ], [
            'password.min' => 'Password minimal 8 karakter!',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok!'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function showEditProfile()
    {
        return view('auth.editprofile', [
            'user' => Auth::user()
        ]);
    }

    public function editProfile(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255',
        ];

        if ($request->file('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('avatar');
        }

        User::where('id', Auth::user()->id)->update($validatedData);
        return redirect()->route('auth.profile')->with('success', 'Profile berhasil diubah');
    }


    public function redirectDiAkun()
    {
        return redirect()->to("https://sso.bhadrikais.my.id/signin/" . env('TOKEN_DIAKUN'));
    }


    public function callbackDiakun(string $token = null, Request $request)
    {
        if ($token !== null) {
            try {
                $client = new Client();
                $api = $client->request('POST', 'https://sso.bhadrikais.my.id/otentikasi/login/' . env('TOKEN_DIAKUN'), [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $token,
                    ]
                ]);
                $json = json_decode($api->getBody(), true);
                return $this->loggingIn('diakun', $json);
            } catch (Exception $e) {
                return back()->with('error', "Something wrong!");
            }
        }
        return redirect('/login');
    }

    public function loggingIn(string $app, $data)
    {
        if ($data && $app) {
            if (strtolower($app) == 'diakun') {
                $data = [
                    'name' => $data['data']['fullname'],
                    'image' => $data['data']['image'],
                    'email' => $data['data']['email'],
                    'password' => Hash::make('password' . $data['data']['email'] . $data['data']['uuid'] . time()),
                ];
            }


            $user = User::firstOrCreate([
                'email' => $data['email'],
            ], $data);

            Auth::login($user);
            $user = Auth::user();
            return redirect()->intended('/')
                ->with('success', "Selamat datang kembali, {$user->name}! 👋");
        }

        return back()->with('error', "Something wrong!");
    }
}
