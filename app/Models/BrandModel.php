<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
   public $timestamp = false; //Set time to false
   protected $fillable = ['brand_slug','brand_name', 'brand_keyword','brand_decs','brand_status'];
   protected $primaryKey = 'brand_id';
   protected $table = 'tbl_brand_product';

   public function product() {
      return $this->hasMany('App\Models\ProductModel','brand_id');
   }
}
