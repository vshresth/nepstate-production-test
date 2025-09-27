<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confessions extends Model
{
    use HasFactory;
    protected $table = 'confessions';

    public function user()
    {
        return $this->belongsTo(Users::class, 'uID');
    }

   
    public function confession_likes()
    {
        return $this->hasMany(ConfessionLikes::class, 'bID', 'id');
    }

  
    public function confession_comments()
    {
        return $this->hasMany(ConfessionComments::class, 'bID', 'id');
    }
}
