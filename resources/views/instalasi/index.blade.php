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
            <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
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
            <div class=" container ">
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
    </script>
@endpush
