@extends('layouts.app')
@section('title', 'Profile Details')

@section('content')
@if (Auth::user()->hasRole('Super Admin'))
<div class="card mt-11">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Ubah Profile</h3>
        </div>
    </div>
    <!--begin::Card header-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <form id="kt_account_profile_details_form" method="POST" enctype="multipart/form-data" action="{{ route('update.profile') }}" class="form">
            @csrf
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Photo Profile</label>
                    <div class="col-lg-8">
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" id="image_preview_container" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('storage/'.auth()->user()->profile_photo_path) }})"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" id="profile_photo_path" name="profile_photo_path" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_image_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Lengkap</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input readonly type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Company name" value="{{ auth()->user()->name }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Username</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input readonly type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Company name" value="{{ auth()->user()->username }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Prodi</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input readonly type="text" name="prodi" class="form-control form-control-lg form-control-solid" placeholder="Prodi name" value="{{ auth()->user()->prodi->name ?? '-' }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input readonly type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email name" value="{{ auth()->user()->email }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <!--begin::Actions-->
				<div class="card-footer d-flex justify-content-end py-6 px-9">
					<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
					<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
				</div>
				<!--end::Actions-->
            </div>
        </form>
    </div>
</div>
@elseif (Auth::user()->hasRole('User'))
<div class="card mt-11">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Ubah Profile</h3>
        </div>
    </div>
    <!--begin::Card header-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <form id="kt_account_profile_details_form" method="POST" enctype="multipart/form-data" action="{{ route('user.update.profile') }}" class="form">
            @csrf
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Photo Profile</label>
                    <div class="col-lg-8">
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" id="image_preview_container" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('storage/'.auth()->user()->profile_photo_path) }})"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" id="profile_photo_path" name="profile_photo_path" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_image_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Lengkap</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input readonly type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Company name" value="{{ auth()->user()->name }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Username</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input readonly type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Company name" value="{{ auth()->user()->username }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Prodi</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input readonly type="text" name="prodi" class="form-control form-control-lg form-control-solid" placeholder="Prodi name" value="{{ auth()->user()->prodi->name ?? '-' }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input readonly type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email name" value="{{ auth()->user()->email }}" />
                    </div>
                    <!--end::Col-->
                </div>
                <!--begin::Actions-->
				<div class="card-footer d-flex justify-content-end py-6 px-9">
					<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
					<button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
				</div>
				<!--end::Actions-->
            </div>
        </form>
    </div>
</div>
@endif

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $("#kt_account_profile_details_submit").click(function() {
            var formData = new FormData($("#kt_account_profile_details_form")[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(this).attr("disabled", true).text("Updating...");

            $.ajax({
                type: "POST",
                url: $("#kt_account_profile_details_form").attr("action"),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.code == 400) {
                        let error = '<span class="alert alert-danger">' + response.msg + '</span>';
                        $("#res").html(error);
                    } else if (response.code == 200) {
                        let success = '<span class="alert alert-success">' + response.msg + '</span>';
                        $("#res").html(success);
                    }
                    $("#kt_account_profile_details_submit").attr("disabled", false).text("Save Changes");
                }
            });
        });

        $("#profile_photo_path").change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $("#image_preview_container").css('background-image', `url(${e.target.result})`);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endpush
