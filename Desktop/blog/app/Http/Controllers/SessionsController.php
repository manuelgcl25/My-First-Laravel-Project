<?php

namespace App\Http\Controllers;

use App\Models\User;

class SessionsController extends Controller
{
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        {
            $attributes = request()->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);


            // attempt to authenticate and log in the user
            // based on the provided credentials
            if (auth()->attempt($attributes)) {
                //session fixation
                session()->regenerate();



                //redirect with a success flash meesage
                return redirect('/')->with('success', 'Welcome Back!');;
            }

            //auth failed
            return back()
                ->withInput()
                ->withErrors(['email' => 'Your provided credentials could not be verified']);
        }
    }
}
