<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Category extends Model
{
    use HasFactory, HasSEO;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts() {
        
        return $this->hasMany(Post::class);
        
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: 'Category - '.$this->name ,
            description: "Sumber utama untuk menonton film dewasa berkualitas tinggi secara online. Temukan koleksi film terbaru dan terpanas dalam berbagai genre. Nikmati hiburan eksklusif dan konten dewasa yang memuaskan hasrat Anda",
            robots: 'follow, index',
            schema: SchemaCollection::initialize()->addArticle()
        );
    }
}
