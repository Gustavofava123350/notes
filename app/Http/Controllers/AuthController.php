<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        //form validation
        $request->validate(
            //rules
            [
                 'email' => 'required|email',
                 'password' => 'required|min:7|max:29'
            ],
            //error message
            [
                'email.required' => 'O email é obrigatorio',
                'email.email' => 'Email tem que ser valido',
                'password.required' => 'O senha é obrigatorio',
                'password.min' => 'A senha deve ter pelo menos  :min caracteres',
                'password.max' => 'A senha de conter no máximo :max caracteres'
            ]
       );
        //get user input
        $email = $request->input('email');
        $password = $request->input('password');

        // check if user exits
        $user  = User::where('email', $email)->where('deleted_at', NULL)->first();

        if(!$user){
            return redirect()
                  ->back()
                  ->withInput()
                  ->with('loginError', 'Email ou senha incorretos');
        }
        echo '<pre>';
        print_r($user);

    }

    public function logout()
    {
        echo 'Logout';
    }



}
