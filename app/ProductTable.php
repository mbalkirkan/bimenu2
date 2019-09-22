<?php

namespace Bimenu;

use Illuminate\Database\Eloquent\Model;

class ProductTable extends Model
{
    protected $fillable = [
        'product_id','name','enabled'
    ];
}
