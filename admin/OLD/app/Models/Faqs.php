<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    use HasFactory;
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'faqs';
    public $timestamps = false;
    protected $fillable = [ 
        'title', 'description'
    ];
}
