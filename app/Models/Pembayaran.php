<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_booking',
        'order_id',
        'gross_amount',
        'snap_token',
        'transaction_status',
        'transaction_id',
        'payment_type',
        'transaction_time',
    ];

    protected $casts = [
        'transaction_time' => 'datetime',
        'gross_amount'     => 'integer',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id_booking');
    }
}
