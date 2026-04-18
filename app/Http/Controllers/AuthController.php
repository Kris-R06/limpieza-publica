<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function register(){
        #Validar los datos de registro
        $validatedData = request()->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);
        #Crear el usuario
        $user = \App\Models\User::create([
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'username' => $validatedData['email'],
            'user_type' => 'user',
        ]);

        return redirect()->route('login');
    }

    public function login(){
        $credentials = request()->validate([
            'email'=>'required|string|email',
            'password'=>'required|string',
        ]);
        if (auth()->attempt($credentials)){
            request()->session()->regenerate();
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email'=>'Las credenciales no son correctas.',
        ]);
    }
    
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
