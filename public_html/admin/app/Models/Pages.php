<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pages extends Model
{
    use HasFactory;

    protected $table = 'pages';
    public $timestamps = false;
    protected $fillable = ['title', 'descriptions', 'status', 'bullets'];

    
    // public function setbulletsAttribute($value)
    // {
    //     $this->attributes['bullets'] = ($value);
    // }
}

