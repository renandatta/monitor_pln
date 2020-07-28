<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemProgres extends Model
{
    use SoftDeletes;
    protected $table = 'item_progres';
    protected $fillable = [
        'nama'
    ];
}
