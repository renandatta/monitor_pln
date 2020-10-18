@php($addTitle = !empty($progresInstalasi) ? 'Ubah ' : 'Tambah ')

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
                    @if(!empty($progresInstalasi))
                    <div class="card-header flex-wrap ">
                        <div class="card-title">

                        </div>
                        <div class="card-toolbar">
                            <form action="{{ route('progres_instalasi.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $progresInstalasi->id }}">
                                <button type="submit" class="btn btn-danger"><i class="la la-times"></i> Hapus Progres Instalasi</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('progres_instalasi.save') }}" method="post">
                            @csrf
                            @if(!empty($progresInstalasi))
                                <input type="hidden" name="id" value="{{ $progresInstalasi->id }}">
                            @endif
                            <div class="form-group row">
                                <label for="grup_slo_id" class="col-md-2 col-form-label">Grup SLO</label>
                                <div class="col-md-10">
                                    <select name="grup_slo_id" id="grup_slo_id" class="form-control select2">
                                        @foreach ($grupSlo as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        document.getElementById('grup_slo_id').value = "{{ old('name', !empty($progresInstalasi) ? $progresInstalasi->grup_slo_id : $grupSloId) }}";
                                    </script>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="nama" name="nama" value="{{ old('name', !empty($progresInstalasi) ? $progresInstalasi->nama : '') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 ml-md-auto">
                                    <button type="submit" class="btn btn-primary mr-3">Simpan Progres Instalasi</button>
                                    <a href="{{ route('progres_instalasi') }}" class="btn btn-secondary">Batal & Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

