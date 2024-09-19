<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total_price', 'status', 'receipt', 'purchase_date', 'received_date', 'completed_date', 'estimated_profit'
    ];

    protected $dates = [
        'purchase_date', 'received_date', 'completed_date'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCompletedDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
}
