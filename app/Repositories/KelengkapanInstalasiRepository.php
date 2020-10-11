<?php

namespace App\Repositories;

use App\ItemKelengkapan;
use App\KelengkapanInstalasi;
use App\KelengkapanInstalasiDetail;
use App\ProgresInstalasi;
use Illuminate\Http\Request;

class KelengkapanInstalasiRepository
{
    protected $kelengkapanInstalasi, $itemKelengkapan, $kelengkapanInstalasiDetail;
    public function __construct(KelengkapanInstalasi $kelengkapanInstalasi, ItemKelengkapan $itemKelengkapan,
                                KelengkapanInstalasiDetail $kelengkapanInstalasiDetail)
    {
        $this->kelengkapanInstalasi = $kelengkapanInstalasi;
        $this->itemKelengkapan = $itemKelengkapan;
        $this->kelengkapanInstalasiDetail = $kelengkapanInstalasiDetail;
    }

    public function search(Request $request)
    {
        $kelengkapan = $this->kelengkapanInstalasi->select('kelengkapan_instalasi.*')
            ->join('instalasi', 'instalasi.id', '=', 'kelengkapan_instalasi.instalasi_id')
            ->orderBy('jalur_id', 'asc')
            ->orderBy('instalasi.nama', 'asc');

        $instalasiId = $request->input('instalasi_id') ?? '';
        if ($instalasiId != '')
            $kelengkapan = $kelengkapan->where('instalasi_id', '=', $instalasiId);

        $grupSloId = $request->input('grup_slo_id') ?? '';
        if ($grupSloId != '')
            $kelengkapan = $kelengkapan->where('grup_slo_id', '=', $grupSloId);

        $jalurId = $request->input('jalur_id') ?? '';
        if ($jalurId != '')
            $kelengkapan = $kelengkapan->where('jalur_id', '=', $jalurId);

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

    public function progress($kelengkapan_instalasi_id)
    {
        $dataProgres = [];
        $totalProgresBay = 0;
        $kelengakapanInstalasi = $this->kelengkapanInstalasi->find($kelengkapan_instalasi_id);
        $itemKelengkapan = $this->itemKelengkapan->whereNull('parent_id')
            ->where('grup_slo_id', '=', $kelengakapanInstalasi->grup_slo_id)
            ->with(['sub_items'])
            ->orderBy('no_urut', 'asc')
            ->get();
        foreach ($itemKelengkapan as $item) {
            $detail = $this->kelengkapanInstalasiDetail
                ->where('kelengkapan_instalasi_id', '=', $kelengakapanInstalasi->id)
                ->where('status', '=', 'Terima')
                ->where('item_kelengkapan_id', '=', $item->id)
                ->first();
            $progres = [];
            $progres['item_kelengkapan'] = $item;
            $progres['sub_items_count'] = count($item->sub_items);
            if (!empty($detail)) {
                $progres['progres'] = 1;
                $progres['upload'] = $detail;
            } else {
                $progres['progres'] = 0;
                $progres['upload'] = '0';
            }

            $diupload = 0;
            if (count($item->sub_items)) {
                $listItemId = $item->sub_items->pluck('id');
                $diupload = $this->kelengkapanInstalasiDetail
                    ->where('kelengkapan_instalasi_id', '=', $kelengakapanInstalasi->id)
                    ->where('status', '=', 'Terima')
                    ->whereIn('item_kelengkapan_id', $listItemId)
                    ->count();
                $progres['progres'] = $diupload == count($item->sub_items) ? 1 : 0;
            }
            $progres['sub_diupload'] = $diupload;
            $totalProgresBay += $progres['progres'];
            array_push($dataProgres, $progres);
        }

        $jumlahJalur = $this->kelengkapanInstalasi->join('instalasi', 'instalasi.id', '=', 'kelengkapan_instalasi.instalasi_id')
            ->where('instalasi.jalur_id', $kelengakapanInstalasi->instalasi->jalur_id)->count();
        if ($jumlahJalur > 0) {
            $progresBay = round(($totalProgresBay / count($itemKelengkapan)) * 100, 0);
        } else {
            $progresBay = 0;
        }

        $check = ProgresInstalasi::where('instalasi_id', '=', $kelengakapanInstalasi->instalasi_id)
            ->where('grup_slo_id', $kelengakapanInstalasi->grup_slo_id)
            ->first();
        if (!empty($check)) {
            $field = ProgresInstalasi::find($check->id);
        } else {
            $field = new ProgresInstalasi();
            $field->instalasi_id = $kelengakapanInstalasi->instalasi_id;
            $field->grup_slo_id = $kelengakapanInstalasi->grup_slo_id;
        }
        $field->progres_jalur = $progresBay;
        $field->save();

        $dataJalur = ProgresInstalasi::join('instalasi', 'instalasi.id', '=', 'progres_instalasi.instalasi_id')
            ->where('instalasi.jalur_id', $kelengakapanInstalasi->instalasi->jalur_id)->get();
        $field2 = ProgresInstalasi::find($field->id);
        $field2->progres_bay = $dataJalur->sum('progres_jalur') / count($dataJalur);
        $field2->save();

        $kelengakapanInstalasi->progres = $dataProgres;
        $kelengakapanInstalasi->totalProgresBay = $totalProgresBay;
        $kelengakapanInstalasi->kelengakapanInstalasi = count($itemKelengkapan);
        $kelengakapanInstalasi->progresBay = $progresBay;
        return $kelengakapanInstalasi;
    }
}
