<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (auth()->user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/member/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        $designations = Designation::where('is_active', true)->get();
        return view('auth.register', compact('designations'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'designation_id' => 'nullable|exists:designations,id',
            'referred_by_code' => 'nullable|string|exists:users,referral_code',
        ]);

        $referred_by = null;
        if ($request->referred_by_code) {
            $referred_by = User::where('referral_code', $request->referred_by_code)->first();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'member',
            'designation_id' => $request->designation_id,
            'referred_by_id' => $referred_by ? $referred_by->id : null,
            'referral_code' => strtoupper(Str::random(10)),
        ]);

        Auth::login($user);

        return redirect('/member/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
