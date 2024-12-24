<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $rules = [
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,' . $user->id,
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email,' . $user->id,
        ];

        if ($request->file('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validatedData = $request->validate($rules, [
            'username.required' => 'Username wajib diisi!',
            'username.unique' => 'Username sudah digunakan!',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, dash dan underscore!',
            'firstname.required' => 'Nama depan wajib diisi!',
            'lastname.required' => 'Nama belakang wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'image.image' => 'File harus berupa gambar!',
            'image.max' => 'Ukuran gambar maksimal 2MB!'
        ]);

        // Combine firstname and lastname into fullname
        $validatedData['fullname'] = $validatedData['firstname'] . ' ' . $validatedData['lastname'];

        if ($request->file('image')) {
            // Delete old image if exists and not a URL or default avatar
            if ($user->image && !str_starts_with($user->image, 'http') && !str_starts_with($user->image, 'https://ui-avatars.com')) {
                Storage::delete('public/' . $user->image);
            }
            $validatedData['image'] = $request->file('image')->store('avatar', 'public');
        }

        User::where('id', $user->id)->update($validatedData);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui! 👤');
    }

    public function removeImage()
    {
        $user = Auth::user();

        // Delete existing image if it's not a URL or default avatar
        if ($user->image && !str_starts_with($user->image, 'http') && !str_starts_with($user->image, 'https://ui-avatars.com')) {
            Storage::delete('public/' . $user->image);
        }

        // Set default avatar
        $defaultImage = 'https://ui-avatars.com/api/?name=' . urlencode($user->fullname) . '&background=random&color=ffffff';
        
        $user->update([
            'image' => $defaultImage
        ]);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Foto profil berhasil dihapus! 🗑️');
    }

    public function showChangePassword()
    {
        return view('profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|different:current_password',
            'password_confirmation' => 'required|same:password'
        ], [
            'current_password.required' => 'Password lama wajib diisi!',
            'password.required' => 'Password baru wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
            'password.different' => 'Password baru harus berbeda dengan password lama!',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi!',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok!'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai!'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Password berhasil diubah! 🔒');
    }
}