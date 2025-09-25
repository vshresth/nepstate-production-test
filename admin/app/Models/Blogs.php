<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'blogs';
    public function user()
    {
        return $this->belongsTo(Users::class, 'uID');
    }
    public function likes()
    {
        return $this->hasMany(BlogLikes::class, 'bID', 'id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComments::class, 'bID', 'id');
    }
}
