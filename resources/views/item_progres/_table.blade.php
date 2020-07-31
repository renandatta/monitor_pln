<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Nama</th>
            <th class="text-left" style="width: 10rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @forelse($itemProgres as $key => $value)
            <tr class="datatable-row">
                <td class="text-center">{{ $itemProgres->firstItem() + $key }}</td>
                <td>{{ $value->nama }}</td>
                <td class="text-left p-1">
                    <a href="{{ route('item_progres.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Data item progres kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $itemProgres->links() }}
