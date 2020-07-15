<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class JamaahWeb
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
        if(!Auth::check()){
            return redirect()->route('login');
        }

        if(Auth::user()->role == 1){ // role 1 adalah admin
            return redirect()->route('admin.index');
        }else if(Auth::user()->role == 2){ //role 2 adalah pengurus
            return redirect()->route('pengurus.index');
        }else if(Auth::user()->role == 3){
            return $next($request);
        }
    }
}
