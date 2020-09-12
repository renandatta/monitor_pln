<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Jalur</th>
            <th>Instalasi</th>
            <th>Grup SLO</th>
            <th class="text-right">Dokumen Diupload</th>
            <th class="text-right">Dokumen Diverifikasi</th>
            <th class="text-center" style="width: 18rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @forelse($kelengkapan as $key => $value)
            <tr class="datatable-row">
                <td class="text-center">{{ $kelengkapan->firstItem() + $key }}</td>
                <td>{{ $value->instalasi->jalur->nama }}</td>
                <td>
                    <a href="javascript:void(0)" onclick="detailInstalasi({{ $value->instalasi_id }})">{{ $value->instalasi->nama }}</a>
                </td>
                <td>{{ $value->grup_slo->nama }}</td>
                <td class="text-right">{{ count($value->diupload) . ' / ' . count($value->item_kelengkapan) }}</td>
                <td class="text-right">{{ count($value->diverifikasi) . ' / ' . count($value->diupload) }}</td>
                <td class="text-center p-1">
                    <a href="{{ route('kelengkapan_instalasi.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                    <a href="javascript:void(0)" onclick="listDokumen({{ $value->id }})" class="btn btn-light-success btn-sm ml-2"><i class="la la-check-circle-o"></i> Verifikasi</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="99" class="text-center">Data kelengkapan kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $kelengkapan->links() }}
