<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'is_new',
        'status',
        'content'
    ];
    
    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
