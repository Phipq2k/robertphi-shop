<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatePostModel extends Model
{
    public $timestamp = false; //Set time to false
    protected $fillable = [
        'cate_post_name', 'cate_post_meta_keywords', 'cate_post_desc', 'cate_post_status','cate_post_slug'
    ];
    protected $primaryKey = 'cate_post_id';
    protected $table = 'tbl_category_post';
}
