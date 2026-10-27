<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    public function findAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $user = User::where('email', $request->email)
                    ->where('role', 'admin')
                    ->first();

        if (!$user) {
            return back()
                ->withInput()
                ->with('error', 'Email tidak ditemukan atau bukan akun admin.');
        }

        return back()
            ->with('found', true)
            ->with('found_name', $user->name)
            ->with('email', $request->email);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required'  => 'Sandi baru wajib diisi.',
            'password.min'       => 'Sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi sandi tidak cocok.',
        ]);

        $user = User::where('email', $request->email)
                    ->where('role', 'admin')
                    ->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->with('error', 'Akun tidak ditemukan.');
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login')
            ->with('success', 'Sandi berhasil diperbarui! Silakan masuk dengan sandi baru.');
    }
}
