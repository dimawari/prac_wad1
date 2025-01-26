<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm(){

        return view('auth.register');

    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:16|min:8|confirmed',
            'role' => 'sometimes|string|in:user,admin'
            
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'user'
        ]);

        Auth::login(User::where('email', $validated['email'])->first());

        return redirect()->route('showDashboard')
            ->with ('success', 'registration successful!');
    }

    public function showloginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (Auth::attempt($credentials)) {

            Auth::login($user);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'There is no account found with this email address!'
                ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'password' => 'Incorrect Password!'
            ]);
    }

    public function showDashboardPage()
    {
        return view('auth.dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('showLoginForm')
            ->with('success', 'Logged out successfully!');
    }
    
}