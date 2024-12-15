<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use Illuminate\Auth\Events\PasswordReset;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

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
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('error', 'Email atau password salah');
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
        ]);

        $validatedData['image'] = 'https://ui-avatars.com/api/?name=' . $validatedData['name'] . '&background=random';


        User::create($validatedData);

        return redirect()->route('auth.login')->with('success', 'Pendaftaran berhasil, silahkan login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Anda sudah logout');
    }


    public function showForgetPassword()
    {
        return view('auth.lupapassword');
    }

    public function forgetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email:rfc,dns'
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if ($user) {
            $status = Password::sendResetLink([
                'email' => $validatedData['email']
            ]);

            // Cek status pengiriman
            if ($status === Password::RESET_LINK_SENT) {
                return redirect()->to('/forget')->with('success', 'Link reset password telah dikirim ke email Anda.');
            } else {
                return redirect()->to('/forget')->with('error', 'Terjadi kesalahan saat mengirim link reset password.');
            }
        }

        return redirect()->to('/forget')->with('error', 'Email tidak ditemukan.');
    }

    public function showResetPassword(Request $request)
    {

        $data = [
            'token' => $request->query('token'),
            'email' => $request->query('email'),
        ];
        return view('auth.ubahpassword', $data);
    }

    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password2' => 'required|min:8|same:password',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password2', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function showEditProfile()
    {
        return view('auth.editprofile');
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
}
