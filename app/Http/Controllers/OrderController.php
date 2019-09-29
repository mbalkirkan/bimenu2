<?php

namespace Bimenu\Http\Controllers;

use Bimenu\Order;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class OrderController extends Controller
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

    public function sale(Request $request)
    {
        $order = Order::where('customer_id', '=', $request->session()->get('user.id'))->where('status', 0)->first();
        if($order)
        {

//$col= json($order->items_id);
//            foreach ($col as $item) {
//               return $item;
//            }





            $arr_all=array();
            foreach (json_decode($order->items_id) as $key=> $item) {
                $arr_all[$key]=$item;
            }
            foreach ($request->items as $item) {
                $data= collect( $item);
                if(array_search($data['id'],$arr_all))
                {
                   $arr_all[$data['id']]= $arr_all[$data['id']]+$data['quantity'];
                }
                else{
                    $arr_all[$data['id']]=$data['quantity'];
                }
            }

            $order->items_id= json_encode($arr_all);
            $order->notes=$request->note;
            $order->save();
            return 200;
        }
        else{
            return 400;
        }

    }
}
