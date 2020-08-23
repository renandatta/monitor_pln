<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrupSlo extends Model
{
    use SoftDeletes;
    protected $table = 'grup_slo';
    protected $fillable = [
        'nama', 'parent_id', 'no_urut'
    ];

    public function parent()
    {
        return $this->belongsTo(GrupSlo::class, 'parent_id', 'id');
    }

    public function sub_items()
    {
        return $this->hasMany(GrupSlo::class, 'parent_id', 'id')
            ->orderBy('no_urut', 'asc');
    }
}
