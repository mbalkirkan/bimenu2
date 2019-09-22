<?php

namespace Bimenu\Http\Controllers;



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
        $get_qr_scan= Qrcode::find('179bec46-48ed-46f9-97fb-cea81c19ee5f');

        $result = Product
            ::find($get_qr_scan->product_id)
            ->join('product_tables', 'product_tables.product_id', '=',   'products.id')
            ->where('product_tables.id', '=',  $get_qr_scan->product_table_id)
            ->select('products.name as product_name','products.description as product_description','products.photos as product_photos','product_tables.name as product_tables','product_tables.id as id')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->get();

        //return view('mobile.menu',['result'=>$result]);
        return view('mobile.index');
        return  $result;
    }
}
