<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">Instalasi</th>
            <th colspan="2" class="text-center">Progres</th>
            @foreach($itemKelengkapan as $item)
                <th rowspan="2" width="100px">{{ $item->nama }}</th>
            @endforeach
        </tr>
        <tr>
            <th class="text-center">Jalur</th>
            <th class="text-center">Bay</th>
        </tr>
        </thead>
        <tbody>
        @php($jalur = '')
        @php($totalProgresJalur = 0)
        @php($jumlahJalur = 0)
        @foreach($kelengakapanInstalasi as $key => $value)
            @if($jalur != $value->instalasi->jalur_id)
                @if($key != 0)
                    <script>
                        document.getElementById('jalur_{{ $jalur }}').innerHTML = '{{ $jumlahJalur > 0 ? round($totalProgresJalur / $jumlahJalur, 0) : 0 }}%';
                    </script>
                @endif
                <tr class="datatable-row">
                    <td class="text-nowrap" colspan="99">Jalur : <b>{{ $value->instalasi->jalur->nama }}</b></td>
                </tr>
                @php($totalProgresJalur = 0)
            @endif
            <tr class="datatable-row">
                <td class="text-nowrap pl-5">- {{ $value->instalasi->nama }}</td>
                @if($value->jumlah_per_jalur > 0)
                    @php($jumlahJalur = $value->jumlah_per_jalur)
                    <td class="text-center" rowspan="{{ $value->jumlah_per_jalur }}" id="jalur_{{ $value->instalasi->jalur_id }}" style="vertical-align: middle;"></td>
                @endif
                <td class="text-center">{{ $value->progresBay }}%</td>
                @foreach($value->progres as $progres)
                    <td class="text-center @if($progres['sub_items_count'] == 0) {{ $progres['upload'] == '0' ? 'td-red' : 'td-green' }} @else {{ $progres['sub_diupload'] == $progres['sub_items_count'] ? 'td-green' : 'td-yellow' }} @endif">
                        @if($progres['sub_items_count'] == 0)
                            {{ $progres['upload'] == '0' ? '0' : '1' }}
                        @else
                            {{ $progres['sub_diupload'] .'/'. $progres['sub_items_count'] }}
                        @endif
                    </td>
                @endforeach
            </tr>
            @php($totalProgresJalur = $totalProgresJalur + $value->progresBay)
            @php($jalur = $value->instalasi->jalur_id)
        @endforeach
        @if(count($kelengakapanInstalasi) > 0)
        <script>
            document.getElementById('jalur_{{ $jalur }}').innerHTML = '{{ $jumlahJalur > 0 ? round($totalProgresJalur / $jumlahJalur, 0) : 0 }}%';
        </script>
        @endif
        </tbody>
    </table>
</div>
