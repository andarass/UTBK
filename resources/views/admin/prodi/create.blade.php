@extends('layouts.app')
@section('title', 'Tambah Prodi')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Tambah Prodi
        </h1>
    </div>
@endsection
@push('styles')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="card card-docs flex-row-fluid mb-2">
        <div class="card-body fs-6 text-gray-700">
            <form action="{{ route('Prodi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="name" class="fs-6 fw-bold mt-2 mb-3">Prodi</label>
                        </div>
                        <div class="col-lg">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                placeholder="Input Prodi" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="nilai_minimal" class="fs-6 fw-bold mt-2 mb-3">Nilai Minimal</label>
                        </div>
                        <div class="col-lg">
                            <input type="text" name="nilai_minimal" class="form-control" value="{{ old('nilai_minimal') }}"
                                placeholder="Input nilai minimal" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="universitas_id" class="fs-6 fw-bold mt-2 mb-3">Universitas</label>
                        </div>
                        <div class="col-lg">
                            <select name="universitas_id" id="universitas_id" class="form-select custom-placeholder"
                                data-control="select2" data-placeholder="Pilih Universitas">
                                <option value="" disabled selected>Pilih Universitas</option>
                                @foreach ($universitas as $university)
                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                @endforeach
                            </select>
                            @error('universitas_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('Prodi.index') }}" type="reset"
                        class="btn btn-light btn-active-light-primary me-2">Batalkan</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
