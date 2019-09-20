<?php

namespace Bimenu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Items extends Model
{
    protected $fillable = [
        'name', 'description' , 'photos' , 'price' ,   'enabled','product_id','category_id'
    ];


    public function product(){
        return $this->belongsTo('Bimenu\Product');
    }

    public function category()
    {
        return $this->belongsTo('Bimenu\Category');
    }



}
