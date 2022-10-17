<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorModel extends Model
{
    public $timestamp = false; //Set time to false
    protected $fillable = [
        'ip_address','date_visitor'
    ];
    protected $primaryKey = 'id_visitor';
    protected $table = 'tbl_visitor';
}
