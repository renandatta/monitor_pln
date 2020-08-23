<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jalur extends Model
{
    use SoftDeletes;
    protected $table = 'jalur';
    protected $fillable = [
        'nama', 'koordinat', 'alamat'
    ];
}
