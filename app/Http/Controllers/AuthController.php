<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        if (Auth::attempt($request->validate(User::$rules))) {
            $request->session()->regenerate();

            return redirect()->intended('people');
        }

        return redirect()->route('auth')->with('failed', 'Wrong Email or Password!');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
