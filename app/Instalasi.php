<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instalasi extends Model
{
    use SoftDeletes;
    protected $table = 'instalasi';
    protected $fillable = [
        'jalur_id', 'nama', 'status', 'kontraktor_id', 'petugas_id', 'alamat', 'koordinat', 'lingkup',
        'no_surat_inspeksi', 'tanggal_surat_inspeksi', 'no_slb', 'tanggal_slb', 'tanggal_energize',
        'no_st1', 'tanggal_st1', 'no_st2', 'tanggal_st2', 'nilai_final', 'no_slo', 'tanggal_slo',
        'no_stop', 'tanggal_stop', 'no_stap', 'tanggal_stap', 'no_stp', 'tanggal_stp', 'kontraktor_id', 'petugas_id',
    ];

    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'jalur_id', 'id');
    }

    public function kontraktor()
    {
        return $this->belongsTo(Kontraktor::class, 'kontraktor_id', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }
}
