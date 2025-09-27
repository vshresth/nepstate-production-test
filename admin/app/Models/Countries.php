<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $table = 'admin_countries';
    public $timestamps = false;
    protected $fillable = ['code', 'title', 'flag'];

    public function products()
    {
        return $this->hasMany(Products::class, 'country_id');
    }

    public function productAds()
    {
        return $this->hasMany(ProductsAds::class, 'country_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($country) {
            $country->productAds()->delete();
            $country->products->each(function ($product) {
                $product->images()->each(function ($image) {
                    $image->delete();
                });
                $product->views()->delete();
                $product->delete();
            });
        });
    }

public function getTitleAttribute()
{
    return $this->attributes['title'];
}

}
