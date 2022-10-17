<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'name_qh','type','ma_tp'
    ];

    protected $primaryKey = 'ma_qh';

 	protected $table = 'tbl_quanhuyen';
}
