@extends('layouts.main')

@section('title')
    {{ $title }} -
@endsection

@push('styles')
    <style>
        /*.bs-searchbox .form-control {*/
        /*    border: 1px solid #c1c1c1 !important;*/
        /*}*/
        /*.bootstrap-select > .dropdown-toggle.btn-light, .bootstrap-select > .dropdown-toggle.btn-secondary {*/
        /*    background-color: transparent!important;*/
        /*    border-color: transparent;*/
        /*}*/
    </style>
@endpush

@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ $title }}</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('instalasi.info') }}" class="btn btn-primary font-weight-bold btn-sm px-4 font-size-base ml-2"><i class="la la-plus"></i> Instalasi Baru</a>
                    <button type="button" onclick="toggleSearch()" class="btn btn-secondary font-weight-bold btn-sm px-4 font-size-base ml-2">Filter Pencarian <i class="la la-filter"></i></button>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class=" container-fluid ">
                <div class="card card-custom mb-5" id="card_search" style="display: none;">
                    <div class="card-body">
                        <form method="post" id="form_search">
                            <h3 class="mb-4"># Filter Pencarian</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="search_name">Nama Instalasi</label>
                                        <input type="text" class="form-control" id="search_name" name="search" placeholder="Pencairan" title="Search" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="search_jalur_id">Jalur</label>
                                        <select name="jalur_id" id="search_jalur_id" class="form-control kt-selectpicker mr-4" data-live-search="true">
                                            <option value="">Semua Jalur</option>
                                            @foreach($jalur as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info"><i class="la la-search"></i> Cari Instalasi</button>
                            <button type="button" class="btn btn-light">Reset</button>
                        </form>
                    </div>
                </div>
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0" style="display: none;">
                        <div class="card-title">

                                <div class="input-group input-group-solid">
                                    <div class="input-group-prepend">

                                    </div>

                                    <div class="input-group-text">
                                        <i class="la la-search icon-lg"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('instalasi.info') }}" class="btn btn-primary font-weight-bolder">Tambah Instalasi</a>
                        </div>
                    </div>
                    <div class="card-body" id="data_table">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_detail_judul">Detail Instalasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table>
                            <tr><td>Jalur</td><td width="50px" class="text-center">:</td><td id="jalur"></td></tr>
                            <tr><td>Nama</td><td width="50px" class="text-center">:</td><td id="nama"></td></tr>
                            <tr><td>Kontraktor</td><td width="50px" class="text-center">:</td><td id="kontraktor"></td></tr>
                            <tr><td>Petugas</td><td width="50px" class="text-center">:</td><td id="petugas"></td></tr>
                            <tr><td>Direksi</td><td width="50px" class="text-center">:</td><td id="direksi"></td></tr>
                            <tr><td>Alamat</td><td width="50px" class="text-center">:</td><td id="alamat"></td></tr>
                            <tr><td>Koordinat</td><td width="50px" class="text-center">:</td><td id="koordinat"></td></tr>
                            <tr><td>No Surat Permohonan Inspeksi</td><td width="50px" class="text-center">:</td><td id="no_surat_inspeksi"></td></tr>
                            <tr><td>Tanggal Surat Permohonan Inspeksi</td><td width="50px" class="text-center">:</td><td id="tanggal_surat_inspeksi"></td></tr>
                            <tr><td>No RLB</td><td width="50px" class="text-center">:</td><td id="no_slb"></td></tr>
                            <tr><td>Tanggal RLB</td><td width="50px" class="text-center">:</td><td id="tanggal_slb"></td></tr>
                            <tr><td>Tanggal Energize</td><td width="50px" class="text-center">:</td><td id="tanggal_energize"></td></tr>
                            <tr><td>No ST1</td><td width="50px" class="text-center">:</td><td id="no_st1"></td></tr>
                            <tr><td>Tanggal ST1</td><td width="50px" class="text-center">:</td><td id="tanggal_st1"></td></tr>
                            <tr><td>No ST2</td><td width="50px" class="text-center">:</td><td id="no_st2"></td></tr>
                            <tr><td>Tanggal ST2</td><td width="50px" class="text-center">:</td><td id="tanggal_st2"></td></tr>
                            <tr><td>Nilai Final Quantity</td><td width="50px" class="text-center">:</td><td id="nilai_final"></td></tr>
                            <tr><td>No SLO</td><td width="50px" class="text-center">:</td><td id="no_slo"></td></tr>
                            <tr><td>Tanggal SLO</td><td width="50px" class="text-center">:</td><td id="tanggal_slo"></td></tr>
                            <tr><td>No STOP</td><td width="50px" class="text-center">:</td><td id="no_stop"></td></tr>
                            <tr><td>Tanggal STOP</td><td width="50px" class="text-center">:</td><td id="tanggal_stop"></td></tr>
                            <tr><td>No STAP</td><td width="50px" class="text-center">:</td><td id="no_stap"></td></tr>
                            <tr><td>Tanggal STAP</td><td width="50px" class="text-center">:</td><td id="tanggal_stap"></td></tr>
                            <tr><td>No STP</td><td width="50px" class="text-center">:</td><td id="no_stp"></td></tr>
                            <tr><td>Tanggal STP</td><td width="50px" class="text-center">:</td><td id="tanggal_stp"></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let selectedPage = 1;
        let formSearch = $("#form_search");
        let dataTable = $('#data_table');
        let searchJalur = $('#search_jalur_id');
        function toggleSearch() {
            $('#card_search').slideToggle();
        }
        formSearch.submit(function (e) {
            e.preventDefault();
            dataTable.html('<div class="d-flex align-items-center"><div class="mr-2 text-muted">Loading...</div><div class="spinner spinner-danger mr-10"></div></div>');
            $.post("{{ route('instalasi.search') }}?page=" + selectedPage, {
                _token: "{{ csrf_token() }}",
                paginate: 10,
                nama: $("#search_name").val(),
                jalur_id: searchJalur.find('option:selected').val()
            }, function (result) {
                dataTable.html(result);
            }).fail(function (xhr) {
                dataTable.html(xhr.responseText);
            });
        });
        function searchData(page = 1) {
            if (page.toString() === "-1") page = selectedPage - 1;
            if (page.toString() === "+1") page = selectedPage + 1;
            if (page < 1) page = 1;
            selectedPage = page;
            formSearch.trigger("submit");
        }
        searchData();

        function lihatDetail(data) {
            console.log(data);
            $('#jalur').html(data.jalur.nama);
            $('#nama').html(data.nama);
            $('#kontraktor').html(data.kontraktor.nama);
            $('#petugas').html(data.petugas.nama);
            $('#direksi').html(data.lingkup);
            $('#alamat').html(data.alamt);
            $('#koordinat').html(data.koordinat);
            $('#no_surat_inspeksi').html(data.no_surat_inspeksi);
            $('#tanggal_surat_inspeksi').html(data.tanggal_surat_inspeksi);
            $('#no_slb').html(data.no_slb);
            $('#tanggal_slb').html(data.tanggal_slb);
            $('#tanggal_energize').html(data.tanggal_energize);
            $('#no_st1').html(data.no_st1);
            $('#tanggal_st1').html(data.tanggal_st1);
            $('#no_st2').html(data.no_st2);
            $('#tanggal_st2').html(data.tanggal_st2);
            $('#nilai_final').html(data.nilai_final);
            $('#no_slo').html(data.no_slo);
            $('#tanggal_slo').html(data.tanggal_slo);
            $('#no_stop').html(data.no_stop);
            $('#tanggal_stop').html(data.tanggal_stop);
            $('#no_stap').html(data.no_stap);
            $('#tanggal_stap').html(data.tanggal_stap);
            $('#no_stp').html(data.no_stp);
            $('#tanggal_stp').html(data.tanggal_stp);
            $('#modal_detail').modal('show');
        }
    </script>
@endpush
