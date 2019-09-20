<?php

namespace Bimenu;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id', 'seller_id' , 'prorducts' , 'total_price','status','sended_sellers','room_no','note'
    ];
}
