<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Actress extends Model
{
    use HasFactory, HasSEO;

    protected $fillable = [
        'name',
        'height',
        'cup_size',
        'debut',
        'age',
        'profile',
        'slug'
    ];

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: "Actress JAV $this->name",
            description: "Actress JAV $this->name, Nonton Actress JAV $this->name, Streaming Actress JAV $this->name, Cerita Cinta, Drama $this->name, Romansa Penuh Gairah",
            robots: 'nofollow, noindex',
            schema: SchemaCollection::initialize()->addArticle()
        );
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
