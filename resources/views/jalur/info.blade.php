@php($addTitle = !empty($jalur) ? 'Ubah ' : 'Tambah ')

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
                    @if(!empty($jalur))
                    <div class="card-header flex-wrap ">
                        <div class="card-title">

                        </div>
                        <div class="card-toolbar">
                            <form action="{{ route('jalur.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $jalur->id }}">
                                <button type="submit" class="btn btn-danger"><i class="la la-times"></i> Hapus Jalur</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('jalur.save') }}" method="post">
                            @csrf
                            @if(!empty($jalur))
                                <input type="hidden" name="id" value="{{ $jalur->id }}">
                            @endif
                            <div class="form-group row">
                                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="nama" name="nama" value="{{ old('name', !empty($jalur) ? $jalur->nama : '') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="koordinat" class="col-md-2 col-form-label">Koordinat</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="koordinat" name="koordinat" value="{{ old('koordinat', !empty($jalur) ? $jalur->koordinat : '') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="alamat" name="alamat" value="{{ old('name', !empty($jalur) ? $jalur->alamat : '') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 ml-md-auto">
                                    <button type="submit" class="btn btn-primary mr-3">Simpan Jalur</button>
                                    <a href="{{ route('jalur') }}" class="btn btn-secondary">Batal & Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

