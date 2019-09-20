<?php

namespace Bimenu\Http\Controllers;

use Bimenu\Sale;
use PhpParser\Node\Expr\Array_;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SaleController extends Controller
{
    public $successStatus = 200;
    public function add(Request $request)
    {

        $input = $request->all();
        $id=Sale::create($input)->id;

        return response()->json(['status'=>$this-> successStatus,'id'=>$id]);
    }
    public function getprice(Request $request)
    {

        $user=Auth::user();

        $input = Sale::where('user_id',$user->id)->get();

        $newData=Array();
        foreach ($input as $item){
            $nestData["id"]=$item->id;
            $nestData["seller_id"]=$item->seller_id;
            $nestData["products"]=json_decode($item->products);
            $nestData["total_price"]=$item->total_price;
            $nestData["note"]=$item->note;
            $nestData["status"]=$item->status;
            $newData[]=$nestData;

        }
        //return response()->json(['status'=>$this-> successStatus,'sales'=>['id'=>1,'user_id'=>1,'products'=>['ad'=>'testad','soyad'=>'soyadtest']]]);
        return response()->json(['status'=>$this-> successStatus,'sales'=>$newData]);
    }

}
