<table class="table table-bordered">
    <thead>
    <tr>
        <th>User</th>
        <th>Keterangan</th>
        <th class="text-right">Tanggal</th>
        <th>File Terlampir</th>
        <th>Hapus</th>
    </tr>
    </thead>
    <tbody>
    @foreach($riwayat as $key => $value)
        <tr>
            <td>{{ $value->user->name }}</td>
            <td>{!! $value->keterangan !!}</td>
            <td class="text-right">
                @if($value->tanggal != '' && $value->tanggal != '0000-00-00')
                    {{ format_date($value->tanggal) }}
                @else
                    {{ format_date($value->created_at) }} {{ format_time($value->created_at) }}
                @endif
            </td>
            <td>
                @if($value->file != '')
                    <a target="_blank" href="{{ asset('image/' . $value->file) }}">Lihat File</a>
                @endif
            </td>
            <td class="p-0 text-center" style="vertical-align: middle;">
                @if($value->tanggal == '' || $value->tanggal != '0000-00-00')
                    <form action="{{ route('kelengkapan_instalasi.detail.delete_riwayat') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $value->id }}">
                        <button type="submit" class="btn btn-danger btn-sm py-1 px-5">Hapus</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
