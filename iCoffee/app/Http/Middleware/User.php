<?php

namespace App\Http\Middleware;

use Closure;
use Alert;
use Illuminate\Support\Facades\Session;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(Session::has('userSession'))){
            Alert::info('Silahkan login dahulu!')->autoClose(2000);
            return redirect('masuk');
        }
        return $next($request);
    }
}
