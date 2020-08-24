<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Jalur</th>
            <th>Nama</th>
            <th>Koordinat</th>
            <th>Status</th>
            <th class="text-center" style="width: 10rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @php($tempJalur = '')
        @forelse($instalasi as $key => $value)
            @if($tempJalur != $value->jalur_id)
                @php($no = 1)
                <tr class="datatable-row">
                    <td colspan="6">Jalur : <b>{{ $value->jalur->nama }}</b></td>
                </tr>
            @endif
            <tr class="datatable-row">
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $value->jalur->nama }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->koordinat }}</td>
                <td>{{ $value->status }}</td>
                <td class="text-center p-1">
                    <a href="{{ route('instalasi.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                </td>
            </tr>
            @php($tempJalur = $value->jalur_id)
        @empty
            <tr>
                <td colspan="6" class="text-center">Data instalasi kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $instalasi->links() }}
