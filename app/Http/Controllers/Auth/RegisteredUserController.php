<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'streetname' => 'required|string|max:255',
            'streetnumber' => 'required|string|max:8',
            'plz' => 'required|integer|digits:4',
            'city' => 'required|string|max:255',
        ]);

        Auth::login($user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'streetname' => $request->streetname,
            'streetnumber' => $request->streetnumber,
            'plz' => $request->plz,
            'city' => $request->city,
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
