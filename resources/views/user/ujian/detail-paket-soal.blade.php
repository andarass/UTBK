<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Detail Paket Soal</title>
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
                <div class="card-header bg-transparent p-4 border-light-subtle">
                    <h5 class="card-title widget-card-title m-0 text-center">Detail Paket Soal</h5>
                </div>
                <div class="card-body p-4">
                    <div class="col-md-8">
                        @foreach ($kategoris as $kategori)
                            <p class="fw-medium">{{ $kategori->name }} : <span>{{ $kategori->soal_ujian_count }}</span>
                            </p>
                        @endforeach
                    </div>
                    <div class="col-12 mt-4 text-center">
                        <button type="submit" onclick="mulaiUjian()" id="continue"
                            class="btn btn-primary">Mulai</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"> --}}
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

        function mulaiUjian() {
            sessionStorage.clear();

            // Update waktu awal
            updateWaktuAwal();

            let paketSoalId = <?php echo json_encode($paketSoal->id); ?>;
            let soalByCategory = <?php echo json_encode($soalByCategory); ?>;

            if (!soalByCategory || Object.keys(soalByCategory).length === 0) {
                // Handle the case where soalByCategory is null or empty
                console.error("Invalid or empty soalByCategory.");
                return;
            }

            // Get the keys of soalByCategory
            let categoryKeys = Object.keys(soalByCategory);

            // Get the index of the first question in the first category
            let questionIndex = 0;

           
            if (categoryKeys.length > 0) {

                let firstCategoryKey = categoryKeys[0];

                if (soalByCategory[firstCategoryKey].length > questionIndex) {

                    let firstQuestion = soalByCategory[firstCategoryKey][questionIndex];

                    window.location.href = `/soal-ujian/${paketSoalId}/${firstQuestion.id}`;
                    return;
                }
            }
        }
    </script>
</body>

</html>
