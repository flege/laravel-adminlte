<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
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
        if(Auth::check()){
            $roles = array_slice(func_get_args(), 2);
            if(count($roles)>0){
                foreach($roles as $role){
                    if($request->user()->role==$role){
                        return $next($request);
                    }
                }
                return abort(404);
            }else{
                return $next($request);
            }
        }else{
            return abort(404);
        }
    }
}
