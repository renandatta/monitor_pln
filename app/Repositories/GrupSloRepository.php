<?php

namespace App\Repositories;

use App\GrupSlo;

class GrupSloRepository
{
    private $grupSlo;
    public function __construct(GrupSlo $grupSlo)
    {
        $this->grupSlo = $grupSlo;
    }

    public function get_slo()
    {
        return $this->grupSlo->get();
    }
}
