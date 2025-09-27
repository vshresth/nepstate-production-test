<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'description', 'image', 'text_lorum', 'parent_id'];
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(ProductS::class, 'slug', 'title');
    }
    public function productscat()
    {
        return $this->hasMany(Product::class, 'category', 'slug');
    }
}
