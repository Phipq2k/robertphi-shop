<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class AdminModel extends Authenticatable
{
    use HasFactory;
    
    public $timestamp = false; //Set time to false
    protected $fillable = [
        'admin_email', 'admin_password','admin_name','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';

    public function roles(){
        return $this->belongsToMany('App\Models\RoleModel');
    }

    public function getAuthPassword()
    {
        return $this->admin_password;
    }

    public function hasAnyRole($role){
        return null !== $this->roles()->whereIn('role_name', $role)->first();
    }

    public function hasRole($role){
        return null !== $this->roles()->where('role_name', $role)->first();
    }

}
