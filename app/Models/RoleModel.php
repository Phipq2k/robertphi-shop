<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    public $timestamp = false; //Set time to false
    protected $fillable = [
        'role_name'
    ];
    protected $primaryKey = 'role_id';
    protected $table = 'tbl_roles';

    function admin(){
        return $this->belongsToMany('App\Models\AdminModel');
    }
}
