@extends('layouts.app')

@section('title', 'Review Details')

@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Review Detail
        </h1>
    </div>
@endsection

@section('content')
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Review Details</h3>
            </div>
            <a href="{{ route('ReviewAplikasi.edit', $reviews) }}" class="btn btn-primary align-self-center">
                Edit
            </a>
        </div>
        <div class="card-body p-9">
            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Profil Pengguna</label>
                <div class="col-lg-8">
                    @if ($reviews->user->profile_photo_path)
                        <img src="{{ asset('storage/' . $reviews->user->profile_photo_path) }}" alt="image" width="100px"
                            height="100px" />
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Nama Pengguna</label>
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $reviews->user->name }}</span>
                </div>
            </div>

            <div class="row mb-7">
                <label class="col-lg-4 fw-semibold text-muted">Dekripsi</label>
                <div class="col-lg-8">
                    @if ($reviews->description)
                        <span class="fw-bold fs-6 text-gray-800">{!! $reviews->description !!}</span>
                    @else
                        <p>-</p>
                    @endif

                </div>
            </div>
        </div>
    @endsection
