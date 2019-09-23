<?php

namespace Bimenu\Http\Middleware;

use Closure;

class CheckOnSession
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
        if ($request->session()->exists('user')) {
            return redirect()->route('mobile.index');
        }
        return $next($request);


    }
}
