<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Nama</th>
            <th>Koordinat</th>
            <th>Alamat</th>
            <th class="text-center" style="width: 10rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @forelse($jalur as $key => $value)
            <tr class="datatable-row">
                <td class="text-center">{{ $jalur->firstItem() + $key }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->koordinat }}</td>
                <td>{{ $value->alamat }}</td>
                <td class="text-center p-1">
                    <a href="{{ route('jalur.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Data grup slo kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $jalur->links() }}
