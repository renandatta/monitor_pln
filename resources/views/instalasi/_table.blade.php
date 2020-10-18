<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Nama</th>
            <th>Kontraktor</th>
            <th>Direksi</th>
            <th>PIC</th>
            <th>Alamat</th>
            <th class="text-center" style="width: 16rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @php($tempJalur = '')
        @forelse($instalasi as $key => $value)
            @if($tempJalur != $value->jalur_id)
                @php($no = 1)
                <tr class="datatable-row">
                    <td colspan="99">Jalur : <b>{{ $value->jalur->nama ?? '' }}</b></td>
                </tr>
            @endif
            <tr class="datatable-row">
                <td class="text-center">{{ $no++ }}</td>
                <td class="text-nowrap">{{ $value->nama }}</td>
                <td class="text-nowrap">{{ $value->kontraktor->nama ?? '-' }}</td>
                <td class="text-nowrap">{{ $value->lingkup ?? '-' }}</td>
                <td class="text-nowrap">{{ $value->petugas->nama ?? '-' }}</td>
                <td class="text-nowrap">{{ $value->alamat ?? '-' }}</td>
                <td class="text-center p-1" style="vertical-align: middle;">
                    <button type="button" onclick="lihatDetail({{ $value }})" class="btn btn-light-success py-1"><i class="la la-share"></i> Detail</button>
                    <a href="{{ route('instalasi.info', 'id=' . $value->id) }}" class="btn btn-light-success py-1"><i class="la la-pencil-square-o"></i> Ubah</a>
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
