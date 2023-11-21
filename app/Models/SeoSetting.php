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
        'payments',
        'banner_video_url',
        'whatsapp_number',
        'is_warning_active',
        'warning_message',
        'info',
        'is_info_active'
    ];

}
