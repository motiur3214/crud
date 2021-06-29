<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{

  

    public function product_varients_price()
    {
        return $this->hasOne(ProductImage::class,'product_id','product_id');
    }

   

}
