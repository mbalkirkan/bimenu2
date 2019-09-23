<?php

namespace Bimenu\Http\Controllers;



use Bimenu\Order;
use Bimenu\Product;

use Bimenu\Qrcode;
use Illuminate\Http\Request;

class QRController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;
    public function __invoke(Request $request)
    {
        //
    }
    public function qrScan(Request $request)
    {
        $get_qr_scan= Qrcode::find($request->data);
        $result = Product
            ::find($get_qr_scan->product_id)
            ->join('product_tables', 'product_tables.product_id', '=',   'products.id')
            ->where('product_tables.id', '=',  $get_qr_scan->product_table_id)
            ->select('products.id as product_id','products.name as product_name','products.description as product_description','products.photos as product_photos','product_tables.name as product_tables','product_tables.id as product_tables_id')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->get();

        if($result)
        {
            $flight = new Order;
            $flight->product_id = $result[0]->product_id;
            $flight->product_table_id = $result[0]->product_tables_id;
            $flight->customer_id = $request->session()->get('user.id');
            $flight->save();

        }

        //return view('mobile.menu',['result'=>$result]);
     //   return view('mobile.index');

//        $request->session()->put('product.name', $request->name);
//        $request->session()->put('product.surname', $request->surname);
//        $request->session()->put('product.id', $request->phone);
//        $request->session()->put('product.photos', $request->phone);
//
//        $request->session()->put('product.name', $request->name);
//        $request->session()->put('product.surname', $request->surname);
//        $request->session()->put('product.id', $request->phone);



        return  $result;
    }

    public function qrGenerator(Request $request)
    {
        $qr=Qrcode::all()->first();
        return view('mobile.qrgenerator',['qr'=>$qr->id]);
    }
}
