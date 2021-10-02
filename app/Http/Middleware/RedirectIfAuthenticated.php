<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $jobTitle=Auth::user()['jobTitle'];

                // NOTA: Modificar según este hecho el perfil del usuario
                if('administrador'==  $jobTitle){
                    return redirect()->route('companies.index');
                }elseif('gerente'==  $jobTitle){
                    return redirect()->route('branchoffices.index');
                }elseif('supervisor'==  $jobTitle){
                    return redirect()->route('branchoffices.supervisor');
                }elseif('empleado'==  $jobTitle){
                    return redirect()->route('appointments.employee');
                }   
            }
        }

       
        return $next($request);
    }
}
