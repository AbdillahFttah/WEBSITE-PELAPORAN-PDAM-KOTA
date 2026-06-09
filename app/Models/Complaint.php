<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'no_meter',
        'nama_pelapor',
        'no_hp',
        'alamat',
        'tanggal',
        'keterangan',
        'status',
        'tanggal_selesai',
        'bagian',
        'penyelesaian',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_selesai' => 'datetime',
    ];
}