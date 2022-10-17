<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
      public $timestamps = false;
      protected $fillable = [
            'order_code','product_id','product_name','product_price','product_sales_quantity','product_coupon','product_feeship'
      ];

      protected $primaryKey = 'order_detail_id';

 	protected $table = 'tbl_order_detail';

       public function productModel(){
            return $this->belongsTo('App\Models\ProductModel','product_id');
      }
}
