<?php

namespace App\Repositories;

use App\KelengkapanInstalasi;
use Illuminate\Http\Request;

class KelengkapanInstalasiRepository
{
    protected $kelengkapanInstalasi;
    public function __construct(KelengkapanInstalasi $kelengkapanInstalasi)
    {
        $this->kelengkapanInstalasi = $kelengkapanInstalasi;
    }

    public function search(Request $request)
    {
        $kelengkapan = $this->kelengkapanInstalasi;

        $instalasiId = $request->input('instalasi_id') ?? '';
        if ($instalasiId != '')
            $kelengkapan = $kelengkapan->where('instalasi_id', '=', $instalasiId);

        $grupSloId = $request->input('grup_slo_id') ?? '';
        if ($grupSloId != '')
            $kelengkapan = $kelengkapan->where('grup_slo_id', '=', $grupSloId);

        $kontraktorId = $request->input('kontraktor_id') ?? '';
        if ($kontraktorId != '')
            $kelengkapan = $kelengkapan->where('kontraktor_id', '=', $kontraktorId);

        $petugasId = $request->input('petugas_id') ?? '';
        if ($petugasId != '')
            $kelengkapan = $kelengkapan->where('petugas_id', '=', $petugasId);

        if ($request->has('paginate'))
            return $kelengkapan->paginate($request->input('paginate'));
        return $kelengkapan->get();
    }

    public function find($value, $column = 'id')
    {
        return $this->kelengkapanInstalasi->where($column, '=', $value)->first();
    }

    public function save(Request $request)
    {
        if ($request->has('id')) {
            $kelengkapan = $this->kelengkapanInstalasi->find($request->input('id'));
            $kelengkapan->update($request->all());
        } else {
            $kelengkapan = $this->kelengkapanInstalasi->create($request->all());
        }
        return $kelengkapan;
    }

    public function delete(Request $request)
    {
        $kelengkapan = $this->kelengkapanInstalasi->find($request->input('id'));
        $kelengkapan->delete();
        return $kelengkapan;
    }
}
