<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelengkapanInstalasi extends Model
{
    use SoftDeletes;
    protected $table = 'kelengkapan_instalasi';
    protected $fillable = [
        'instalasi_id', 'grup_slo_id',
    ];

    public function instalasi()
    {
        return $this->belongsTo(Instalasi::class, 'instalasi_id', 'id');
    }

    public function grup_slo()
    {
        return $this->belongsTo(GrupSlo::class, 'grup_slo_id', 'id');
    }

    public function getItemKelengkapanAttribute()
    {
        return ItemKelengkapan::where('grup_slo_id', '=', $this->grup_slo_id)->get();
    }

    public function diupload()
    {
        return $this->hasMany(KelengkapanInstalasiDetail::class, 'kelengkapan_instalasi_id', 'id');
    }

    public function diverifikasi()
    {
        return $this->hasMany(KelengkapanInstalasiDetail::class, 'kelengkapan_instalasi_id', 'id')
            ->where('status', '=', 'Terima');
    }


}
