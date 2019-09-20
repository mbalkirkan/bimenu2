<?php

namespace Bimenu\Http\Controllers;

use Bimenu\Sale;
use Carbon\Carbon;
use function Sodium\add;
use Illuminate\Http\Request;
use Bimenu\User;
use Illuminate\Support\Facades\Auth;

class SocketPostController extends Controller
{
    public $successStatus = 200;
    public function socketAddPrice(Request $request){
        $user = Auth::user();
        if($request->products!="1") {
        $room_floor= $user->room_floor;
        //$products = ['veri1'=>$user->room_no,'veri2'=>json_decode($request->products),'veri3'=>Carbon::now()->toTimeString()];
        $totalprice=$request->total_price;


            $get_sellers=User::where('seller_floor','like','%'.$room_floor.'%')->where('seller','1')->get();
            $sellersid=array();
            foreach ($get_sellers as $users) {
                array_push($sellersid,$users->id);
                $this->sendnotification($users->notification_token,'message',"Yeni Sipariş Geldi !");
            }


        $Saleid=Sale::create(['user_id'=>$user->id,'seller_id'=>'0','sended_sellers'=>json_encode($sellersid),'room_no'=>$user->room_no,'products'=>$request->products,'total_price'=>$totalprice,'status'=>'0','note'=>$request->note])->id;
//            foreach ($get_sellers as $users) {
//                // broadcast(new \Bimenu\Events\PrivateEvent($user, $newData));
//                $this->sendnotification($users->notification_token,'message',"Yeni Sipariş Geldi !");
//            }

        }

    $input = Sale::where('user_id', $user->id)->where('status','0')->orderBy('id', 'desc')->get();


        if($request->type=="all")
        {
            $input = Sale::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        }

    $newData = Array();
    foreach ($input as $item) {
        $nestData["id"] = $item->id;
        $nestData["seller_id"] = $item->seller_id;
        $nestData["products"] = json_decode($item->products);
        $nestData["total_price"] = $item->total_price;
        $nestData["status"] = $item->status;
        $nestData["room_no"] = $item->room_no;
        $nestData["note"]=$item->note;
        $nestData["date"] = date( 'H:i:s',strtotime($item->created_at));
        $newData[] = $nestData;

    }

///////
        if($request->products!=1) {

      return response()->json(['status'=>$this-> successStatus,'user_id'=>$user->id,'user_coins'=>$user->coins,'id'=>$Saleid,'sellers'=>$get_sellers,'sales'=>$newData]);

  }
  else {
      return response()->json(['status'=>$this-> successStatus,'sales'=>$newData,'user_id'=>$user->id,'user_coins'=>$user->coins]);

  }
    }


    public function socketPushPrice(Request $request){
        $user = Auth::user();

        $input = Sale::find($request->id);
        $input->seller_id = $user->id;
        $input->status = 1;
        $price_total=$input->total_price;
        $price_user=$input->user_id;
        $input->save();

        $input2 = User::find($price_user);
        $input2->coins=$input2->coins-$price_total;
        $user_token=$input2->notification_token;
        $input2->save();

        $get_sellers=Sale::where('sended_sellers','like','%'.$user->id.'%')->where('status','0')->orderBy('id', 'desc')->get();


        $newData = Array();
        foreach ($get_sellers as $item) {
            $nestData["id"] = $item->id;
            $nestData["user_id"] = $item->seller_id;
            $nestData["products"] = json_decode($item->products);
            $nestData["total_price"] = $item->total_price;
            $nestData["status"] = $item->status;
            $nestData["room_no"] = $item->room_no;
            $nestData["note"]=$item->note;
            $nestData["date"] = date( 'H:i:s',strtotime($item->created_at));
            $newData[] = $nestData;

        }
        $this->sendnotification($user_token,'pushed','Sipariş Tamamlandı');

        return response()->json(['status'=>$this-> successStatus,'sales'=>$newData]);

    }


    public function socketGettPrice(Request $request){
        $user = Auth::user();


        $get_sellers=Sale::where('sended_sellers','like','%'.$user->id.'%')->where('status','0')->orderBy('id', 'desc')->get();


        $newData = Array();
        foreach ($get_sellers as $item) {
            $nestData["id"] = $item->id;
            $nestData["user_id"] = $item->seller_id;
            $nestData["products"] = json_decode($item->products);
            $nestData["total_price"] = $item->total_price;
            $nestData["status"] = $item->status;
            $nestData["room_no"] = $item->room_no;
            $nestData["note"]=$item->note;
            $nestData["date"] = date( 'H:i:s',strtotime($item->created_at));
            $newData[] = $nestData;

        }
            return response()->json(['status'=>$this-> successStatus,'sales'=>$newData]);
    }
    public function sendnotification($token,$type,$body)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
      // $token='caaHZgwe_MQ:APA91bG1xyjhO5-ryEWRJcne7F6zljuBbztAxmQ8lZbfF9iZPCqVh9OsCV2NqXuKlLjsQmiU8-OpPUP9gw1AHxdojHbZgR2Jkaq-SQoAjsnrn6uNQjcuBw0BqzzuTPYn3cyQvNIX90oN';
//$token='f4gjc4zD82Q:APA91bH7wgcKTckNprOgdFzp6QtrqLIR6rhxkR9XX5ASwIMkkLm3mJOjDge6QAV7UQLt3vYzC3gVLbKgsEjAuMwEm8G0KqnmP3EaT4Dc9wiC80MM7nBL8MR0UfDLBE7j_LssjC-H0cU-';

        $notification = [
            'type' => $type,
            'title' => 'Çaycı',
            'body' => $body,
            'sound' => true,
            'icon' => 'http://www.iconarchive.com/download/i106896/goodstuff-no-nonsense/free-space/space-ship.ico',
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


      //  dd($result);
    }

    public function socketPost(Request $request){
//        $data['veri1']=$request->veri1;
//        $data['veri2']=$request->veri1;
//        $data['veri3']=$request->veri1;

        $user = Auth::user();
//
//       $room_floor= $user->room_floor;
//
//       $get_tokens=User::where('tea_seller_floor','like','%'.$room_floor.'%')->where('tea_seller','1')->get(['notification_token']);
//
//
//        $products = $request->products();
//
//
//        $id=Sale::create(['user_id'=>$user->id,'seller_id'=>'0','products'=>$products,'total_price'=>$request->totalprice])->id;
//

        //return response()->json(['status'=>$this-> successStatus,'id'=>$id]);


        $data = ['veri1'=>$request->veri1,'veri2'=>$request->veri2,'veri3'=>$request->veri3];
        $user = User::find(5);
       // return $get_tokens;
     //   broadcast(new \Bimenu\Events\PrivateEvent($user,$data));
    }
}
