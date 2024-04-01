@extends('layouts.app')
@section('title', 'Edit Ujian Soal')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Edit Soal
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
            <form action="{{ route('SoalUjian.update', $soalUjian->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="soal" class="fs-6 fw-bold mt-2 mb-3">Soal</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="soal" id="soal" class="form-control" value="{{ $soalUjian->soal }}" placeholder="Input Soal">
                                @if (old('soal'))
{{ old('soal') }}
@elseif(isset($soalUjian))
{{ $soalUjian->soal }}
@endif
                            </textarea>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="soal_gambar" class="fs-6 fw-bold mt-2 mb-3">Soal Gambar</label>
                        </div>
                        <div class="col-lg">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15"
                                id="file_input" name="soal_gambar" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG or JPG(MAX.
                                5MB).</p>
                            @if ($soalUjian->soal_gambar)
                                <p>Current Image:</p>
                                <img src="{{ asset('storage/soal/' . $soalUjian->soal_gambar) }}" alt="Current Image"
                                    width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    class="text-red-500">Hapus Gambar</a>
                            @else
                                <p>No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="soal_audio" class="fs-6 fw-bold mt-2 mb-3">Soal Audio</label>
                        </div>
                        <div class="col-lg">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15"
                                id="file_input" name="soal_audio" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">MP3(MAX. 5MB).</p>
                            @if ($soalUjian->soal_audio)
                                <audio controls>
                                    <source src="{{ asset('storage/soal/' . $soalUjian->soal_audio) }}" type="audio/mpeg">
                                </audio>
                                <a href="{{ route('admin.soal-ujian.delete_audio', ['id' => $soalUjian->id]) }}"
                                    class="text-red-500">Hapus Audio</a>
                            @else
                                <p>No Audio Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="konten_bacaan_teks" class="fs-6 fw-bold mt-2 mb-3">Konten Bacaan Teks</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="konten_bacaan_teks" id="konten_bacaan_teks" class="form-control"
                                value="{{ $soalUjian->konten_bacaan_teks }}" placeholder="Input Konten Bacaan Teks">
                                @if (old('konten_bacaan_teks'))
{{ old('konten_bacaan_teks') }}
@elseif(isset($soalUjian))
{{ $soalUjian->konten_bacaan_teks }}
@endif
                            </textarea>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="konten_bacaan_gambar" class="fs-6 fw-bold mt-2 mb-3">Konten Bacaan Gambar</label>
                        </div>
                        <div class="col-lg">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15"
                                id="file_input" name="konten_bacaan_gambar" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG or JPG(MAX.
                                5MB).</p>
                            @if ($soalUjian->konten_bacaan_gambar)
                                <p>Current Image:</p>
                                <img src="{{ asset('storage/reading-ujian/' . $soalUjian->konten_bacaan_gambar) }}"
                                    alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    class="text-red-500">Hapus Gambar</a>
                            @else
                                <p>No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_a" class="fs-6 fw-bold mt-2 mb-3">Jawaban A</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_a_type" value="text" id="textAnswerRadio" checked />
                            <label for="textAnswerRadio">Teks</label>
                            <input type="radio" name="answer_a_type" value="image" id="imageAnswerRadio" />
                            <label for="imageAnswerRadio">Gambar</label>
                            <textarea name="jawaban_a" id="answer_a" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->jawaban_a }}" placeholder="Input Jawaban A">
                                @if (old('jawaban_a'))
{{ old('jawaban_a') }}
@elseif(isset($soalUjian))
{{ $soalUjian->jawaban_a }}
@endif
                                </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="jawaban_a_gambar" id="imageAnswerA" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_a"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->jawaban_a_gambar)
                                <img src="{{ asset('storage/jawaban_a/' . $soalUjian->jawaban_a_gambar) }}"
                                    id="image-answer-a" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-a" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-a">No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_b" class="fs-6 fw-bold mt-2 mb-3">Jawaban B</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_b_type" value="text" id="textAnswerRadioB" checked />
                            <label for="textAnswerRadioB">Teks</label>
                            <input type="radio" name="answer_b_type" value="image" id="imageAnswerRadioB" />
                            <label for="imageAnswerRadioB">Gambar</label>
                            <textarea name="jawaban_b" id="answer_b" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->jawaban_b }}" placeholder="Input Jawaban B">
                                @if (old('jawaban_b'))
{{ old('jawaban_b') }}
@elseif(isset($soalUjian))
{{ $soalUjian->jawaban_b }}
@endif
                            </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="jawaban_b_gambar" id="imageAnswerB" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_b"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->jawaban_b_gambar)
                                <img src="{{ asset('storage/jawaban_b/' . $soalUjian->jawaban_b_gambar) }}"
                                    id="image-answer-b" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-b" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-b">No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_c" class="fs-6 fw-bold mt-2 mb-3">Jawaban C</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_c_type" value="text" id="textAnswerRadioC" checked />
                            <label for="textAnswerRadioC">Teks</label>
                            <input type="radio" name="answer_c_type" value="image" id="imageAnswerRadioC" />
                            <label for="imageAnswerRadioC">Gambar</label>
                            <textarea name="jawaban_c" id="answer_c" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->jawaban_c }}" placeholder="Input Jawaban C"> @if (old('jawaban_c'))
{{ old('jawaban_c') }}
@elseif(isset($soalUjian))
{{ $soalUjian->jawaban_c }}
@endif </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="jawaban_c_gambar" id="imageAnswerC" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_c"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->jawaban_c_gambar)
                                <img src="{{ asset('storage/jawaban_c/' . $soalUjian->jawaban_c_gambar) }}"
                                    id="image-answer-c" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-c" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-c">No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_d" class="fs-6 fw-bold mt-2 mb-3">Jawaban D</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_d_type" value="text" id="textAnswerRadioD" checked />
                            <label for="textAnswerRadioD">Teks</label>
                            <input type="radio" name="answer_d_type" value="image" id="imageAnswerRadioD" />
                            <label for="imageAnswerRadioD">Gambar</label>
                            <textarea name="jawaban_d" id="answer_d" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->jawaban_d }}" placeholder="Input Jawaban D"> @if (old('jawaban_d'))
{{ old('jawaban_d') }}
@elseif(isset($soalUjian))
{{ $soalUjian->jawaban_d }}
@endif </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="jawaban_d_gambar" id="imageAnswerD" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_d"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->jawaban_d_gambar)
                                <img src="{{ asset('storage/jawaban_d/' . $soalUjian->jawaban_d_gambar) }}"
                                    id="image-answer-d" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-d" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-d">No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="answer_e" class="fs-6 fw-bold mt-2 mb-3">Jawaban E</label>
                        </div>
                        <div class="col-lg">
                            <input type="radio" name="answer_e_type" value="text" id="textAnswerRadioE" checked />
                            <label for="textAnswerRadioE">Teks</label>
                            <input type="radio" name="answer_e_type" value="image" id="imageAnswerRadioE" />
                            <label for="imageAnswerRadioE">Gambar</label>
                            <textarea name="jawaban_e" id="answer_e" class="form-control z-depth-1 mt-2" rows="3"
                                value="{{ $soalUjian->jawaban_e }}" placeholder="Input Jawaban E"> @if (old('jawaban_e'))
{{ old('jawaban_e') }}
@elseif(isset($soalUjian))
{{ $soalUjian->jawaban_e }}
@endif </textarea>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 h-15 mt-2"
                                name="jawaban_e_gambar" id="imageAnswerE" type="file" style="display: none;" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_image_answer_e"
                                style="display: none;">PNG or JPG(MAX. 5MB).</p>
                            @if ($soalUjian->jawaban_e_gambar)
                                <img src="{{ asset('storage/jawaban_e/' . $soalUjian->jawaban_e_gambar) }}"
                                    id="image-answer-e" alt="Current Image" width="20%" height="20%">
                                <a href="{{ route('admin.soal-ujian.delete_image', ['id' => $soalUjian->id]) }}"
                                    id="delete-button-e" class="text-red-500">Hapus Gambar</a>
                            @else
                                <p id="keterangan-no-image-e">No Image Uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="kunci_jawaban" class="fs-6 fw-bold mt-2 mb-3">Kunci Jawaban</label>
                        </div>
                        <div class="col-lg">
                            <select name="kunci_jawaban"
                                class="form-select @error('kunci_jawaban') is-invalid @enderror" data-control="select2"
                                data-placeholder="Pilih Kunci Jawaban">
                                <option value="" disabled selected>Pilih Kunci Jawaban</option>
                                <option value="A" {{ $soalUjian->kunci_jawaban == 'A' ? 'selected' : '' }}>A
                                </option>
                                <option value="B" {{ $soalUjian->kunci_jawaban == 'B' ? 'selected' : '' }}>B
                                </option>
                                <option value="C" {{ $soalUjian->kunci_jawaban == 'C' ? 'selected' : '' }}>C
                                </option>
                                <option value="D" {{ $soalUjian->kunci_jawaban == 'D' ? 'selected' : '' }}>D
                                </option>
                                <option value="E" {{ $soalUjian->kunci_jawaban == 'E' ? 'selected' : '' }}>E
                                </option>
                            </select>
                            @error('kunci_jawaban')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="point_soal" class="fs-6 fw-bold mt-2 mb-3">Point Soal</label>
                        </div>
                        <div class="col-lg">
                            <input type="number" name="point_soal" class="form-control"
                                value="{{ $soalUjian->point_soal }}" placeholder="Input Point Soal" />
                            @error('point_soal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="kategori_id" class="fs-6 fw-bold mt-2 mb-3">Kategori Soal</label>
                        </div>
                        <div class="col-lg">
                            <select name="kategori_id" id="kategori_id" class="form-select" data-control="select2">
                                @foreach ($kategoriSoals as $kategoriSoal)
                                    <option value="{{ $kategoriSoal->id }}"
                                        {{ $kategoriSoal->id == $soalUjian->kategori_id ? 'selected' : '' }}>
                                        {{ $kategoriSoal->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="paket_soal_id" class="fs-6 fw-bold mt-2 mb-3">Paket Soal</label>
                        </div>
                        <div class="col-lg">
                            <select name="paket_soal_id" id="paket_soal_id" class="form-select" data-control="select2">
                                @foreach ($paketSoal as $paket)
                                    <option value="{{ $paket->id }}"
                                        {{ $paket->id == $soalUjian->paket_soal_id ? 'selected' : '' }}>
                                        {{ $paket->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paket_soal_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('SoalUjian.index') }}" type="reset"
                        class="btn btn-light btn-active-light-primary me-2">Batalkan</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="/js/tinymce/tinymce.min.js"></script> --}}

    <script>
        function initTinyMCE(selector) {
            tinymce.init({
                selector: selector,
                forced_root_block: 'p',
                force_br_newlines: true,
                formats: {
                    underline: {
                        inline: 'u'
                    } // Mengizinkan garis bawah
                }
            });
        }
        initTinyMCE('textarea#soal');
    </script>

    <script>
        function initTinyMCE(selector) {
            tinymce.init({
                selector: selector,
                forced_root_block: 'p',
                force_br_newlines: true,
                formats: {
                    underline: {
                        inline: 'u'
                    } // Mengizinkan garis bawah
                }
            });
        }
        initTinyMCE('textarea#konten_bacaan_teks');
    </script>

    <script>
        //answer_a
        $(document).ready(function() {
            $('input[type="radio"][name="answer_a_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_a').show();
                    $('#imageAnswerA').hide();
                    $('#file_input_image_answer_a').hide();
                    $('#image-answer-a').hide();
                    $('#delete-button-a').hide();
                    $('#keterangan-no-image-a').hide();
                } else if ($(this).val() === "image") {
                    $('#answer_a').hide();
                    $('#imageAnswerA').show();
                    $('#file_input_image_answer_a').show();
                    $('#image-answer-a').show();
                    $('#delete-button-a').show();
                    $('#keterangan-no-image-a').show();
                }
            });
        });

        //answer_b
        $(document).ready(function() {
            $('input[type="radio"][name="answer_b_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_b').show();
                    $('#imageAnswerB').hide();
                    $('#file_input_image_answer_b').hide();
                    $('#image-answer-b').hide();
                    $('#delete-button-b').hide();
                    $('#keterangan-no-image-b').hide();
                } else if ($(this).val() === "image") {
                    $('#answer_b').hide();
                    $('#imageAnswerB').show();
                    $('#file_input_image_answer_b').show();
                    $('#image-answer-b').show();
                    $('#delete-button-b').show();
                    $('#keterangan-no-image-b').show();
                }
            });
        });

        //answer_c
        $(document).ready(function() {
            $('input[type="radio"][name="answer_c_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_c').show();
                    $('#imageAnswerC').hide();
                    $('#file_input_image_answer_c').hide();
                    $('#image-answer-c').hide();
                    $('#delete-button-c').hide();
                    $('#keterangan-no-image-c').hide();
                } else if ($(this).val() === "image") {
                    $('#answer_c').hide();
                    $('#imageAnswerC').show();
                    $('#file_input_image_answer_c').show();
                    $('#image-answer-c').show();
                    $('#delete-button-c').show();
                    $('#keterangan-no-image-c').show();
                }
            });
        });

        //answer_d
        $(document).ready(function() {
            $('input[type="radio"][name="answer_d_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_d').show();
                    $('#imageAnswerD').hide();
                    $('#file_input_image_answer_d').hide();
                    $('#image-answer-d').hide();
                    $('#delete-button-d').hide();
                    $('#keterangan-no-image-d').hide();

                } else if ($(this).val() === "image") {
                    $('#answer_d').hide();
                    $('#imageAnswerD').show();
                    $('#file_input_image_answer_d').show();
                    $('#image-answer-d').show();
                    $('#delete-button-d').show();
                    $('#keterangan-no-image-d').show();
                }
            });
        });

        //answer_e
        $(document).ready(function() {
            $('input[type="radio"][name="answer_e_type"]').change(function() {
                if ($(this).val() === "text") {
                    $('#answer_e').show();
                    $('#imageAnswerE').hide();
                    $('#file_input_image_answer_e').hide();
                    $('#image-answer-e').hide();
                    $('#delete-button-e').hide();
                    $('#keterangan-no-image-e').hide();

                } else if ($(this).val() === "image") {
                    $('#answer_e').hide();
                    $('#imageAnswerE').show();
                    $('#file_input_image_answer_e').show();
                    $('#image-answer-e').show();
                    $('#delete-button-e').show();
                    $('#keterangan-no-image-e').show();
                }
            });
        });
    </script>
@endpush
