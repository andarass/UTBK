@extends('layouts.app')

@section('title', 'Soal Detail')

@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Soal Detail
        </h1>
    </div>
@endsection

@section('content')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Soal Details</h3>
            </div>
            <a href="{{ route('SoalUjian.edit', $soalUjian) }}" class="btn btn-primary align-self-center">
                Edit
            </a>
        </div>
        <div class="card-body p-9">
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Konten Bacaan</label>
                <div class="col-lg-8">
                    @if ($soalUjian->konten_bacaan_teks)
                        <span class="fw-bold fs-6 text-gray-800">{!! nl2br(e($soalUjian->text_content)) !!}</span>
                    @elseif ($soalUjian->konten_bacaan_gambar)
                        <img src="{{ asset('storage/reading-ujian/' .$soalUjian->image_content) }}" alt="image"
                            width="100px" height="100px" />
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Soal</label>
                <div class="col-lg-8">
                    @if ($soalUjian->soal)
                        <span class="fw-bold fs-6 text-gray-800">{!! $soalUjian->soal !!}</span>
                    @else
                        <p>-</p>
                    @endif

                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Soal Gambar</label>
                <div class="col-lg-8">
                    @if ($soalUjian->soal_gambar)
                        <img src="{{ asset('storage/soal/' . $soalUjian->soal_gambar) }}" alt="image" width="100px"
                            height="100px" />
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Soal Audio</label>
                <div class="col-lg-8">
                    @if ($soalUjian->soal_audio)
                        <audio controls>
                            <source src="{{ asset('storage/soal/' . $soalUjian->soal_audio) }}" type="audio/mpeg">
                        </audio>
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban A</label>
                <div class="col-lg-8">
                    @if ($soalUjian->jawaban_a)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->jawaban_a }}</span>
                    @elseif ($soalUjian->jawaban_a_gambar)
                        <img src="{{ asset('storage/jawaban_a/' . $soalUjian->jawaban_a_gambar) }}" width="20%"
                            height="20%">
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban B</label>
                <div class="col-lg-8">
                    @if ($soalUjian->jawaban_b)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->jawaban_b }}</span>
                    @elseif ($soalUjian->jawaban_b_gambar)
                        <img src="{{ asset('storage/jawaban_b/' . $soalUjian->jawaban_b_gambar) }}" width="100px"
                            height="100px">
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban C</label>
                <div class="col-lg-8">
                    @if ($soalUjian->jawaban_c)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->jawaban_c }}</span>
                    @elseif ($soalUjian->jawaban_c_gambar)
                        <img src="{{ asset('storage/jawaban_c/' . $soalUjian->jawaban_c_gambar) }}" width="100px"
                            height="100px">
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban D</label>
                <div class="col-lg-8">
                    @if ($soalUjian->jawaban_d)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->jawaban_d }}</span>
                    @elseif ($soalUjian->jawaban_d_gambar)
                        <img src="{{ asset('storage/jawaban_d/' . $soalUjian->jawaban_d_gambar) }}" width="100px"
                            height="100px">
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Jawaban E</label>
                <div class="col-lg-8">
                    @if ($soalUjian->jawaban_e)
                        <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->jawaban_e }}</span>
                    @elseif ($soalUjian->jawaban_e_gambar)
                        <img src="{{ asset('storage/jawaban_e/' . $soalUjian->jawaban_e_gambar) }}" width="100px"
                            height="100px">
                    @endif
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Kunci Jawaban</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->kunci_jawaban }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Point Soal</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->point_soal }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Kategori Soal</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->Kategori->name }}</span>
                </div>
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Paket Soal</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $soalUjian->PaketSoal->name }}</span>
                </div>
            </div>
        </div>
    @endsection
