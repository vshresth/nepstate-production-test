<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComments extends Model
{
    use HasFactory;
    protected $table = 'blog_comment';
    public function user()
    {
        return $this->belongsTo(Users::class, 'uID');
    }
    public function blog()
    {
        return $this->belongsTo(Blogs::class, 'bID');
    }
}
