<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductModel extends Model
{
      public $timestamps = false;
      protected $fillable = [
            'category_id','brand_id','product_slug','product_name','product_keyword','product_decs','product_content','product_quantity','product_sold','product_price','product_image','product_views','product_status',
      ];

      protected $primaryKey = 'product_id';

 	protected $table = 'tbl_product';

       public function category(){
             return $this->belongsTo('App\Models\CategoryModel','id');
       }

       public function brand(){
             return $this->belongsTo('App\Models\BrandModel','brand_id');
       }
}
