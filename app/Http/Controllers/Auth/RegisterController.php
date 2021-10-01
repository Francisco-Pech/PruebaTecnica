<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
       $credentials = $request->only('name','lastName',
       'age','email','telephone','username',
       'password', 'repeatPassword');

       $validation= Validator::make($credentials,[
           'name'=>'required|string',
           'lastName'=>'required|string',
           'age'=>'required|integer',
           'email'=>'required|string',
           'telephone'=>'required|string',
           'username'=>'required|string',
           'password'=>['required',
            Password::min(4)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
           'repeatPassword'=>'required|same:password',
       ]);

       if($validation->fails()){
           return redirect()->route('registers.form')
           ->withErrors($validation)
           ->withInput();
       }
       
       $user=User::where('username',$credentials['name'])->exists();
       
       if(!$user){
            User::create([
                'name' => $credentials['name'],
                'lastName' => $credentials['lastName'],
                'age' => $credentials['age'],
                'email' => $credentials['email'],
                'telephone' => $credentials['telephone'],
                'jobTitle' => 'administrador',
                'username' => $credentials['username'],
                'password' => Hash::make($credentials['password'])
            ]);
            return redirect()->route('home.index');
       }else{
            return redirect()->route('registers.form');
       }
    }

}
