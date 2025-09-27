<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAdmins extends Model
{
    use HasFactory;
    
    protected $table = 'admins';
    protected $fillable = ['name', 'username','email','password','role_type', 'status', 'permissions'];
}
