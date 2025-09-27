<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfessionLikes extends Model
{
    use HasFactory;
    protected $table = 'confession_likes';

    
    public function confession()
    {
        return $this->belongsTo(Confessions::class, 'bID');
    }

   
    public function user()
    {
        return $this->belongsTo(Users::class, 'uID');
    }
}
