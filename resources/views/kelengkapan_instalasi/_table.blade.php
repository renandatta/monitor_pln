<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Instalasi</th>
            <th>Grup SLO</th>
            <th class="text-right">Diupload</th>
            <th class="text-right">Diverifikasi</th>
            <th class="text-center" style="width: 18rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @php($jalur_id = '')
        @forelse($kelengkapan as $key => $value)
            @if(!empty($value->instalasi))
                @if($jalur_id != $value->instalasi->jalur_id)
                    <tr class="datatable-row">
                        <td colspan="99">{{ $value->instalasi->jalur->nama ?? '' }}</td>
                    </tr>
                @endif
                <tr class="datatable-row">
                    <td class="text-center">{{ $kelengkapan->firstItem() + $key }}</td>
                    <td>
                        <a href="{{ route('instalasi.info', 'id=' . $value->instalasi_id) }}">{{ $value->instalasi->nama }}</a>
                    </td>
                    <td>{{ $value->grup_slo->nama }}</td>
                    <td class="text-right">{{ count($value->diupload) . ' / ' . count($value->item_kelengkapan) }}</td>
                    <td class="text-right">{{ count($value->diverifikasi) . ' / ' . count($value->diupload) }}</td>
                    <td class="text-center p-1" style="vertical-align: middle;">
                        <a href="{{ route('kelengkapan_instalasi.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm py-1">Ubah</a>
                        <a href="javascript:void(0)" onclick="listDokumen({{ $value->id }})" class="btn btn-light-success btn-sm ml-2 py-1">Verifikasi</a>
                        <a href="javascript:void(0)" onclick="riwayatDokumen({{ $value->id }})" class="btn btn-light-success btn-sm ml-2 py-1">Riwayat</a>
                    </td>
                </tr>
                @php($jalur_id = $value->instalasi->jalur_id)
            @endif
        @empty
            <tr>
                <td colspan="99" class="text-center">Data kelengkapan kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $kelengkapan->links() }}
