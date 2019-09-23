<?php

namespace Bimenu;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id', 'product_table_id' , 'customer_id' , 'items_id' ,   'status'
    ];
}
