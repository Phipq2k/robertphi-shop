<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'name_tp','type'
    ];

    protected $primaryKey = 'ma_tp';

 	protected $table = 'tbl_tinhthanhpho';
}
