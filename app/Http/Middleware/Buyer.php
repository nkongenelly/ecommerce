<?php

namespace App\Http\Middleware;

use Closure;

class Buyer
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
        if($request->user() && $request->user()->usertype_id == '1'){
            return redirect('home')->with('error','You do not have admin access');
            // return new Response(view('unauthorised access'->with('user_type','ADMIN'));
        }
        return $next($request); 
    }
}
