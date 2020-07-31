<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelengkapanInstalasi extends Model
{
    use SoftDeletes;
    protected $table = 'kelengkapan_instalasi';
    protected $fillable = [
        'instalasi_id', 'grup_slo_id', 'kontraktor_id', 'petugas_id', 'alamat', 'koordinat'
    ];

    public function instalasi()
    {
        return $this->belongsTo(Instalasi::class, 'instalasi_id', 'id');
    }

    public function grub_slo()
    {
        return $this->belongsTo(GrupSlo::class, 'grup_slo_id', 'id');
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
