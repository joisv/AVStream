<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    
    protected $fillable = [
        'url_download',
        'name',
        'post_id',
        'isVip',
        'user_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
