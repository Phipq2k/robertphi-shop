<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'customers_name','customers_email','customers_password','customers_phone','customers_vip','customers_token'
    ];

    protected $primaryKey = 'customers_id';

 	protected $table = 'tbl_customers';
}
