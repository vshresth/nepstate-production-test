<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'admin_notification';
    public $timestamps = false;
    protected $casts = [
        'created_at' => 'datetime',
    ];
    protected $fillable = ['content', 'read'];
}
