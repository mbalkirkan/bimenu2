<?php

namespace Bimenu;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'surname' , 'phone' , 'phone_verified'
    ];


}
