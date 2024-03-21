@extends('layouts.app')
@section('title', 'Edit Paket Ujian Soal Soshum')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Edit Paket Ujian Soal Soshum
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
            <form action="{{ route('admin.paket-soal-ujian-soshum.update', $PaketSoalSoshum->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="name" class="fs-6 fw-bold mt-2 mb-3">Nama Paket Soal</label>
                        </div>
                        <div class="col-lg">
                            <input type="text" name="name" class="form-control" value="{{ $PaketSoalSoshum->name }}"
                                placeholder="Input nama paket soal " />

                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="kategori_utbk_id" class="fs-6 fw-bold mt-2 mb-3">Kategori Utbk</label>
                        </div>
                        <div class="col-lg">
                            <select name="kategori_utbk_id" id="kategori_utbk_id" class="form-select"
                                data-control="select2">
                                @foreach ($kategoriUtbks as $kategoriUtbk)
                                    <option value="{{ $kategoriUtbk->id }}"
                                        {{ $kategoriUtbk->id == $PaketSoalSoshum ->kategori_utbk_id ? 'selected' : '' }}>
                                        {{ $kategoriUtbk->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_utbk_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
