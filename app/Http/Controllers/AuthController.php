<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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
            'username' => 'required|string',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!'
        ]);

        if (Auth::attempt($validatedData, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            return redirect()->intended('/')
                ->with('success', "Selamat datang kembali, {$user->fullname}! 👋");
        }

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password yang Anda masukkan salah. Silakan coba lagi! 🔒');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users|alpha_dash',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password2' => 'required|string|min:8|same:password',
        ], [
            'username.required' => 'Username wajib diisi!',
            'username.unique' => 'Username sudah digunakan!',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, dash dan underscore!',
            'firstname.required' => 'Nama depan wajib diisi!',
            'firstname.max' => 'Nama depan terlalu panjang!',
            'lastname.required' => 'Nama belakang wajib diisi!',
            'lastname.max' => 'Nama belakang terlalu panjang!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
            'password2.same' => 'Konfirmasi password tidak cocok!'
        ]);

        $validatedData['fullname'] = $validatedData['firstname'] . ' ' . $validatedData['lastname'];
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['image'] = 'https://ui-avatars.com/api/?name=' . urlencode($validatedData['fullname']) . '&background=random&color=ffffff';

        User::create($validatedData);

        return redirect()
            ->route('auth.login')
            ->with('success', 'Selamat! Akun Anda berhasil dibuat. Silakan login untuk melanjutkan. 🎉');
    }

    public function logout(Request $request)
    {
        $fullname = Auth::user()->fullname;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('front.index')
            ->with('success', "Sampai jumpa kembali, {$fullname}! 👋");
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
}