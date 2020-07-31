<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgresInstalasiDetail extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'progres_instalasi_id', 'item_progres_id', 'progres'
    ];

    public function progres_instalasi()
    {
        return $this->belongsTo(ProgresInstalasi::class, 'progres_instalasi_id', 'id');
    }

    public function item_progres()
    {
        return $this->belongsTo(ItemProgres::class, 'item_progres_id', 'id');
    }
}
