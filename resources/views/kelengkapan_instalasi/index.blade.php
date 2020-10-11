@extends('layouts.main')

@section('title')
    {{ $title }} -
@endsection

@push('styles')

@endpush

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h2 class="subheader-title text-dark font-weight-bold my-1 mr-3">{{ $title }}</h2>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" onclick="toggle_pencarian()" class="btn btn-secondary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">
                        <span class="svg-icon svg-icon-primary"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"/> <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000"/> </g> </svg></span>
                        Filter Pencarian
                    </button>
                    <a href="{{ route('kelengkapan_instalasi.info') }}" class="btn btn-primary btn-fixed-height font-weight-bold px-2 px-lg-5 mr-2">
                        <span class="svg-icon svg-icon-secondary"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/> <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/> </g> </svg></span>
                        Tambah
                    </a>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-custom mb-5" id="card_pencarian" style="display: none;">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Filter Pencarian
                                        <span class="d-block text-muted pt-2 font-size-sm">Cari dengan kondisi berikut</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" id="form_pencarian">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="instalasi_id">Instalasi</label>
                                                <select name="instalasi_id" id="instalasi_id" class="form-control select2">
                                                    <option value="">Semua Instalasi</option>
                                                    @foreach($instalasi as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="grup_slo_id">Grup SLO</label>
                                                <select name="grup_slo_id" id="grup_slo_id" class="form-control select2">
                                                    <option value="">Semua Grup</option>
                                                    @foreach($grupSlo as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @foreach($item->sub_items as $subItem)
                                                            <option value="{{ $subItem->id }}">{{ $item->nama . ' - ' .$subItem->nama }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="kontraktor_id">Kontraktor</label>
                                                <select name="kontraktor_id" id="kontraktor_id" class="form-control select2">
                                                    <option value="">Semua Kontraktor</option>
                                                    @foreach($kontraktor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="petugas_id">Petugas</label>
                                                <select name="petugas_id" id="petugas_id" class="form-control select2">
                                                    <option value="">Semua Petugas</option>
                                                    @foreach($petugas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary font-weight-bold">Pencarian</button>
                                    <a href="{{ route('item_kelengkapan') }}" class="btn btn-secondary font-weight-bold ml-2">Reset</a>
                                </form>
                            </div>
                        </div>
                        <div class="card card-custom">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Data Kelengkapan Instalasi
                                        <span class="d-block text-muted pt-2 font-size-sm">Data Kelengkapan dan dokumen tentang instalasi jalur</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body pt-2" id="div_data_kelengkapan_instalasi">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_list_dokumen" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_list_dokumen_judul">Dokumen Kelengkapan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body" id="list_data_dokumen">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_riwayat_dokumen" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_riwayat_dokumen_judul">Riwayat Dokumen Kelengkapan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_riwayat" class="mb-4" enctype="multipart/form-data" action="{{ route('kelengkapan_instalasi.detail.save_riwayat') }}">
                        @csrf
                        <input type="hidden" name="id" id="riwayat_id">
                        <div class="row">
                            <div class="col-md-8 pr-0">
                                <input type="text" class="form-control kt-datepicker border-bottom-0" name="tanggal" id="tanggal_riwayat" placeholder="Pilih Tanggal" style="border-radius: 0;width: 100%;" required>
                                <textarea name="keterangan" id="keterangan_riwayat" rows="3" class="form-control border-top-0" placeholder="Keterangan kegiatan" style="border-radius: 0;" required></textarea>
                            </div>
                            <div class="col-md-4 pl-0">
                                <input type="file" class="dropify" name="file" id="file" data-height="100">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block py-2" style="border-radius: 0;">Simpan</button>
                    </form>
                    <div id="list_riwayat_dokumen"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_detail_instalasi" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_list_dokumen_judul">Detail Instalasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-borderless" id="detail_instalasi">
                        <tr>
                            <td>Jalur</td><td width="3%" class="text-center">:</td><td id="jalur"></td>
                        </tr>
                        <tr>
                            <td>Nama</td><td width="3%" class="text-center">:</td><td id="nama"></td>
                        </tr>
                        <tr>
                            <td>Kontraktor</td><td width="3%" class="text-center">:</td><td id="kontraktor"></td>
                        </tr>
                        <tr>
                            <td>Petugas</td><td width="3%" class="text-center">:</td><td id="petugas"></td>
                        </tr>
                        <tr>
                            <td>Lingkup</td><td width="3%" class="text-center">:</td><td id="lingkup"></td>
                        </tr>
                        <tr>
                            <td>Alamat</td><td width="3%" class="text-center">:</td><td id="alamat"></td>
                        </tr>
                        <tr>
                            <td>Koordinat</td><td width="3%" class="text-center">:</td><td id="koordinat"></td>
                        </tr>
                        <tr>
                            <td>No. Surat Inspeksi</td><td width="3%" class="text-center">:</td><td id="no_surat_inspeksi"></td>
                        </tr>
                        <tr>
                            <td>Tanggal Surat Inspeksi</td><td width="3%" class="text-center">:</td><td id="tanggal_surat_inspeksi"></td>
                        </tr>
                        <tr>
                            <td>No. RLB</td><td width="3%" class="text-center">:</td><td id="no_slb"></td>
                        </tr>
                        <tr>
                            <td>Tanggal RLB</td><td width="3%" class="text-center">:</td><td id="tanggal_slb"></td>
                        </tr>
                        <tr>
                            <td>Tanggal Energize</td><td width="3%" class="text-center">:</td><td id="tanggal_energize"></td>
                        </tr>
                        <tr>
                            <td>Nilai Final</td><td width="3%" class="text-center">:</td><td id="nilai_final"></td>
                        </tr>
                        <tr>
                            <td>No. ST1</td><td width="3%" class="text-center">:</td><td id="no_st1"></td>
                        </tr>
                        <tr>
                            <td>Tanggal ST1</td><td width="3%" class="text-center">:</td><td id="tanggal_st1"></td>
                        </tr>
                        <tr>
                            <td>No. ST2</td><td width="3%" class="text-center">:</td><td id="no_st2"></td>
                        </tr>
                        <tr>
                            <td>Tanggal ST2</td><td width="3%" class="text-center">:</td><td id="tanggal_st2"></td>
                        </tr>
                        <tr>
                            <td>No. SLO</td><td width="3%" class="text-center">:</td><td id="no_slo"></td>
                        </tr>
                        <tr>
                            <td>Tanggal SLO</td><td width="3%" class="text-center">:</td><td id="tanggal_slo"></td>
                        </tr>
                        <tr>
                            <td>No. STOP</td><td width="3%" class="text-center">:</td><td id="no_stop"></td>
                        </tr>
                        <tr>
                            <td>Tanggal STOP</td><td width="3%" class="text-center">:</td><td id="tanggal_stop"></td>
                        </tr>
                        <tr>
                            <td>No. STAP</td><td width="3%" class="text-center">:</td><td id="no_stap"></td>
                        </tr>
                        <tr>
                            <td>Tanggal STAP</td><td width="3%" class="text-center">:</td><td id="tanggal_stap"></td>
                        </tr>
                        <tr>
                            <td>No. STP</td><td width="3%" class="text-center">:</td><td id="no_stp"></td>
                        </tr>
                        <tr>
                            <td>Tanggal STP</td><td width="3%" class="text-center">:</td><td id="tanggal_stp"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify();
        function toggle_pencarian() {
            $('#card_pencarian').slideToggle();
        }

        let selectedPage = 1,
            formPencarian = $('#form_pencarian'),
            divDataKelengkapan = $('#div_data_kelengkapan_instalasi');
        divDataKelengkapan.html('<div class="text-center"><h4>Loading <i class="fa fa-spinner fa-spin"></i></h4></div>')
        formPencarian.submit(function (e) {
            e.preventDefault();
            search_data();
        });
        function search_data(page = '') {
            if (page.toString() === '-1') page = selectedPage - 1;
            if (page.toString() === '+1') page = selectedPage + 1;
            if (page === '') page = selectedPage;
            selectedPage = page;

            $.post("{{ route('kelengkapan_instalasi.search') }}?page=" + selectedPage, {
                _token: '{{ csrf_token() }}',
                paginate: 10,
                action: ['edit'],
                instalasi_id: $('#instalasi_id').find('option:selected').val(),
                grup_slo_id: $('#grup_slo_id').find('option:selected').val(),
                kontraktor_id: $('#kontraktor_id').find('option:selected').val(),
                petugas_id: $('#petugas_id').find('option:selected').val(),
            }, function (result) {
                divDataKelengkapan.html(result);
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        }
        search_data();

        let selectedId = '';
        function listDokumen(id) {
            selectedId = id;
            $.post("{{ route('kelengkapan_instalasi.list_dokumen') }}", {
                _token: '{{ csrf_token() }}',
                id: id
            }, function (result) {
                $('#list_data_dokumen').html(result);
                $('#modal_list_dokumen').modal('show');
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        }
        function riwayatDokumen(id) {
            $('#riwayat_id').val(id);
            selectedId = id;
            $.post("{{ route('kelengkapan_instalasi.riwayat_dokumen') }}", {
                _token: '{{ csrf_token() }}',
                id: id
            }, function (result) {
                $('#list_riwayat_dokumen').html(result);
                $('#modal_riwayat_dokumen').modal('show');
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        }
        @if(Session::has('riwayat_id'))
            riwayatDokumen({{ Session::get('riwayat_id') }});
        @endif
        function verifikasiDokumen(status, id) {
            if (status === 'Terima') simpan_verifikasi(id, status);
            else {
                $('#modal_list_dokumen').modal('toggle');
                Swal.fire({
                    title: 'Masukan alasan ditolak',
                    input: 'textarea',
                    inputPlaceholder: '...',
                    inputAttributes: {
                        'aria-label': '...'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                }).then((result) => {
                    if (result.isConfirmed) {
                        simpan_verifikasi(id, status, result.value);
                    }
                    $('#modal_list_dokumen').modal('toggle');
                })
            }
        }
        function simpan_verifikasi(id, status, pesan = '') {
            $.post("{{ route('kelengkapan_instalasi.detail.verifikasi') }}", {
                _token: '{{ csrf_token() }}',
                id, status, pesan
            }, function () {
                listDokumen(selectedId);
            }).fail(function (xhr) {
                console.log(xhr.responseText);
            });
        }
        $('#modal_list_dokumen').on('hidden.bs.modal', function (e) {
            search_data(selectedPage);
        });

        function detailInstalasi(id) {
            $.post("{{ route('instalasi.search') }}", {
                _token: '{{ csrf_token() }}',
                ajax: true,
                id: id
            }, function (result) {
                result = result[0];
                $('#jalur').html(result.jalur.nama);
                $('#nama').html(result.nama);
                $('#kontraktor').html(result.kontraktor != null ? result.kontraktor.nama : '');
                $('#petugas').html(result.petugas != null ? result.petugas.nama : '');
                $('#lingkup').html(result.lingkup);
                $('#alamat').html(result.alamat);
                $('#koordinat').html(result.koordinat);
                $('#no_surat_inspeksi').html(result.no_surat_inspeksi);
                $('#tanggal_surat_inspeksi').html(result.tanggal_surat_inspeksi);
                $('#no_slb').html(result.no_slb);
                $('#tanggal_slb').html(result.tanggal_slb);
                $('#tanggal_energize').html(result.tanggal_energize);
                $('#nilai_final').html(result.nilai_final);
                $('#no_st1').html(result.no_st1);
                $('#tanggal_st1').html(result.tanggal_st1);
                $('#no_st2').html(result.no_st2);
                $('#tanggal_st2').html(result.tanggal_st2);
                $('#nilai_final').html(result.nilai_final);
                $('#no_slo').html(result.no_slo);
                $('#tanggal_slo').html(result.tanggal_slo);
                $('#no_stop').html(result.no_stop);
                $('#tanggal_stop').html(result.tanggal_stop);
                $('#no_stap').html(result.no_stap);
                $('#tanggal_stap').html(result.tanggal_stap);
                $('#no_stp').html(result.no_stp);
                $('#tanggal_stp').html(result.tanggal_stp);
                $('#modal_detail_instalasi').modal('show');
            });
        }
    </script>
@endpush
