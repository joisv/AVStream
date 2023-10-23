<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Genre extends Model
{
    use HasFactory, HasSEO;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_genre', 'genre_id', 'post_id');
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: "JAV $this->name Terbaik",
            description: "JAV $this->name, Nonton JAV $this->name, Streaming JAV $this->name, Cerita Cinta, Drama $this->name, Romansa Penuh Gairah",
            robots: 'nofollow, noindex',
            schema: SchemaCollection::initialize()->addArticle()
        );
    }
}
