<?php

namespace App\Repositories;

use App\ItemProgres;

class ItemProgresRepository
{
    protected $itemProgres;
    public function __construct(ItemProgres $itemProgres)
    {
        $this->itemProgres = $itemProgres;
    }

    public function item_by_grup($grupSloId)
    {
        return $this->itemProgres->where('grup_slo_id', '=', $grupSloId)->orderBy('nama', 'asc')->get();
    }
}
