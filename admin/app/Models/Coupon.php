<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    public $timestamps = false;
    protected $fillable = ['category_id','coupon_code', 'discount_type', 'discount', 'status', 'start_date', 'end_date'];




    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
