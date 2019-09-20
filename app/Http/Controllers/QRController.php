<?php

namespace Bimenu\Http\Controllers;



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
        $get_qr_scan= Qrcode::find($request->data)->product;


        return $get_qr_scan;
    }
}
