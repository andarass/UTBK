<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Detail Kategori | KITAPTN</title>
    <style>
        body {
            background-color: #EBF8FF;
        }
    </style>
</head>

<body>
    <div class="container mb-2">
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
                <div class="card-header p-4 border-light-subtle" style="background-color:#0C3080;">
                    <h5 class="card-title widget-card-title m-0 text-center text-white">Detail Kategori Soal</h5>
                </div>
                <div class="card-body p-4">
                    <div class="col-md-8">
                        @foreach ($kategoriLatihanSoals as $kategoriLatihanSoal)
                        @if ($kategoriLatihanSoal->latihan_soal_count > 0)
                        <p class="text-base mt-2">{{ $kategoriLatihanSoal->name }}:
                            @if ($kategoriLatihanSoal->latihan_soal_count < 10)
                                {{ $kategoriLatihanSoal->latihan_soal_count }} Soal
                            @else
                                10 Soal
                            @endif
                        </p>
                    @endif
                    @endforeach
                    </div>
                    {{-- <input type="hidden" id="shuffledSoalIds" value="{{ json_encode($shuffledSoalIds) }}"> --}}
                    {{-- <div class="col-12 mt-4 text-center">
                        <a href="" onclick="mulaiTes()" class="btn btn-primary">Mulai</a>
                    </div> --}}
                    <div class="col-12 mt-4 text-center">
                        <a href="{{ route('user.soal-mulai', ['kategoriLatihanSoalId' => $soalAcak->kategori_latihan_soal_id, 'soalId' => $soalAcak->id]) }}" onclick="mulaiTes()" type="submit" id="continue" class="btn btn-primary">Mulai</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>

    <script>
        let waktuAwal = sessionStorage.getItem("waktuAwal");

        if (!waktuAwal) {
            waktuAwal = new Date().getTime();
            sessionStorage.setItem("waktuAwal", waktuAwal);
        }

        function updateWaktuAwal() {
            waktuAwal = new Date().getTime();
            sessionStorage.setItem("waktuAwal", waktuAwal);
        }
    </script>

    <script>
        function mulaiTes() {
            sessionStorage.clear();

            updateWaktuAwal();
        }
    </script>
</body>
</html>
