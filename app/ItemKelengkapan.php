<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemKelengkapan extends Model
{
    use SoftDeletes;
    protected $table = 'item_kelengkapan';
    protected $fillable = [
        'parent_id', 'nama', 'jenis'
    ];

    public function parent()
    {
        return $this->belongsTo(ItemKelengkapan::class, 'parent_id', 'id');
    }

    public function sub_items()
    {
        return $this->hasMany(ItemKelengkapan::class, 'parent_id', 'id');
    }
}
