<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WardsModel extends Model
{
      public $timestamps = false;
      protected $fillable = [
            'name_xa','type','ma_qh'
      ];

      protected $primaryKey = 'xa_id';

      protected $table = 'tbl_xaphuongthitran';
}
