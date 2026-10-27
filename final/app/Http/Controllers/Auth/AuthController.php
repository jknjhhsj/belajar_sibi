<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function showLogin() {
        if (Auth::check()) { return $this->redirectByRole(auth()->user()->role); }
        return view('auth.login');
    }

    private function redirectByRole(string $role) {
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru'  => redirect()->route('guru.dashboard'),
            default => redirect()->route('siswa.dashboard'),
        };
    }
    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);
        if (Auth::attempt($request->only('email','password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            ActivityLog::create(['user_id'=>$user->id,'tipe'=>'login','deskripsi'=>'Masuk ke aplikasi']);
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success','Selamat datang, Admin! 👋');
            }
            if ($user->role === 'guru') {
                return redirect()->route('guru.dashboard')->with('success','Selamat datang, '.$user->name.'! 👋');
            }
            return redirect()->route('siswa.dashboard')->with('success','Halo, '.$user->name.'! Selamat belajar! 🎉');
        }
        return back()->withInput($request->only('email'))
                     ->withErrors(['email' => 'Email atau password salah.']);
    }
    public function showRegister() {
        if (Auth::check()) { return $this->redirectByRole(auth()->user()->role); }
        return view('auth.register');
    }
    public function register(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'kelas'    => 'nullable|string|max:50',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah terdaftar. Coba masuk!',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);
        $user = User::create([
            'name'     => $request->name,
            'kelas'    => $request->kelas,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
            'status'   => 'aktif',
        ]);
        Auth::login($user);
        ActivityLog::create(['user_id'=>$user->id,'tipe'=>'login','deskripsi'=>'Mendaftar dan masuk pertama kali']);
        return redirect()->route('siswa.dashboard')->with('success','Akun berhasil dibuat! Selamat belajar, '.$user->name.'! 🚀');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Sampai jumpa! 👋');
    }
}
