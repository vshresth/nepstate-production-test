<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    public $timestamps = false;

    public function Images()
    {
        return $this->belongsTo(Products::class);
    }
}
        