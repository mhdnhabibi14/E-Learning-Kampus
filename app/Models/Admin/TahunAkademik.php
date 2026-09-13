<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunAkademik extends Model
{
    use SoftDeletes;

    protected $table = 'tahun_akademik';

    protected $fillable = [
        'kode_tahun_akademik',
        'nama_tahun_akademik',
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];
}
