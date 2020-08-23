@php($addTitle = !empty($itemKelengkapan) ? 'Ubah ' : 'Tambah ')

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
                    @if(!empty($itemKelengkapan))
                    <div class="card-header flex-wrap ">
                        <div class="card-title">

                        </div>
                        <div class="card-toolbar">
                            <form action="{{ route('item_kelengkapan.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $itemKelengkapan->id }}">
                                <button type="submit" class="btn btn-danger"><i class="la la-times"></i> Hapus Item Kelengkapan</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('item_kelengkapan.save') }}" method="post">
                            @csrf
                            @if(!empty($itemKelengkapan))
                                <input type="hidden" name="id" value="{{ $itemKelengkapan->id }}">
                            @endif
                            @if($parent != null)
                                <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                                <div class="form-group row">
                                    <label for="parent_kelengkapan" class="col-md-2 col-form-label">Parent Kelengkapan</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="parent_kelengkapan" name="parent_kelengkapan" value="{{ $parent->nama }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="grup_slo_id" class="col-md-2 col-form-label">Grup SLO</label>
                                <div class="col-md-10">
                                    <select name="grup_slo_id" id="grup_slo_id" class="form-control select2">
                                        <option value="" selected disabled>- Pilih -</option>
                                        @foreach ($grupSlo as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @foreach ($item->sub_items as $subItem)
                                                <option value="{{ $subItem->id }}">{{ $item->nama . ' - ' . $subItem->nama }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <script>
                                        document.getElementById('grup_slo_id').value = "{{ old('name', !empty($itemKelengkapan) ? $itemKelengkapan->grup_slo_id : $grupSloId) }}";
                                    </script>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_urut" class="col-md-2 col-form-label">Nomor Urut</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="no_urut" name="no_urut" value="{{ old('name', !empty($itemKelengkapan) ? $itemKelengkapan->no_urut : $lastNumber) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="nama" name="nama" value="{{ old('name', !empty($itemKelengkapan) ? $itemKelengkapan->nama : '') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis" class="col-md-2 col-form-label">Jenis</label>
                                <div class="col-md-10">
                                    <select name="jenis" id="jenis" class="form-control select2">
                                        <option>-</option>
                                        <option>Gambar</option>
                                        <option>Teks</option>
                                    </select>
                                    <script>
                                        document.getElementById('jenis').value = "{{ old('name', !empty($itemKelengkapan) ? $itemKelengkapan->jenis : '-') }}";
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 ml-md-auto">
                                    <button type="submit" class="btn btn-primary mr-3">Simpan Item Kelengkapan</button>
                                    <a href="{{ route('item_kelengkapan') }}" class="btn btn-secondary">Batal & Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

