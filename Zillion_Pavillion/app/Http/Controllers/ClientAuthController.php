<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('client.dashboard');
        }
        return view('client-login');
    }

    public function showRegisterForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('client.dashboard');
        }
        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Try login with username
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Update last login
            Auth::guard('web')->user()->update(['last_login' => now()]);

            return redirect()->intended(route('client.dashboard'));
        }

        // Try login with email
        $emailCredentials = [
            'email' => $credentials['username'],
            'password' => $credentials['password'],
        ];

        if (Auth::guard('web')->attempt($emailCredentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Update last login
            Auth::guard('web')->user()->update(['last_login' => now()]);

            return redirect()->intended(route('client.dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:clients,username',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:6|confirmed',
            'full_name' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $client = Client::create($validated);

        Auth::guard('web')->login($client);

        return redirect()->route('client.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
