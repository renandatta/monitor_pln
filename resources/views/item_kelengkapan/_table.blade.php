<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" style="width: 5rem">No</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th class="text-left" style="width: 18rem;">Perintah</th>
        </tr>
        </thead>
        <tbody>
        @forelse($itemKelengkapan as $key => $value)
            <tr class="datatable-row">
                <td class="text-center">{{ $value->no_urut }}</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->jenis }}</td>
                <td class="text-left p-1">
                    <a href="{{ route('item_kelengkapan.info', 'id=' . $value->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                    @if($value->jenis == '-')
                        <a href="{{ route('item_kelengkapan.info', 'parent_id=' . $value->id) }}" class="btn btn-light-success btn-sm ml-3"><i class="la la-plus"></i> Tambah Sub</a>
                    @endif
                </td>
            </tr>
            @foreach($value->sub_items as $key2 => $item)
                <tr class="datatable-row">
                    <td class="text-center"></td>
                    <td>
                        {{ $item->no_urut }}.
                        {{ $item->nama }}
                    </td>
                    <td>{{ $item->jenis }}</td>
                    <td class="text-left p-1">
                        <a href="{{ route('item_kelengkapan.info', 'id=' . $item->id) }}" class="btn btn-light-success btn-sm"><i class="la la-pencil-square-o"></i> Ubah</a>
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="5" class="text-center">Data item kelengkapan kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
{{ $itemKelengkapan->links() }}
