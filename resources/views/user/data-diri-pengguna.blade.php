<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Data Diri Pengguna | KITAPTN</title>
</head>

<body>

    <div class="container mb-4">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="#" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="{{ asset('assets/images/logo-aplikasi.png') }}" width="125" height="auto"
                        alt="logo-user" />
                </a>
            </div>
        </header>
    </div>

    <div class="row justify-content-center gy-3 gy-md-4">
        <div class="col-4">
            <div class="card widget-card border-light shadow">
                <div class="card-header bg-transparent p-4 border-light-subtle">
                    <h5 class="card-title widget-card-title m-0 text-center">Data Diri</h5>
                </div>
                <div class="card-body p-4">
                    <div class="col-md-12">
                        <form action="{{ route('store.user.dataPengguna') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input readonly type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                            </div>
                            <div>
                                <label for="username" class="form-label mt-3">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ auth()->user()->username }}">
                            </div>
                            <div>
                                <label for="nomer_tlp" class="form-label mt-3">Nomer Telepon</label>
                                <input type="number" name="nomer_tlp" class="form-control" id="nomer_tlp" required>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="birthdate" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="kota_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="kota_lahir" id="kota_lahir" required>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control" id="kecamatan" required>
                            </div>
                            <div class="mt-3">
                                <label for="kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control" id="kelurahan" required>
                            </div>
                            <div class="mt-3">
                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                <input type="number" name="kode_pos" class="form-control" id="kode_pos" required>
                            </div>
                            <div class="col-12 mt-4 text-center">
                                <button type="submit" id="continue" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>

    @if(session('status'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('status') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
</body>
</html>
