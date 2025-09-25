<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'all_notifications';
    public $timestamps = false;
    protected $casts = [
        'created_at' => 'datetime',
    ];
    protected $fillable = ['text', 'seen'];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
