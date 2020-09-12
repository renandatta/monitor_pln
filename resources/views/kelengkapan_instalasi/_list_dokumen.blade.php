<table class="table table-bordered">
    <thead>
    <tr>
        <th>Dokumen</th>
        <th>File</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listDokumen as $key => $value)
        <tr>
            <td>{{ $value->nama }}</td>
            <td class="p-1 text-center">
                @if(!empty($value->upload))
                    <a target="_blank" class="btn btn-sm btn-secondary" href="{{ asset('image/' . $value->upload->konten) }}">Lihat File</a>
                @endif
            </td>
            <td class="p-1 text-center" style="vertical-align: middle;">
                @if(!empty($value->upload))
                    @if($value->upload->status == 'Pending')
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Verifikasi
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:void(0)" onclick="verifikasiDokumen('Terima', {{ $value->upload->id }})"><i class="la la-check mr-2"></i> Diterima</a>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="verifikasiDokumen('Tolak', {{ $value->upload->id }})"><i class="la la-times mr-2"></i> Ditolak</a>
                            </div>
                        </div>
                    @else
                        {{ $value->upload->status }}
                    @endif
                @endif
            </td>
        </tr>
        @foreach($value->sub_items as $key2 => $value2)
            <tr>
                <td class="pl-5">- {{ $value2->nama }}</td>
                <td class="p-1 text-center">
                    @if(!empty($value2->upload))
                        <a target="_blank" class="btn btn-sm btn-secondary" href="{{ asset('image/' . $value2->upload->konten) }}">Lihat File</a>
                    @endif
                </td>
                <td class="p-1 text-center" style="vertical-align: middle;">
                    @if(!empty($value2->upload))
                        {{ $value2->upload->status }}
                        @if($value2->upload->status == 'Pending')
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Verifikasi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="verifikasiDokumen('Terima', {{ $value2->upload->id }})"><i class="la la-check mr-2"></i> Diterima</a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="verifikasiDokumen('Tolak', {{ $value2->upload->id }})"><i class="la la-times mr-2"></i> Ditolak</a>
                                </div>
                            </div>
                        @else
                            {{ $value->upload->status }}
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
