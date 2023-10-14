<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Post extends Model
{
    use HasFactory, HasSEO;

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

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: "$this->code | $this->title",
            description: $this->overview,
            author: $this->user->name ?? 'joisvvv',
            robots: 'follow, index',
            image: "storage/$this->poster_path",
            schema: SchemaCollection::initialize()->addArticle()
        );
    }
    
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
