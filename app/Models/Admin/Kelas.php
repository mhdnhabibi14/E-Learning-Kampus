<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $table = 'kelas';

    protected $fillable = [
        'mata_kuliah_id',
        'tahun_akademik_id',
        'kode_kelas',
        'nama_kelas',
        'kuota',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'kuota' => 'integer',
    ];

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function tahunAkademik(): BelongsTo
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    // public function kelasDosen(): HasMany
    // {
    //     return $this->hasMany(KelasDosen::class);
    // }
}
