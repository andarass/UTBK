<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Menu | KITAPTN</title>
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
                    <h5 class="card-title widget-card-title m-0">Menu</h5>
                </div>
                <div class="card-body p-4">
                    <div class="col-md-6">
                        <label for="" class="form-label">Menu</label>
                        <select name="menu" id="menu" class="form-select" data-gtm-form-interact-field-id="14">
                            <option value="" hidden>Pilih Menu</option>
                            <option value="latihan-soal">Latihan Soal</option>
                            <option value="ujian">Ujian</option>
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select dropdown element
            let menuSelect = document.getElementById('menu');

            // Add event listener for button click
            document.querySelector('button[type="submit"]').addEventListener('click', function() {
                // Get the selected value from the dropdown
                let selectedOption = menuSelect.value;

                // Redirect user based on selected option
                if (selectedOption === 'latihan-soal') {
                    window.location.href = "{{ route('user.latihan-soal') }}";
                } else if (selectedOption === 'ujian') {
                    window.location.href = "{{ route('user.ujian') }}";
                }
            });
        });
    </script>
</body>

</html>
