<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    public $timestamps = false;
    protected $fillable = [
        'site_title',
        'site_logo',
        // 'site_logo_small',
        // 'site_favicon',
        'mobile',
        'email',
        // 'frontend_url',
        // 'copy_right',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'snapchat', //pinterest save kr rha yhn
        // 'skype',
        // 'youtube',
        'address',
        'map_address',
        'footer_about',
        'footer_about_ar',
        'confession_rules',
        'forum_rules',
        'paragraph',
        'event',
        'mainheading',
        'subheading',
        'list_view',
        'no_of_lists',
        'happy_customers',
        'visitors'
    ];
}
