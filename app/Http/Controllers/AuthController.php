<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('pages.login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors(['loginError' => 'Неверный email или пароль.']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function registerPage()
    {
        return view('pages.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::query()->create($request->validated());
        auth()->loginUsingId($user->id);
        return redirect()->route('home');
    }
}
