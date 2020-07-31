<?php

namespace App\Repositories;

use App\Jalur;

class JalurRepository
{
    private $jalur;
    public function __construct(Jalur $jalur)
    {
        $this->jalur = $jalur;
    }

    public function get_jalur()
    {
        return $this->jalur->orderBy('nama', 'asc')->get();
    }
}
