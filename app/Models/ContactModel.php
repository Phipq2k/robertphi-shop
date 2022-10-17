<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    public $timestamp = false; //Set time to false
    protected $fillable = ['contact_info','contact_map','contact_images','contact_fanpage'];
    protected $primaryKey = 'contact_id';
    protected $table = 'tbl_contact';
}
