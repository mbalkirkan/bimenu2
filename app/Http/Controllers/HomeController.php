<?php

namespace Bimenu\Http\Controllers;

use Bimenu\Order;
use Bimenu\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

/*
$order=Order::find(3);
*/
/*
$orders = Order::all();
*/

/*
$orders= Order::where('urun','test');
$orders=$orders->where('id','1');
$orders=$orders->get();
*/

     //  return $orders=Order::where('urun','test')->get()->pluck('urun')->all();


//return response()->json(['data'=>$orders],200);




       $user = User::find(5);
       $veri = ['veri1'=>'Oda1','veri2'=>'Sipariş + Çay + Su + 5 Kola','veri3'=>Carbon::now()->toTimeString()];
        broadcast(new \Bimenu\Events\PrivateEvent($user,$veri));
       // $this->test();



        //return view('home');
    }
    public function test()
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token='eciDPJqNEaY:APA91bEKXPCfS0fN-G0C4NJ7PpdCsrfFkg5MNRj83WcK8cnmj9l0xD1rVNJ7aZc6mQoSCG69Ls_TIW4ZGkfVBp8N4lTk77Y5sdpMTTjGEDKnaQp3lgaFsuYsARf_Kk0GwzBA05d0UN7v';


        $notification = [
            'body' => 'this is test',
            'sound' => true,
        ];

        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AIzaSyC24mlMdSErJiISObRc9WTT7BEvxivMfrA',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        dd($result);
    }
}
