<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>User Level</th>
            <th class="text-center" style="width: 10rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $key => $value)
            <tr class="datatable-row">
                <td class="text-center">{{ $users->firstItem() + $key }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->user_level }}</td>
                <td class="text-center p-1">
                    <a href="{{ route('user.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Data user kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $users->links() }}
