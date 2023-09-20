<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    public $fillable = [
        'amount',
        'user_id',
        'date'
    ];

    public function user() 
    {
        $this->belongsTo(User::class);    
    }
}
