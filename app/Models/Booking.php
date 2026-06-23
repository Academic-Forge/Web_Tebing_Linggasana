<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_user',
        'tanggal_kunjungan',
        'jumlah_orang',
        'total_harga',
        'kode_booking',
        'status_booking',
    ];

    protected $casts = [
        'tanggal_booking' => 'datetime',
        'tanggal_kunjungan' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function details()
    {
        return $this->hasMany(BookingDetail::class, 'id_booking', 'id_booking');
    }
}
