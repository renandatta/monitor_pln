@php($addTitle = !empty($user) ? 'Ubah ' : 'Tambah ')

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
                    @if(!empty($user))
                    <div class="card-header flex-wrap ">
                        <div class="card-title">

                        </div>
                        <div class="card-toolbar">
                            <form action="{{ route('user.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-danger"><i class="la la-times"></i> Hapus User</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('user.save') }}" method="post">
                            @csrf
                            @if(!empty($user))
                                <input type="hidden" name="id" value="{{ $user->id }}">
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label">Nama</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', !empty($user) ? $user->name : '') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', !empty($user) ? $user->email : '') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="password" name="password" value="{{ old('password') }}">
                                    @if(!empty($user)) <small>*) Kosongi apabila tidak diubah</small> @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="user_level" class="col-md-2 col-form-label">User Level</label>
                                <div class="col-md-10">
                                    <select name="user_level" id="user_level" class="form-control select2">
                                        <option>Superadmin</option>
                                        <option>Petugas</option>
                                        <option>Kontraktor</option>
                                    </select>
                                </div>
                            </div>
                            <script>
                                document.getElementById('user_level').value = "{{ old('user_level', !empty($user) ? $user->user_level : '') }}";
                            </script>
                            <div class="row">
                                <div class="col-md-10 ml-md-auto">
                                    <button type="submit" class="btn btn-primary mr-3">Simpan User</button>
                                    <a href="{{ route('user') }}" class="btn btn-secondary">Batal & Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

