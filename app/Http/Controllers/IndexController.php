<?php

namespace Bimenu\Http\Controllers;

use Bimenu\Customer;
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
    public function __construct()
    {

    }
    public function index(Request $request)
    {
        $agent = new Agent();

      //  dd($agent->isMobile());
       // Auth::loginUsingId(1);
      //  $request->session()->flush();

        return view('mobile.index');
    }
    public function session(Request $request)
    {
        return view('mobile.session');
    }
    public function session_flush(Request $request)
    {
        $request->session()->flush();
        return view('mobile.session');
    }
    public function session_save(Request $request)
    {
        $flight = new Customer;
        $flight->name = $request->name;
        $flight->surname = $request->name;
        $flight->phone = $request->phone;
        $flight->save();

        if($flight) {
            $request->session()->put('user.id', $flight->id);
            $request->session()->put('user.name', $request->name);
            $request->session()->put('user.surname', $request->surname);
            $request->session()->put('user.phone', $request->phone);
            return view('mobile.index');
        }
        else{
            return 400;
        }
    }
    public function session_login(Request $request)
    {
        $user = Customer::where('phone', '=', $request->phone)->first();
        if ($user === null) {
            return 400;
        }
        else{
            $request->session()->put('user.id', $user->id);
            $request->session()->put('user.name', $user->name);
            $request->session()->put('user.surname', $user->surname);
            $request->session()->put('user.phone', $user->phone);
            return redirect()->route('mobile.index');
        }
    }
}
