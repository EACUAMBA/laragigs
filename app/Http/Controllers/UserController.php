<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show register create form
    public function create(){
        return view('users.register');
    }

    //Create new User
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        //Hashing password
        $formFields['password'] = bcrypt($formFields['password']);

        //Creating user
        $user = User::create($formFields);

        //Login
        Auth::login($user);

        return redirect(route('listings.index'))->with('message', 'User created successfully!');

    }

    //Logout
    public function logout(Request $request){
        Auth::logout();

        //
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('listings.index'))->with('message', 'You have been logout!');
    }

    //Show login form
    public function login(){
        return view('users.login');
    }

    //Authenthicate user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($formFields)){
            $request->session()->regenerate();
            return redirect(route('listings.index'))->with(['message' => 'you are logged in!']);
        }else{
            return back()->withErrors(['email'=> 'Invalid credencials']);
        }
    }


}
