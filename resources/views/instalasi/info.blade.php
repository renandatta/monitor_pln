@php($addTitle = !empty($instalasi) ? 'Ubah ' : 'Tambah ')

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
                    <div class="card-body">
                        <form action="{{ route('instalasi.save') }}" method="post">
                            @csrf
                            @if(!empty($instalasi))
                                <input type="hidden" name="id" value="{{ $instalasi->id }}">
                            @endif
                            <div class="row">
                                <div class="col-md-7 border-right" style="border-right-style: dashed!important;">
                                    <div class="form-group">
                                        <label for="jalur_id">Jalur</label>
                                        <select name="jalur_id" id="jalur_id" class="form-control select2">
                                            <option value="" disabled>- Pilih Jalur -</option>
                                            @foreach($jalur as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        <script>
                                            document.getElementById('jalur_id').value = "{{ old('jalur_id', !empty($instalasi) ? $instalasi->jalur_id : '') }}";
                                        </script>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="petugas_id">Petugas PIC</label>
                                                <select name="petugas_id" id="petugas_id" class="form-control select2">
                                                    <option value="" disabled>- Pilih Petugas -</option>
                                                    @foreach($petugas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <script>
                                                    document.getElementById('petugas_id').value = "{{ old('petugas_id', !empty($instalasi) ? $instalasi->petugas_id : '') }}";
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kontraktor_id">Kontraktor</label>
                                                <select name="kontraktor_id" id="kontraktor_id" class="form-control select2">
                                                    <option value="" disabled>- Pilih Kontraktor -</option>
                                                    @foreach($kontraktor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <script>
                                                    document.getElementById('kontraktor_id').value = "{{ old('kontraktor_id', !empty($instalasi) ? $instalasi->kontraktor_id : '') }}";
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input class="form-control" type="text" id="nama" name="nama" value="{{ old('name', !empty($instalasi) ? $instalasi->nama : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lingkup">Direksi</label>
                                                <input class="form-control" type="text" id="lingkup" name="lingkup" value="{{ old('lingkup', !empty($instalasi) ? $instalasi->lingkup : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input class="form-control" type="text" id="alamat" name="alamat" value="{{ old('alamat', !empty($instalasi) ? $instalasi->alamat : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="koordinat">Koordinat</label>
                                                <input class="form-control" type="text" id="koordinat" name="koordinat" value="{{ old('koordinat', !empty($instalasi) ? $instalasi->koordinat : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-3">Simpan Instalasi</button>
                                    <a href="{{ route('instalasi') }}" class="btn btn-secondary">Batal & Kembali</a>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_surat_inspeksi">No Surat Inspeksi</label>
                                                <input class="form-control" type="text" id="no_surat_inspeksi" name="no_surat_inspeksi" value="{{ old('no_surat_inspeksi', !empty($instalasi) ? $instalasi->no_surat_inspeksi : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_surat_inspeksi">Tanggal Surat Inspeksi</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_surat_inspeksi" name="tanggal_surat_inspeksi" value="{{ old('tanggal_surat_inspeksi', !empty($instalasi) ? format_date($instalasi->tanggal_surat_inspeksi) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_slb">No RLB</label>
                                                <input class="form-control" type="text" id="no_slb" name="no_slb" value="{{ old('no_slb', !empty($instalasi) ? $instalasi->no_slb : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_slb">Tanggal RLB</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_slb" name="tanggal_slb" value="{{ old('tanggal_slb', !empty($instalasi) ? format_date($instalasi->tanggal_slb) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nilai_final">Nilai Final Quantity</label>
                                                <input class="form-control" type="text" id="nilai_final" name="nilai_final" value="{{ old('nilai_final', !empty($instalasi) ? $instalasi->nilai_final : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_energize">Tanggal Energize</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_energize" name="tanggal_energize" value="{{ old('tanggal_energize', !empty($instalasi) ? format_date($instalasi->tanggal_energize) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_st1">No ST1</label>
                                                <input class="form-control" type="text" id="no_st1" name="no_st1" value="{{ old('no_st1', !empty($instalasi) ? $instalasi->no_st1 : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_st1">Tanggal ST1</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_st1" name="tanggal_st1" value="{{ old('tanggal_st1', !empty($instalasi) ? format_date($instalasi->tanggal_st1) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_st2">No ST2</label>
                                                <input class="form-control" type="text" id="no_st2" name="no_st2" value="{{ old('no_st2', !empty($instalasi) ? $instalasi->no_st2 : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_st2">Tanggal ST2</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_st2" name="tanggal_st2" value="{{ old('tanggal_st2', !empty($instalasi) ? format_date($instalasi->tanggal_st2) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_slo">No SLO</label>
                                                <input class="form-control" type="text" id="no_slo" name="no_slo" value="{{ old('no_slo', !empty($instalasi) ? $instalasi->no_slo : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_slo">Tanggal SLO</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_slo" name="tanggal_slo" value="{{ old('tanggal_slo', !empty($instalasi) ? format_date($instalasi->tanggal_slo) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_stop">No STOP</label>
                                                <input class="form-control" type="text" id="no_stop" name="no_stop" value="{{ old('no_stop', !empty($instalasi) ? $instalasi->no_stop : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_stop">Tanggal STOP</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_stop" name="tanggal_stop" value="{{ old('tanggal_stop', !empty($instalasi) ? format_date($instalasi->tanggal_stop) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_stap">No STAP</label>
                                                <input class="form-control" type="text" id="no_stap" name="no_stap" value="{{ old('no_stap', !empty($instalasi) ? $instalasi->no_stap : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_stap">Tanggal STAP</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_stap" name="tanggal_stap" value="{{ old('tanggal_stap', !empty($instalasi) ? format_date($instalasi->tanggal_stap) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_stp">No STP</label>
                                                <input class="form-control" type="text" id="no_stp" name="no_stp" value="{{ old('no_stp', !empty($instalasi) ? $instalasi->no_stp : '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_stp">Tanggal STP</label>
                                                <input class="form-control kt-datepicker" type="text" id="tanggal_stp" name="tanggal_stp" value="{{ old('tanggal_stp', !empty($instalasi) ? format_date($instalasi->tanggal_stp) : '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(!empty($instalasi))
                        <div class="card-footer text-right py-3">
                            <form action="{{ route('instalasi.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $instalasi->id }}">
                                <button type="submit" class="btn btn-danger"><i class="la la-times"></i> Hapus Instalasi</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

