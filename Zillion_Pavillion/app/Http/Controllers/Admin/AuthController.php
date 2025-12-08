<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::guard('staff')->check()) {
            return redirect()->route('staff.dashboard');
        }
        return view('login'); // Unified login page for both admin and staff
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        // Try admin login first
        $adminCredentials = [
            $field => $login,
            'password' => $request->input('password')
        ];

        if (Auth::guard('admin')->attempt($adminCredentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            Auth::guard('admin')->user()->update(['last_login' => now()]);
            return redirect()->intended(route('admin.dashboard'));
        }

        // Try staff login
        if (Auth::guard('staff')->attempt($adminCredentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            Auth::guard('staff')->user()->update(['last_login' => now()]);
            return redirect()->intended(route('staff.dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
