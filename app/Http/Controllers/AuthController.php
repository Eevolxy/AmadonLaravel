<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLogin() {
        return view("auth.login");
    }

    public function login(Request $request) {
        $formFields = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if(Auth::attempt($formFields)) {
            $request->session()->regenerate();

            // Merge guest cart into user cart
            CartController::mergeGuestCart();

            return redirect()->intended("/");
        }

        return back()->withErrors([
            "email" => "Identifiants invalides.",
        ])->onlyInput("email");
    }

    public function showRegister() {
        return view("auth.register");
    }

    public function register(Request $request) {
        $formFields = $request->validate([
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
            "name" => "required",
        ]);

        $user = User::create($formFields);
        event(new Registered($user));
        Auth::login($user);

        // Merge guest cart into user cart
        CartController::mergeGuestCart();

        return redirect()->intended("/");
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
