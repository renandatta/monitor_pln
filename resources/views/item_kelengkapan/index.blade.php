@extends('layouts.main')

@section('title')
    {{ $title }} -
@endsection

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
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <form method="post" id="form_search">
                                <div class="input-group input-group-solid">
                                    <div class="input-group-prepend mr-3">
                                        <select name="grup_slo_id" id="search_grup_slo_id" class="form-control">
                                            @foreach ($grupSlo as $item)
                                                @foreach ($item->sub_items as $subItem)
                                                    <option value="{{ $subItem->id }}">{{ $item->nama . ' - ' . $subItem->nama }}</option>
                                                @endforeach
                                            @endforeach
{{--                                            <option value="">Semua Grup</option>--}}
{{--                                            @foreach ($grupSlo as $item)--}}
{{--                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>--}}
{{--                                                @foreach ($item->sub_items as $subItem)--}}
{{--                                                    <option value="{{ $subItem->id }}">{{ $item->nama . ' - ' . $subItem->nama }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @endforeach--}}
                                        </select>
                                        <script>
                                            @if($grupSloId != '')
                                                document.getElementById('search_grup_slo_id').value = "{{ $grupSloId }}";
                                            @endif
                                        </script>
                                    </div>
                                    <input type="text" class="form-control" id="search_name" name="search" placeholder="Pencairan" title="Search" autofocus>
                                    <div class="input-group-text">
                                        <i class="la la-search icon-lg"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('item_kelengkapan.info') }}" class="btn btn-primary font-weight-bolder" id="button_tambah">Tambah Item Kelengkapan</a>
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
        let searchGrupSlo = $('#search_grup_slo_id');
        function toggleSearch() {
            formSearch.slideToggle();
        }
        formSearch.submit(function (e) {
            e.preventDefault();
            dataTable.html('<div class="d-flex align-items-center"><div class="mr-2 text-muted">Loading...</div><div class="spinner spinner-danger mr-10"></div></div>');
            $.post("{{ route('item_kelengkapan.search') }}?page=" + selectedPage, {
                _token: "{{ csrf_token() }}",
                paginate: 10,
                nama: $("#search_name").val(),
                grup_slo_id: searchGrupSlo.find('option:selected').val()
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
        searchGrupSlo.change(function () {
            searchData();
            $('#button_tambah').attr('href', '{{ route('item_kelengkapan.info') }}?grup_slo_id=' + searchGrupSlo.find('option:selected').val() );
        });
        searchGrupSlo.trigger('change');
    </script>
@endpush
