<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgresInstalasi extends Model
{
    use SoftDeletes;
    protected $table = 'progres_instalasi';
    protected $fillable = [
        'instalasi_id', 'item_progres_id', 'progres'
    ];
}
