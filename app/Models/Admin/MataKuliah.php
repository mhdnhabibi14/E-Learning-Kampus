<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MataKuliah extends Model
{
    use SoftDeletes;

    protected $table = 'mata_kuliah';

    protected $fillable = [
        'program_studi_id',
        'kode_mata_kuliah',
        'nama_mata_kuliah',
        'sks',
        'semester',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'sks' => 'integer',
        'semester' => 'integer',
        'is_active' => 'boolean',
    ];

    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(Prodi::class);
    }
}
