<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupSlo extends Model
{
    use SoftDeletes;
    protected $table = 'grup_slo';
    protected $fillable = [
        'nama'
    ];
}
