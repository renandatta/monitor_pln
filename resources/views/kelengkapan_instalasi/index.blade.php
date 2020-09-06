@extends('layouts.main')

@section('title')
    {{ $title }} -
@endsection

@push('styles')

@endpush

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
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
            <div class="container">
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
@endsection

@push('scripts')
    <script>
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
    </script>
@endpush
