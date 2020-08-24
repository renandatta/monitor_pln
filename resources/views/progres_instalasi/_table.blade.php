<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th rowspan="2">Instalasi</th>
            <th colspan="2" class="text-center">Progres</th>
            <th rowspan="2">Status</th>
            @foreach($itemProgres as $item)
                <th rowspan="2" class="text-nowrap">{{ $item->nama }}</th>
            @endforeach
        </tr>
        <tr>
            <th>Jalur</th>
            <th>Bay</th>
        </tr>
        </thead>
        <tbody>
        @forelse($instalasi as $key => $value)
            <tr class="datatable-row">
                <td class="text-nowrap">{{ $value->nama }}</td>
                <td></td>
                <td></td>
                <td></td>
                @foreach($itemProgres as $item)
                    <td></td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($itemProgres) + 4 }}" class="text-center">Data instalasi kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
