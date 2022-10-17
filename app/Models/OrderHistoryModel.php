<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistoryModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'customer_id','shipping_id','order_history_code','created_at'
    ];

    protected $primaryKey = 'order_history_id';

    protected $table = 'tbl_order_history';
}
