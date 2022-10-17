<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeshipModel extends Model
{
      public $timestamps = false;
      protected $fillable = [
            'fee_mtp','fee_mqh','fee_xaid','fee_feeship'
      ];

      protected $primaryKey = 'fee_id';

 	protected $table = 'tbl_feeship';

      public function cityModel(){
            return $this->belongsTo('App\Models\CityModel','fee_mtp');
      }

      public function provinceModel(){
            return $this->belongsTo('App\Models\ProvinceModel','fee_mqh');
      }

      public function wardModel(){
            return $this->belongsTo('App\Models\WardsModel','fee_xaid');
      }
}
