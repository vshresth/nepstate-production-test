<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Forums extends Model
{
    use HasFactory;
    protected $table = 'forum_categories';
    public $timestamps = false;
    protected $fillable = [
        'title', 'slug', 'description', 'image', 'status'
    ];
    
    public function title($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value); 
    }

}
