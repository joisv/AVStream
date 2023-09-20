<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    
    protected $fillable = [
        'billing_amount',
        'plan_id',
        'start_date',
        'end_date',
        'status',
        'payment_method',
        'user_id',
        'payment_code'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
