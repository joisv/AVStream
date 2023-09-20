<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'slug',
        'overview',
        'poster_path',
        'category_id',
        'user_id',
        'code',
        'isVip'
    ];

    public function actresses()
    {
        return $this->belongsToMany(Actress::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'post_genre', 'post_id', 'genre_id');
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(Download::class);
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }
}
