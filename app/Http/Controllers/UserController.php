<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show register form

    public function register(){
        return view('auth.register', [
            'page_title' => 'WELS|Register'
        ]);
    }

    //Store registration information

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:6'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8'
        ]);

        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //create user
        $user = User::create($formFields);

        //login user

        auth()->login($user);

        return redirect('/')->with('message','Account registered Successfully!');
    }

    //display login form


    public function login(){
        return view('auth.login', [
            'page_title' => 'WELS|Login'
        ]);
    }


     //authenticate user

     public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message','You are now logged in');
        }

        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');

    }



    //logout user

    public function logout(Request $request){
        auth()->logout();

        $request ->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }


    //delete user

    public function destroy(User $user){
        $user->delete();

        return back()->with('message', 'User deleted!');
    }
}
