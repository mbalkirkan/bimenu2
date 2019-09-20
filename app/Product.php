<?php

namespace Bimenu;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'description' , 'type' , 'country' ,   'photos'   ,'phone','address' ,'maps_address'
    ];

    protected $hidden = [
        'password', 'remember_token','notification_token','authority',
    ];

    public function items(){
        return $this->hasMany('Bimenu\Items');

    }


}
