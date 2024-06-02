@extends('layouts.app')
@section('title', 'Edit User')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Edit User
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
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center text-center my-0">
                    User Detail
                </h1>
            </div>
            <form action="{{ route('User.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body p-9">
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="name" class="fs-6 fw-bold mt-2 mb-3">Nama User</label>
                        </div>
                        <div class="col-lg">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " value="{{ old('name') ? old('name') : ($user->name ?? '') }}"  placeholder="Nama User " />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="username" class="fs-6 fw-bold mt-2 mb-3">User Name</label>
                        </div>
                        <div class="col-lg">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror " value="{{ old('username') ? old('username') : ($user->username ?? '') }}" placeholder="No. WhatsApp" />
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="email" class="fs-6 fw-bold mt-2 mb-3">Email</label>
                        </div>
                        <div class="col-lg">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror " value="{{ old('email') ? old('email') : ($user->email ?? '') }}" placeholder="Email" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-xl-3">
                            <label for="role" class="fs-6 fw-bold mt-2 mb-3">Role</label>
                        </div>
                        <div class="col-lg">
                            <select name="role" class="form-select  @error('role') is-invalid @enderror " value="{{ old('role') ? old('role') : ($user->role ?? '') }}" data-control="select2" data-hide-search="true">
                                <option {{ $user->role == 'Super Admin' ? 'selected' : '' }} value="Super Admin">Super Admin</option>
                                <option {{ $user->role == 'User' ? 'selected' : '' }} value="User">User</option>
                            </select>
                            @error('role')
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
                            <select name="prodis_id" id="prodis_id" class="form-select" data-control="select2">
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ $prodi->id == $user->prodis_id ? 'selected' : '' }}>
                                        {{ $prodi->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('prodis_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="{{ route('User.index') }}" type="reset" class="btn btn-light btn-active-light-primary me-2">Batalkan</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).on("click", "#delete-confirm", function(e) {
        Swal.fire({
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-light'
            },
            title: 'Apakah anda yakin?',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                e.preventDefault();
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("article");
                var url = e.target;
                var route = `articles/${id}/destroy`;
                $.ajax({
                    url: route,
                    type: 'DELETE',
                    data: {
                        _token: token,
                        id: id
                    },
                });
                location.reload();
                return false;
            }
        })
    });
</script>
@endpush
