<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Nama</th>
            <th>No.Telp</th>
            <th>Email Login</th>
            <th class="text-center" style="width: 10rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @forelse($kontraktor as $key => $value)
            <tr class="datatable-row">
                <td class="text-center">{{ $kontraktor->firstItem() + $key }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->notelp }}</td>
                <td>{{ $value->user->email }}</td>
                <td class="text-center p-1">
                    <a href="{{ route('kontraktor.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Data kontraktor kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $kontraktor->links() }}
