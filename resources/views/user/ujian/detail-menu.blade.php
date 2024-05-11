<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Paket Soal Ujian</title>
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
        <div class="col-8">
            <div class="card widget-card border-light shadow">
                <div class="card-header bg-transparent p-4 border-light-subtle">
                    <h5 class="card-title widget-card-title m-0">Paket Soal Ujian</h5>
                </div>
                <div class="card-body p-4">
                    <div class="col-md-6">
                        <label for="" class="form-label">Paket Soal</label>
                        <select name="paketSoal" id="paketSoal" class="form-select">
                            <option value="" hidden>Pilih Paket Soal</option>
                            @foreach ($paketSoalUjians as $paketSoalUjian)
                                <option value="{{ $paketSoalUjian->id }}">{{ $paketSoalUjian->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" id="continue" class="btn btn-primary">Masuk</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script>
        document.getElementById('continue').addEventListener('click', function() {
            let selectedPackage = document.getElementById('paketSoal').value;
            window.location.href = '/paket-ujian/' + selectedPackage;
        });
    </script>
</body>

</html>
