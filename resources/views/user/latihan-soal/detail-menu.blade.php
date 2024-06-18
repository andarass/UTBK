<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Latihan Soal | KITAPTN</title>
    <style>
        body {
            background-color: #EBF8FF;
        }
    </style>
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
                <div class="card-header p-4 border-light-subtle" style="background-color:#0C3080;">
                    <h5 class="card-title widget-card-title m-0 text-white">Latihan Soal</h5>
                </div>
                <div class="card-body p-4">
                    <div class="col-md-6">
                        <label for="kategoriSoal" class="form-label">Kategori Soal</label>
                        <select name="kategoriSoal" id="kategoriSoal" class="form-select" required>
                            <option value="" hidden>Pilih Kategori Soal</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="kategoriLatihanSoal" class="form-label">Kategori Latihan Soal</label>
                        <select name="kategoriLatihanSoal" id="kategoriLatihanSoal" class="form-select" required>
                            <option value="" hidden>Pilih Kategori Latihan Soal</option>
                            @foreach ($kategoriLatihanSoals as $kategoriLatihanSoal)
                                <option value="{{ $kategoriLatihanSoal->id }}">{{ $kategoriLatihanSoal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        {{-- <button type="submit" id="continue" class="btn btn-primary">Masuk</button> --}}
                        <a href="" type="submit" id="continue" class="btn btn-primary">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>

    <script>
        document.getElementById('kategoriSoal').addEventListener('change', function() {
            var kategoriSoalId = this.value;
            var kategoriLatihanSoalSelect = document.getElementById('kategoriLatihanSoal');
            kategoriLatihanSoalSelect.innerHTML = '<option value="" hidden>Pilih Kategori Latihan Soal</option>';

            @foreach ($kategoriLatihanSoals as $kategoriLatihanSoal)
                if ({{ $kategoriLatihanSoal->kategori_id }} == kategoriSoalId) {
                    var option = document.createElement('option');
                    option.value = {{ $kategoriLatihanSoal->id }};
                    option.text = '{{ $kategoriLatihanSoal->name }}';
                    kategoriLatihanSoalSelect.appendChild(option);
                }
            @endforeach
        });
    </script>
    <script>
        document.getElementById('continue').addEventListener('click', function() {
            event.preventDefault();
            let selectedPackage = document.getElementById('kategoriLatihanSoal').value;
            window.location.href = '/latihan-soal/' + selectedPackage;
        });
    </script>
</body>
</html>
