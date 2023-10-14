<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Studio extends Model
{
    use HasFactory, HasSEO;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: "Genere JAV $this->name Terbaik",
            description: "Genere JAV $this->name, Nonton Genere JAV $this->name, Streaming Genere JAV $this->name, Cerita Cinta, Drama $this->name, Romansa Penuh Gairah",
            robots: 'nofollow, noindex',
            schema: SchemaCollection::initialize()->addArticle()
        );
    }
}
