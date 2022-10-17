<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'comment_name',
          'comment_image',
          'comment_content',
          'comment_status',
          'comment_date',
          'product_id',
          'comment_parent_id',
          'avatar_color'
    ];

      protected $primaryKey = 'comment_id';

      protected $table = 'tbl_comment';


}
