<?php

namespace Bimenu\Http\Controllers;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    public function index(Request $request)
    {
        $agent = new Agent();

      //  dd($agent->isMobile());
       // Auth::loginUsingId(1);

        return view('mobile.index');
    }
}
