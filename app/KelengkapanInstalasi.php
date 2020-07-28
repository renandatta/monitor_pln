<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelengkapanInstalasi extends Model
{
    use SoftDeletes;
    protected $table = 'kelengkapan_instalasi';
    protected $fillable = [
        'instalasi_id', 'item_kelengkapan_id', 'konten', 'status'
    ];

    public function instalasi()
    {
        return $this->belongsTo(Instalasi::class, 'instalasi_id', 'id');
    }

    public function item_kelengkapan()
    {
        return $this->belongsTo(ItemKelengkapan::class, 'item_kelengkapan_id', 'id');
    }
}
