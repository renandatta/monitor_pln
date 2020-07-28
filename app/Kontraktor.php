<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kontraktor extends Model
{
    use SoftDeletes;
    protected $table = 'kontraktor';
    protected $fillable = [
        'user_id', 'nama', 'notelp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
