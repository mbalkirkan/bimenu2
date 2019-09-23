<?php

namespace Bimenu\Http\Middleware;

use Bimenu\Order;
use Closure;

class CheckOrder
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
        $user = Order::where('customer_id', '=', $request->session()->get('user.id'))->where('status', 0)->first();
        if ($user == null) {
            return redirect()->route('mobile.index');
        }
        return $next($request);


    }
}
