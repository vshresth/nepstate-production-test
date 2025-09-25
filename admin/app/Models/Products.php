<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Categories::class, 'title', 'slug');
    }

public function country()
{
    return $this->belongsTo(Countries::class, 'country_id');
}

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function views()
    {
        return $this->hasMany(View::class, 'product_slug', 'slug');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($product) {
            $product->productImages()->each(function ($image) {
                $image->delete();
            });
            $product->views()->delete();
        });
    }
}
