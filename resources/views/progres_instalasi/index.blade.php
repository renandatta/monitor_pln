@extends('layouts.main')

@section('title')
    {{ $title }} -
@endsection

@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
            <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ $title }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class=" container ">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <ul class="navi navi-hover navi-active navi-accent navi-link-rounded-lg">
                                    @foreach($grupSlo as $grup)
                                    <li class="navi-item">
                                        <a class="navi-link {{ $grup->id == $grupSloId ? 'active' : '' }}" href="{{ route('progres_instalasi', 'grup_slo_id=' . $grup->id) }}">
                                            <span class="navi-icon"><i class="flaticon2-soft-icons"></i></span>
                                            <span class="navi-text">{{ $grup->nama }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-10 border-left pl-5" style="border-left-style: dashed!important;">
                                <form id="form_search">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jalur_id">Pilih Jalur</label>
                                                <select name="jalur_id" id="jalur_id" class="form-control select2">
                                                    @foreach($jalur as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <br>
                                            <button type="submit" class="btn btn-primary mt-2">Tampilkan</button>
                                        </div>
                                    </div>
                                </form>
                                <div id="data_table"></div>
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
        let formSearch = $("#form_search");
        let dataTable = $('#data_table');
        formSearch.submit(function (e) {
            e.preventDefault();
            dataTable.html('<div class="d-flex align-items-center"><div class="mr-2 text-muted">Loading...</div><div class="spinner spinner-danger mr-10"></div></div>');
            $.post("{{ route('progres_instalasi.search') }}", {
                _token: "{{ csrf_token() }}",
                jalur_id: $('#jalur_id').find('option:selected').val(),
                grup_slo_id: '{{ $grupSloId }}'
            }, function (result) {
                dataTable.html(result);
            }).fail(function (xhr) {
                dataTable.html(xhr.responseText);
            });
        });
        formSearch.trigger("submit");
    </script>
@endpush
