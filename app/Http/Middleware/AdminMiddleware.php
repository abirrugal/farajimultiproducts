<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        if (auth()->user()->role_as === 'admin') {
            return $next($request);
            
        }else{
            session()->flash('type','danger');
            session()->flash('message','You are not allowed to access the Dashboard');
            return redirect()->route('frontend.product.index');
        }
        
    }
}
