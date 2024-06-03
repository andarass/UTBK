@extends('layouts.app')
@section('title', 'Edit Review')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Edit Review
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
            <form action="{{ route('ReviewAplikasi.update', $review->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="user_id" class="fs-6 fw-bold mt-2 mb-3">Pengguna</label>
                        </div>
                        <div class="col-lg">
                            <select name="user_id" id="user_id" class="form-select" data-control="select2">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == $review->user_id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="description" class="fs-6 fw-bold mt-2 mb-3">Deskripsi</label>
                        </div>
                        <div class="col-lg">
                            <textarea name="description" id="description" class="form-control" value="{{ $review->description }}" placeholder="Input Deskripsi">
@if (old('description'))
{{ old('description') }}
@elseif(isset($review))
{{ $review->description }}
@endif
</textarea>
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

@push('scripts')
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
    initTinyMCE('textarea#description');
</script>
@endpush
