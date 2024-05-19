<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Kriteria Kelulusan | KITAPTN</title>
</head>

<body>
    <div class="container mb-2">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="#" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="{{ asset('assets/images/logo-aplikasi.png') }}" width="125" height="auto" alt="logo-user" />
                </a>
            </div>
        </header>
    </div>

    <div class="row justify-content-center gy-3 gy-md-4">
        <div class="col-8">
            <div class="card widget-card border-light shadow">
                <div class="card-header bg-transparent p-4 border-light-subtle">
                    <h5 class="card-title widget-card-title m-0 text-center">Kriteria Kelulusan - {{ $prodi->name }} {{ $prodi->Universitas->name }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="col-md-12">
                        <p>Untuk lulus di prodi <strong>{{ $prodi->name }}</strong> pada universitas <strong>{{ $prodi->Universitas->name }}</strong>, Anda harus mendapatkan minimal <strong>{{ $prodi->nilai_minimal }}</strong> poin.</p>
                        <a href="{{ route('user.ujian.skor-akhir-ujian') }}" class="btn btn-primary mt-4">Kembali ke Hasil Ujian</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
