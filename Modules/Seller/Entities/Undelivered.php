<?php

namespace Modules\Seller\Entities;

use Illuminate\Database\Eloquent\Model;

class Undelivered extends Model
{
    protected $fillable = ['product_id','unit_price','production_price','qnty','undelivered_qnty','req_id','del_qnt','prod_disc', 'is_approved'];

    public function products()
    {
        return $this->belongsTo('\Modules\Product\Entities\Product','product_id','id');        
    }

    public static function createProductDel($requestData)
    {
        try{
            static::create($requestData);

        }catch(\Exception $e){   
            
            throw new \Exception($e->getMessage(), 1);               
        }
    }
}
