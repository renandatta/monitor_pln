@extends('layouts.main')

@section('title')
    {{ $title }} -
@endsection

@push('styles')
    <style>
        .select-td {
            background-color: transparent;
            border-radius: 0;
            border: 0;
        }
        .td-yellow {
            background-color: #ffff8d!important;
        }
        .td-red {
            background-color: #ff9e80!important;;
        }
        .td-green {
            background-color: #69f0ae!important;;
        }
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
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class=" container-fluid ">
                <div class="card card-custom">
                    <div class="card-body">
                        <form id="form_search">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="grup_slo_id">Grup SLO</label>
                                        <select name="grup_slo_id" id="grup_slo_id" class="form-control select2">
                                            @foreach($grupSlo as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @foreach($item->sub_items as $subItem)
                                                    <option value="{{ $subItem->id }}">{{ $item->nama . ' - ' .$subItem->nama }}</option>
                                                @endforeach
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
                grup_slo_id: $('#grup_slo_id').find('option:selected').val(),
            }, function (result) {
                dataTable.html(result);
            }).fail(function (xhr) {
                dataTable.html(xhr.responseText);
            });
        });
        formSearch.trigger("submit");
    </script>
@endpush
