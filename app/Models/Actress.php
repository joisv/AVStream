<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actress extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'height',
        'cup_size',
        'debut',
        'age',
        'profile',
        'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
