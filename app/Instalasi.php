<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instalasi extends Model
{
    use SoftDeletes;
    protected $table = 'instalasi';
    protected $fillable = [
        'jalur_id', 'nama', 'koordinat', 'status'
    ];

    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'jalur_id', 'id');
    }
}
