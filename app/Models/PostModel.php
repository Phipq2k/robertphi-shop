<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    public $timestamp = false; //Set time to false
    protected $fillable = [
        'post_title',
        'post_slug',
        'post_desc',
        'post_content',
        'post_meta_desc',
        'post_views',
        'post_meta_keywords',
        'post_status',
        'post_image',
        'cate_post_id'
    ];
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_posts';

    public function catePost(){
        return $this->belongsTo('App\Models\CatePostModel','cate_post_id');
    }
}
