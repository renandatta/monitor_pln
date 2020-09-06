<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Instalasi</th>
            <th>Grup SLO</th>
            <th>Kontraktor</th>
            <th>Petugas</th>
            <th>Lingkup</th>
            <th>Alamat</th>
            <th class="text-center" style="width: 8rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @forelse($kelengkapan as $key => $value)
            <tr class="datatable-row">
                <td class="text-center">{{ $kelengkapan->firstItem() + $key }}</td>
                <td>{{ $value->instalasi->nama }}</td>
                <td>{{ $value->grup_slo->nama }}</td>
                <td>{{ $value->kontraktor->nama }}</td>
                <td>{{ $value->petugas->nama }}</td>
                <td>{{ $value->lingkup }}</td>
                <td>{{ $value->alamat }}</td>
                <td class="text-center p-1">
                    <a href="{{ route('kelengkapan_instalasi.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
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
