<?php

namespace Bimenu;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{


    protected $fillable = [
        'product_id','product_table_id'//bunları eklediydim orda yok ama daha migrate kısmında kanka
    ];


    protected $keyType = 'uuid';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();

        });
    }

    public function product(){
        return $this->belongsTo('Bimenu\Product');
    }



}
