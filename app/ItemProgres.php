<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemProgres extends Model
{
    use SoftDeletes;
    protected $table = 'item_progres';
    protected $fillable = [
        'nama', 'grup_slo_id'
    ];

    public function grup_slo()
    {
        return $this->belongsTo(GrupSlo::class, 'grup_slo_id', 'id');
    }
}
