<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuota extends Model
{
    protected $table = 'kuota';
    protected $primaryKey = 'tanggal';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'tanggal',
        'kuota_maks',
        'kuota_terisi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
