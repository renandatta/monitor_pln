@php($addTitle = !empty($grup_slo) ? 'Ubah ' : 'Tambah ')

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
                    @if(!empty($grupSlo))
                    <div class="card-header flex-wrap ">
                        <div class="card-toolbar">
                            <form action="{{ route('grup_slo.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $grupSlo->id }}">
                                <button type="submit" class="btn btn-danger"><i class="la la-times"></i> Hapus Grup Slo</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('grup_slo.save') }}" method="post">
                            @csrf
                            @if(!empty($grupSlo))
                                <input type="hidden" name="id" value="{{ $grupSlo->id }}">
                            @endif
                            <input type="hidden" name="no_urut" value="{{ $lastNumber }}">
                            @if($parent != null)
                                <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                                <div class="form-group row">
                                    <label for="parent_grup_slo" class="col-md-2 col-form-label">Parent Grup SLO</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="parent_grup_slo" name="parent_grup_slo" value="{{ $parent->nama }}" readonly>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="nama" name="nama" value="{{ old('name', !empty($grupSlo) ? $grupSlo->nama : '') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 ml-md-auto">
                                    <button type="submit" class="btn btn-primary mr-3">Simpan Grup Slo</button>
                                    <a href="{{ route('grup_slo') }}" class="btn btn-secondary">Batal & Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

