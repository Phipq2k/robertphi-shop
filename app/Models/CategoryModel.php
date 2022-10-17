<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    public $timestamp = false; //Set time to false
    protected $fillable = ['category_slug','category_name', 'category_parent_id', 'category_parent_status', 'category_keyword','category_decs','category_status'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_category_product';

    public function products() {
        $this->hasMany('App\Models\ProductModel');
    }
}
