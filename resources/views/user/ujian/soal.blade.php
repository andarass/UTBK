<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Soal</title>
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
            <div class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="fs-4 fw-medium">Penalaran umum</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <span class="fs-4 fw-bold text-center">01:30:45</span>
            </div>
        </header>
    </div>

    <section class="pb-3 pb-md-4 pb-xl-5">
        <div class="container">
            <div class="row gy-3 gy-md-4">
                <div class="col-12 col-lg-5">
                    <div class="row gy-3 gy-md-4">
                        <div class="col-12">
                            <div class="card widget-card border-light shadow-sm">
                                <div
                                    class="card-header bg-transparent p-4 border-light-subtle d-flex flex-column align-items-center">
                                    <img class="rounded-circle mt-5" width="200" height="200"
                                        src="{{ asset('assets/images/user/logo-user.png') }}" alt="logo-user">
                                    <h5 class="card-title widget-card-title mb-3 mt-4">Duta Alif Gunawan</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card widget-card border-light shadow-sm">
                                <div class="card-header bg-transparent p-4 border-light-subtle">
                                    <h5 class="card-title widget-card-title m-0">Daftar Soal</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        @for ($i = 1; $i <= 20; $i++)
                                            <div class="col-1 col-md-auto mb-2">
                                                <button data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-primary btn-square-social"
                                                    style="background-color: blue;" href="#!"
                                                    role="button">{{ $i }}</button>
                                            </div>
                                            @if ($i % 10 == 0)
                                                <div class="w-100 d-md-none"></div>
                                                <!-- Baris baru setiap 10 tombol pada layar kecil -->
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="row gy-3 gy-md-4">
                        <div class="col-12">
                            <div class="card widget-card border-light shadow-sm">
                                <div class="card-header bg-transparent p-4 border-light-subtle">
                                    <h5 class="card-title widget-card-title m-0">Nomor 01</h5>
                                    <p class="card-body widget-card-body">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                        Quas dicta perspiciatis architecto maxime assumenda amet animi, recusandae harum
                                        eum, rem asperiores suscipit placeat nostrum, vel similique numquam vitae
                                        nesciunt fugit?
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque, natus. Ipsum
                                        commodi fuga maiores, odit, suscipit, facere consequatur debitis minima itaque
                                        ad soluta natus veritatis at facilis illum quasi fugiat.
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Quisquam, quos.
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Quisquam, quos.
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum sequi fugiat
                                        perspiciatis praesentium minus dolor ipsum laborum rem sit delectus velit vitae,
                                        veniam ullam dignissimos nobis est qui, omnis iure.
                                    </p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option1" name="option">
                                        <label class="form-check-label" for="option1">
                                            Pilihan Jawaban 1
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option2" name="option">
                                        <label class="form-check-label" for="option2">
                                            Pilihan Jawaban 2
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option3" name="option">
                                        <label class="form-check-label" for="option3">
                                            Pilihan Jawaban 3
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option4" name="option">
                                        <label class="form-check-label" for="option4">
                                            Pilihan Jawaban 4
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="option5" name="option">
                                        <label class="form-check-label" for="option5">
                                            Pilihan Jawaban 5
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        // Mendapatkan semua elemen checkbox
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Menambahkan event listener untuk setiap checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Jika checkbox ini dicentang
                if (this.checked) {
                    // Uncheck semua checkbox kecuali checkbox ini
                    checkboxes.forEach(cb => {
                        if (cb !== this) {
                            cb.checked = false;
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
