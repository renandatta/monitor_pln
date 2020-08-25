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
                <td id="progres_jalur_{{ $value->id }}">{{ format_decimal($value->progres_jalur) }}</td>
                <td id="progres_bay_{{ $value->id }}">{{ format_decimal($value->progres_bay) }}</td>
                <td class="p-0">
                    <select name="status_instalasi_{{ $value->id }}" id="status_instalasi_{{ $value->id }}" class="form-control select-td" style="width: 150px" onchange="changeStatusInstalasi({{ $value->id }})">
                        <option value=""></option>
                        <option>Belum Operasi</option>
                        <option>Operasi</option>
                        <option>Serah Terima</option>
                        <option>Terbit SLO</option>
                    </select>
                    <script>
                        document.getElementById('status_instalasi_{{ $value->id }}').value = "{{ $value->progres->status ?? '' }}";
                    </script>
                </td>
                @foreach($itemProgres as $key2 => $item)
                    <td class="p-0">
                        <select name="status_{{ $value->id }}_{{ $item->id }}" id="status_{{ $value->id }}_{{ $item->id }}" class="form-control select-td" onchange="changeStatusDetail({{ $value->id }}, {{ $item->id }})">
                            <option value=""></option>
                            <option value="0.00">0</option>
                            <option value="0.50">0.5</option>
                            <option value="1.00">1</option>
                        </select>
                    </td>
                    <script>
                        document.getElementById('status_{{ $value->id }}_{{ $item->id }}').value = "{{ $value->detail_progres[$key2]->progres ?? '' }}";
                    </script>
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
