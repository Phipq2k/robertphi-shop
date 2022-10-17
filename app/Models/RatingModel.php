<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
    public $timestamp = false; //Set time to false
    protected $fillable = ['rating','product_id'];
    protected $primaryKey = 'rating_id';
    protected $table = 'tbl_rating';
}
