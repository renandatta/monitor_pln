@php($addTitle = !empty($kontraktor) ? 'Ubah ' : 'Tambah ')

@extends('layouts.main')

@section('title')
    {{ $addTitle . $title }} -
@endsection

@section('content')
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <h5 class="text-dark font-weight-bold my-1 mr-5">{{ $addTitle . $title }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class=" container-fluid ">
                <div class="card card-custom">
                    @if(!empty($kontraktor))
                    <div class="card-header flex-wrap ">
                        <div class="card-title">

                        </div>
                        <div class="card-toolbar">
                            <form action="{{ route('kontraktor.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $kontraktor->id }}">
                                <button type="submit" class="btn btn-danger"><i class="la la-times"></i> Hapus Kontraktor</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('kontraktor.save') }}" method="post">
                            @csrf
                            @if(!empty($kontraktor))
                                <input type="hidden" name="id" value="{{ $kontraktor->id }}">
                                <input type="hidden" name="user_id" value="{{ $kontraktor->user_id }}">
                            @endif
                            <div class="form-group row">
                                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="nama" name="nama" value="{{ old('name', !empty($kontraktor) ? $kontraktor->nama : '') }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="notelp" class="col-md-2 col-form-label">Nomor Telfon</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="notelp" name="notelp" value="{{ old('name', !empty($kontraktor) ? $kontraktor->notelp : '') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', !empty($kontraktor) ? $kontraktor->user->email : '') }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="password" name="password" value="{{ old('password') }}" @if(empty($kontraktor)) required @endif>
                                    @if(!empty($kontraktor)) <small>*) Kosongi apabila tidak diubah</small> @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 ml-md-auto">
                                    <button type="submit" class="btn btn-primary mr-3">Simpan Kontraktor</button>
                                    <a href="{{ route('kontraktor') }}" class="btn btn-secondary">Batal & Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

