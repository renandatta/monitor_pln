@php($addTitle = !empty($kelengkapan) ? 'Ubah ' : 'Tambah ')

@extends('layouts.main')

@section('title')
    {{ $addTitle . $title }} -
@endsection

@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
            <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ $addTitle . $title }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class=" container ">
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">
                                {{ !empty($kelengkapan) ? 'Informasi Kelengkapan Instalasi' : 'Kelengkapan Instalasi Baru' }}
                                <span class="d-block text-muted pt-2 font-size-sm">Kelengkapan instalasi dan detail file kelengkapan</span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kelengkapan_instalasi.save') }}" method="post" autocomplete="off">
                            @csrf
                            @if(!empty($kelengkapan))
                                <input type="hidden" name="id" value="{{ $kelengkapan->id }}">
                            @endif
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="instalasi_id">Instalasi</label>
                                        <select name="instalasi_id" id="instalasi_id" class="form-control select2" required>
                                            @foreach($instalasi as $item)
                                                <option value="{{ $item->id }}">{{ $item->jalur->nama . ', ' . $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        @if(!empty($kelengkapan))
                                            <script>
                                                document.getElementById('instalasi_id').value = "{{ $kelengkapan->instalasi_id }}";
                                            </script>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="grup_slo_id">Grup SLO</label>
                                        @if(empty($kelengkapan))
                                            <select name="grup_slo_id" id="grup_slo_id" class="form-control select2"  required>
                                                @foreach($grupSlo as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @foreach($item->sub_items as $subItem)
                                                        <option value="{{ $subItem->id }}">{{ $item->nama . ' - ' .$subItem->nama }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="text" class="form-control" name="grup_slo" value="{{ $kelengkapan->grup_slo->nama }}" readonly>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
                                    <a href="{{ route('kelengkapan_instalasi') }}" class="btn btn-secondary font-weight-bold">Batal</a>
                                </div>
                                @if(empty($kelengkapan))
                                    <div class="col-md-7">
                                        <h4># File Kelengkapan</h4>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Dokumen</th>
                                            </tr>
                                            </thead>
                                            <tbody id="list_dokumen">
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="col-md-7">
                                        <h4># File Kelengkapan</h4>
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Dokumen</th>
                                                <th class="text-center">Upload</th>
                                                <th>File</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($listDokumen as $key => $value)
                                                <tr>
                                                    <td>{{ $value->nama }}</td>
                                                    <td class="p-1 text-center">
                                                        @if(empty($value->upload) || (!empty($value->upload) && $value->upload->status != 'Terima'))
                                                            <button type="button" class="btn btn-sm btn-primary" onclick="uploadDokumen({{ $value->id }}, '{{ $value->nama }}')">Upload</button>
                                                        @endif
                                                    </td>
                                                    <td class="p-1 text-center">
                                                        @if(!empty($value->upload))
                                                            <a target="_blank" class="btn btn-sm btn-secondary" href="{{ asset('image/' . $value->upload->konten) }}">Lihat File</a>
                                                        @endif
                                                    </td>
                                                    <td class="p-1 text-center" style="vertical-align: middle;">
                                                        @if(!empty($value->upload))
                                                            {{ $value->upload->status }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @foreach($value->sub_items as $key2 => $value2)
                                                    <tr>
                                                        <td class="pl-5">- {{ $value2->nama }}</td>
                                                        <td class="p-1 text-center">
                                                            @if(empty($value2->upload) || (!empty($value2->upload) && $value2->upload->status != 'Terima'))
                                                                <button type="button" class="btn btn-sm btn-primary" onclick="uploadDokumen({{ $value2->id }}, '{{ $value2->nama }}')">Upload</button>
                                                            @endif
                                                        </td>
                                                        <td class="p-1 text-center">
                                                            @if(!empty($value2->upload))
                                                                <a target="_blank" class="btn btn-sm btn-secondary" href="{{ asset('image/' . $value2->upload->konten) }}">Lihat File</a>
                                                            @endif
                                                        </td>
                                                        <td class="p-1 text-center" style="vertical-align: middle;">
                                                            @if(!empty($value2->upload))
                                                                {{ $value2->upload->status }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    @if(!empty($kelengkapan))
                        <div class="card-footer text-right p-2">
                            <form action="{{ route('kelengkapan_instalasi.delete') }}" method="post" id="form_hapus">
                                @csrf
                                <input type="hidden" name="id" value="{{ $kelengkapan->id }}">
                                <button type="button" class="btn btn-light-danger" onclick="hapus_data()">
                                    <span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"/> <path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/> <path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/> </g> </svg></span>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!empty($kelengkapan))
        <div class="modal fade" id="modal_upload_dokumen" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_upload_dokumen_judul">Upload Dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kelengkapan_instalasi.detail.save') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kelengkapan_instalasi_id" value="{{ $kelengkapan->id }}">
                            <input type="hidden" id="item_kelengkapan_id" name="item_kelengkapan_id">
                            <div class="form-group">
                                <label for="nama_dokumen">Nama Dokumen</label>
                                <input type="text" class="form-control" id="nama_dokumen">
                            </div>
                            <div class="form-group">
                                <label for="file">Upload Dokumen</label>
                                <input type="file" class="dropify" name="file" id="file" data-height="300">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@push('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify();
        function hapus_data() {
            Swal.fire({
                title: 'Hapus data?',
                text: "Data yang dihapus tidak dapat dikembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelmButtonText: 'Batal',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.value) {
                    $('#form_hapus').submit();
                }
            })
        }

        $('#grup_slo_id').change(function () {
            let grupSloId = $('#grup_slo_id').find('option:selected').val();
            $.post("{{ route('item_kelengkapan.search') }}", {
                _token: '{{ csrf_token() }}',
                grup_slo_id: grupSloId,
                ajax: true
            }, function (result) {
                $('#list_dokumen').html('');
                $.each(result, function (i, value) {
                    let row = $('<tr>');
                    row.append('<td>'+ value.nama +'</td>');
                    $('#list_dokumen').append(row);
                    $.each(value.sub_items, function (j, value2) {
                        let row2 = $('<tr>');
                        row2.append('<td style="padding-left: 30px;"> - '+ value2.nama +'</td>');
                        $('#list_dokumen').append(row2);
                    });
                });
            });
        });
        function uploadDokumen(id, nama) {
            $('#nama_dokumen').val(nama);
            $('#item_kelengkapan_id').val(id);
            $('#modal_upload_dokumen').modal('show');
        }
        function verifikasiDokumen(status, id) {
            $.post("{{ route('kelengkapan_instalasi.detail.verifikasi') }}", {
                _token: '{{ csrf_token() }}',
                id: id,
                status: status
            }, function () {
                window.location.reload();
            });
        }
    </script>
@endpush

