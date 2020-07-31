<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelengkapanInstalasiDetail extends Model
{
    use SoftDeletes;
    protected $table = 'kelengkapan_instalasi_detail';
    protected $fillable = [
        'kelengkapan_instalasi_id', 'item_kelengkapan_id', 'status', 'konten'
    ];

    public function kelengkapan_instalasi()
    {
        return $this->belongsTo(KelengkapanInstalasi::class, 'kelengkapan_instalasi_id', 'id');
    }

    public function item_kelengkapan()
    {
        return $this->belongsTo(ItemKelengkapan::class, 'item_kelengkapan_id', 'id');
    }
}
