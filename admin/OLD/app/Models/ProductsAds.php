<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAds extends Model
{
    use HasFactory;

    protected $table = 'products_ads';
    public $timestamps = false;
    protected $fillable = [
        'ad_for',
        'ad_location',
        'link',
        'user_id',
        'country_id',
        'city_id',
        'category',
        'ad_expires',
    ];
    public function country()
    {
        return $this->belongsTo(Countries::class);
    }
    
    // public function setUserIdAttribute($value)
    // {
    //     $this->attributes['user_id'] = -1;
    // }
}

