<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    use HasFactory;
    protected $table = 'payment_plans';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'months',
        'amount',
        'status',
        'sort_order',
        'category_home_page', //Ad#4
        'website_home_category_section', 
        'website_home_banner', //Ad#1
        'home_middle', //Ad#2
        'web_footer', //Ad#3
        'blog', //Ad#6
        'cat_right', //Ad#5
        'confession', //Ad#8
        'forum' //Ad#7
    ];
}
