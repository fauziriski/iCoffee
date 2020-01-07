<?php

namespace App\Http\Middleware;

use Closure;
use Alert;
use Illuminate\Support\Facades\Session;


class Admin
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
        if(empty(Session::has('adminSession'))){
            Alert::info('Silahkan login dahulu!')->autoClose(2000);
            return redirect('/');
        }
        return $next($request);
    }
}