<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = ['name',  'email', 'password', 'username', 'phone', 'address', 'country_id'];
    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'uID');
    }
    public function likedBlogs()
    {
        return $this->hasMany(BlogLikes::class, 'uID');
    }
    public function comments()
    {
        return $this->hasMany(BlogComments::class, 'uID');
    }


    public function confessions()
    {
        return $this->hasMany(Confessions::class, 'uID');
    }

    public function likedConfessions()
    {
        return $this->hasMany(ConfessionLikes::class, 'uID');
    }

    public function confessionComments()
    {
        return $this->hasMany(ConfessionComments::class, 'uID');
    }
public function country()
{
    return $this->belongsTo(Countries::class, 'country_id');
}

}
