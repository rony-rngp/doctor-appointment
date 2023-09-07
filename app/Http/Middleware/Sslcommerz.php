<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Sslcommerz
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->merge(['_token'=>$request->value_a]);
        if(!Auth::guard('patient')->check()){
            $patient = \App\Models\Patient::findOrFail($request->value_b);
            Auth::guard('patient')->login($patient);
        }
        return $next($request);
    }
}
