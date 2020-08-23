<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Nama</th>
            <th class="text-center" style="width: 18rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @forelse($grupSlo as $key => $value)
            <tr class="datatable-row">
                <td class="text-center">{{ $grupSlo->firstItem() + $key }}</td>
                <td>{{ $value->nama }}</td>
                <td class="text-left p-1">
                    <a href="{{ route('grup_slo.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                    <a href="{{ route('grup_slo.info', 'parent_id=' . $value->id) }}" class="btn btn-light-success btn-sm ml-3"><i class="la la-plus"></i> Tambah Sub</a>
                </td>
            </tr>
            @foreach($value->sub_items as $key2 => $item)
                <tr class="datatable-row">
                    <td class="text-center"></td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-left p-1">
                        <a href="{{ route('grup_slo.info', 'id=' . $item->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="5" class="text-center">Data grup slo kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $grupSlo->links() }}
