@extends('layouts.app')
@section('title', 'Ujian Soal')
@section('page-title')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold flex-column justify-content-center my-0">
            Ujian Soal
        </h1>
    </div>
@endsection
@section('content')

    <div class="card card-flush">
        <div class="card-header d-flex justify-content-between">
            <div class="col-xl-12">
                <div class="card card-stretch h-auto">
                    <div class="card-body px-0">
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#tab-kategori-saintek">Saintek</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true"
                                    data-bs-toggle="tab" href="#tab-kategori-soshum">Soshum</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab-kategori-saintek" role="tabpanel">
                                <div class="card-body pt-0">
                                    <div class="card-header d-flex justify-content-between p-0">
                                        <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                        height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <input type="search" name="search"
                                                class="form-control form-control-solid w-250px ps-15" id="search"
                                                placeholder="Cari.." />
                                        </div>
                                        <div class="d-flex flex-stack">
                                            <a type="button" class="btn btn-primary ms-2"
                                                href="{{ route('admin.paket-soal-ujian-saintek.create') }}">
                                                Tambah Soal
                                            </a>
                                        </div>
                                    </div>
                                    <table id="kategori_saintek"
                                        class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3">
                                        <thead>
                                            <tr class="fw-semibold fs-6 text-muted">
                                                <th class="text-start min-w-100px">No</th>
                                                <th class="text-start min-w-100px">Soal</th>
                                                <th class="text-start min-w-100px">Soal Gambar</th>
                                                <th class="text-center min-w-100px">Soal Audio</th>
                                                <th class="text-start min-w-100px">Kategori Soal</th>
                                                <th class="text-start min-w-100px">Paket Soal</th>
                                                <th class="text-start min-w-100px">Kategori test</th>
                                                <th class="text-end min-w-100px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-kategori-soshum" role="tabpanel">
                                <div class="card-body pt-0">
                                    <div class="card-header d-flex justify-content-between p-0">
                                        <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                        height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <input type="search" name="search"
                                                class="form-control form-control-solid w-250px ps-15" id="search"
                                                placeholder="Cari.." />
                                        </div>
                                        <div class="d-flex flex-stack">
                                            <a id="kategori-soshum-button" type="button" class="btn btn-primary ms-2"
                                                href="{{ route('admin.paket-soal-ujian-soshum.create') }}">
                                                Tambah Paket Soal
                                            </a>

                                        </div>
                                    </div>
                                    <table id="kategori_soshum"
                                        class="table table-row-dashed align-middle fs-6 gy-4 my-0 pb-3">
                                        <thead>
                                            <tr class="fw-semibold fs-6 text-muted">
                                                <th class="text-start min-w-100px">No</th>
                                                <th class="text-start min-w-100px">Soal</th>
                                                <th class="text-start min-w-100px">Soal Gambar</th>
                                                <th class="text-center min-w-100px">Soal Audio</th>
                                                <th class="text-start min-w-100px">Kategori Soal</th>
                                                <th class="text-start min-w-100px">Paket Soal</th>
                                                <th class="text-start min-w-100px">Kategori test</th>
                                                <th class="text-end min-w-100px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        var datatableSoshum = $('#kategori_soshum').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            stateSave: false,
            ajax: {
                url: 'SoalUjian/getSoalUjianSoshum',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: true,
                    searchable: true,
                    width: '10%'
                },
                {
                    data: 'soal',
                    name: 'soal',
                    orderable: true,
                    searchable: true,
                    width: '30%',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            if (data.length > 100) {
                                return data.slice(0, 100);
                            } else {
                                return data;
                            }
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'soal_gambar',
                    name: 'soal_gambar',
                    orderable: true,
                    searchable: true,
                    width: '20%',
                    // render: function (data, type, row) {
                    //     if (type === 'display') {
                    //         if (data) {
                    //             return '<img src="'+ data +'" width="50%" height="50%">';
                    //         } else {
                    //             return 'Tidak Ada Gambar';
                    //         }
                    //     } else {
                    //         return data;
                    //     }
                    // }
                },
                {
                    data: 'soal_audio',
                    name: 'soal_audio',
                    orderable: true,
                    searchable: true,
                    width: '20%',
                    // render: function (data, type, row) {
                    //     if (type === 'display') {
                    //         if (data) {
                    //             return '<audio controls><source src="'+ data +'" type="audio/mpeg"></audio>';
                    //         } else {
                    //             return 'Tidak Ada Audio';
                    //         }
                    //     } else {
                    //         return data;
                    //     }
                    // }
                },
                {
                    data: 'kategori_soal',
                    name: 'kategori_soal',
                    orderable: true,
                    searchable: true,
                    width: '30%'
                },
                {
                    data: 'paket_soal',
                    name: 'paket_soal',
                    orderable: true,
                    searchable: true,
                    width: '30%'
                },
                {
                    data: 'kategori_utbk',
                    name: 'kategori_utbk',
                    orderable: true,
                    searchable: true,
                    width: '30%'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
            ],
            order: [
                [0, "asc"]
            ]
        });


        $('#search').on('keyup', function() {
            datatable.search(this.value).draw();
        });

        datatableSoshum.on('click', '.delete-confirm-kategoriSoshum', function(e) {
            e.preventDefault();

            Swal.fire({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                },
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var route = "{{ route('admin.soal-ujian-soshum.destroy', ':id') }}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url: route,
                        type: 'DELETE',
                        data: {
                            _token: $("meta[name='csrf-token']").attr("content"),
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            datatableSoshum.ajax.reload();
                        },
                        error: function(xhr) {
                            var json = JSON.parse(xhr.responseText);
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Error',
                                text: json.error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
                }
            })
        });
    </script>
    <script>
        var datatable = $('#kategori_saintek').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            stateSave: false,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: true,
                    searchable: true,
                    width: '10%'
                },
                {
                    data: 'soal',
                    name: 'soal',
                    orderable: true,
                    searchable: true,
                    width: '30%',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            if (data.length > 100) {
                                return data.slice(0, 100);
                            } else {
                                return data;
                            }
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: 'soal_gambar',
                    name: 'soal_gambar',
                    orderable: true,
                    searchable: true,
                    width: '20%',
                    // render: function (data, type, row) {
                    //     if (type === 'display') {
                    //         if (data) {
                    //             return '<img src="'+ data +'" width="50%" height="50%">';
                    //         } else {
                    //             return 'Tidak Ada Gambar';
                    //         }
                    //     } else {
                    //         return data;
                    //     }
                    // }
                },
                {
                    data: 'soal_audio',
                    name: 'soal_audio',
                    orderable: true,
                    searchable: true,
                    width: '20%',
                    // render: function (data, type, row) {
                    //     if (type === 'display') {
                    //         if (data) {
                    //             return '<audio controls><source src="'+ data +'" type="audio/mpeg"></audio>';
                    //         } else {
                    //             return 'Tidak Ada Audio';
                    //         }
                    //     } else {
                    //         return data;
                    //     }
                    // }
                },
                {
                    data: 'kategori_soal',
                    name: 'kategori_soal',
                    orderable: true,
                    searchable: true,
                    width: '30%'
                },
                {
                    data: 'paket_soal',
                    name: 'paket_soal',
                    orderable: true,
                    searchable: true,
                    width: '30%'
                },
                {
                    data: 'kategori_utbk',
                    name: 'kategori_utbk',
                    orderable: true,
                    searchable: true,
                    width: '30%'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
            ],
            order: [
                [0, "asc"]
            ]
        });

        $('#search').on('keyup', function() {
            datatable.search(this.value).draw();
        });

        $(document).on("click", ".delete-confirm", function(e) {
            e.preventDefault();
            Swal.fire({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                },
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.preventDefault();
                    var id = $(this).data("id");
                    var route = "{{ route('admin.paket-soal-ujian-saintek.delete', ':id') }}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url: route,
                        type: 'DELETE',
                        data: {
                            _token: $("meta[name='csrf-token']").attr("content"),
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            datatable.ajax.reload();
                        },
                        error: function(xhr) {
                            var json = JSON.parse(xhr.responseText);
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                title: 'Error',
                                text: json.error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
                }
            })
        });
    </script>
@endpush
