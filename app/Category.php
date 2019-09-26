<?php

namespace Bimenu;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description','product_id'
    ];


}
