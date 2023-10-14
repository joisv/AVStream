<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'description',
        'favicon',
        'keywords',
        'logo',
        'terms',
        'about',
        'payments'
    ];

}
