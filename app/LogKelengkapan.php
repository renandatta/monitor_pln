<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogKelengkapan extends Model
{
    protected $table = 'log_kelengkapan';
    protected $fillable = [
        'user_id', 'kelengkapan_instalasi_id', 'keterangan', 'tanggal', 'file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
