<?php

namespace App\Repositories;

use App\Instalasi;

class InstalasiRepository
{
    public $instalasi;
    public function __construct(Instalasi $instalasi)
    {
        $this->instalasi = $instalasi;
    }

    public function get_by_jalur($jalurId)
    {
        return $this->instalasi->where('jalur_id', '=', $jalurId)->get();
    }

    public function get_instalasi()
    {
        return $this->instalasi->all();
    }
}
