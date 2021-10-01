<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        $validation= Validator::make($credentials,[
            'username'=>'required|string',
            'password'=>'required|string'
        ]);

        if($validation->fails()){
            return back()
            ->withErrors($validation)
            ->withInput();
        }

        if(Auth::attempt($credentials)){

            $user=Auth::user();

            if('administrador'== ($user->jobTitle)){
                return redirect()->route('companies.index');
            }elseif('gerente'== ($user->jobTitle)){
                return redirect()->route('branchoffices.index');
            }elseif('supervisor'== ($user->jobTitle)){  
                return redirect()->route('users.index');
            }elseif('empleado'== ($user->jobTitle)){  
                return redirect()->route('appointments.index');
            }

        }else{
            return back()->withErrors(['username'=> trans('auth.failed'),'password'=> trans('auth.failed')])->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
