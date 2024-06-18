<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <style>
        .answered {
            background-color: green ;
            color: white;
        }
    </style>
    <title>Soal | KITAPTN</title>
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
                        @if ($currentSoal && $currentSoal->kategori)
                        <div class="col-12 text-center">
                            <p class="fs-4 fw-medium"> {{ $currentSoal->KategoriLatihanSoal->name }}</p>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <span id="waktu" class="fs-4 fw-bold text-center"><span id="jam">01</span>:<span
                        id="menit">00</span>:<span id="detik">00</span></span>
            </div>
        </header>
    </div>

    <section class="pb-3 pb-md-4 pb-xl-5">
        <div class="container">
            <div class="row gy-3 gy-md-4">
                <div class="col-12 col-lg-5">
                    <div class="row gy-3 gy-md-4">
                        <div class="col-12">
                            <div class="card widget-card border-light shadow">
                                @include('user.components.latihan-soal.profile')
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card widget-card border-light shadow">
                                <div class="card-header bg-transparent p-4 border-light-subtle">
                                    <h5 class="card-title widget-card-title m-0">Daftar Soal</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        @include('user.components.latihan-soal.daftar-soal')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="row gy-3 gy-md-4">
                        <div class="col-12">
                            <div class="card widget-card border-light shadow">
                                <div class="card-header bg-transparent p-4 border-light-subtle">
                                    <h5 class="card-title widget-card-title m-0">Nomor {{ $currentSoalIndex + 1 }}</h5>
                                    @include('user.components.latihan-soal.soal')
                                    @include('user.components.latihan-soal.jawaban')
                                </div>
                                <div class="card-footer bg-transparent border-light-subtle">
                                    @include('user.components.latihan-soal.button-action')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    {{-- Menyimpan Waktu Start --}}
    <script>
        let waktuAwal = sessionStorage.getItem("waktuAwal");
        let notifikasi30Menit = false;

        if (!waktuAwal) {
            waktuAwal = new Date().getTime();
            sessionStorage.setItem("waktuAwal", waktuAwal);
        }

        let x = setInterval(() => {
            let now = new Date().getTime();
            let waktu = 3600000 - (now - waktuAwal);

            let hours = Math.floor((waktu % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((waktu % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((waktu % (1000 * 60)) / 1000);

            document.getElementById("jam").innerText = hours.toString().padStart(2, '0');
            document.getElementById("menit").innerText = minutes.toString().padStart(2, '0');
            document.getElementById("detik").innerText = seconds.toString().padStart(2, '0');

            // notifikasi 30 menit
            if (minutes === 30 && !notifikasi30Menit) {
                notifikasi30Menit = true
                Swal.fire({
                    title: "Perhatian!",
                    text: "Sisa waktu tinggal 30 menit",
                    icon: "info",
                    confirmButtonText: "OK"
                });
            }

            // waktu habis
            if (waktu <= 0) {
                clearInterval(x);
                document.getElementById("waktu").innerText = "Waktu Habis";

                Swal.fire({
                    title: "Waktu Habis!",
                    text: "You've passed the time limit.",
                    icon: "warning",
                    confirmButtonText: "OK"
                }).then((result) => {
                    // Redirect halaman result jika menekan ok
                    if (result.isConfirmed || result.isDismissed) {
                        window.location.href = "{{ route('user.hasil-akhir-latihan-soal') }}";
                    }
                });
            }
        }, 1000);
    </script>
    {{-- Menyimpan Waktu End --}}

    <script>
        function pilihOpsi(opsi) {
            const idPertanyaanSaatIni = '{{ $currentSoal->id }}';
            const jawaban = {
                idPertanyaan: idPertanyaanSaatIni,
                opsiDipilih: opsi,
                kategori: '{{ $currentSoal->kategori->name }}',
                correctAnswer: '{{ $currentSoal->kunci_jawaban }}',
                points: '{{ $currentSoal->point_soal }}',
                idKategori: '{{ $currentSoal->kategori_id }}',
            };
            sessionStorage.setItem('jawabanSoal_' + idPertanyaanSaatIni, JSON.stringify(jawaban));
            updateQuestionButtonColor(idPertanyaanSaatIni);
        }

        function ambilOpsiDipilih() {
            const idPertanyaanSaatIni = '{{ $currentSoal->id }}';
            const dataJawaban = sessionStorage.getItem('jawabanSoal_' + idPertanyaanSaatIni);

            if (dataJawaban) {
                const jawaban = JSON.parse(dataJawaban);
                if (jawaban.idPertanyaan === idPertanyaanSaatIni) {
                    const selectedOption = jawaban.opsiDipilih;

                    const availableOptions = document.querySelectorAll('.form-check-input');
                    availableOptions.forEach(option => {
                        if (option.value === selectedOption) {
                            option.checked = true;
                        } else {
                            option.checked = false;
                        }
                    });
                }
            }
        }

        function updateQuestionButtonColor(idPertanyaan) {
            const button = document.getElementById('questionButton_' + idPertanyaan);
            const dataJawaban = sessionStorage.getItem('jawabanSoal_' + idPertanyaan);

            if (dataJawaban) {
                button.classList.add('answered');
            } else {
                button.classList.remove('answered');
            }
        }

        function updateAllQuestionButtonsColor() {
            document.querySelectorAll('[id^="questionButton_"]').forEach(button => {
                const idPertanyaan = button.id.replace('questionButton_', '');
                updateQuestionButtonColor(idPertanyaan);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            ambilOpsiDipilih();
            updateAllQuestionButtonsColor();
        });

        document.addEventListener('click', function(event) {
            if (event.target.matches('.form-check-input')) {
                const opsiDipilih = event.target.value;
                pilihOpsi(opsiDipilih);
            }
        });
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

    <script>
        function redirectToQuestion(soalId) {

            const raguRagu = sessionStorage.getItem('ragu_ragu_' + soalId); // Periksa status ragu-ragu

            // Perbarui warna tombol berdasarkan status ragu-ragu
            const buttonElement = document.getElementById('questionButton_' + soalId);
            if (raguRagu) {
                buttonElement.classList.add('btn-warning'); // Tambahkan warna kuning jika ragu-ragu
            } else {
                buttonElement.classList.remove('btn-warning'); // Hapus warna kuning jika tidak ragu-ragu
            }

            const url = '/latihan-soal/{{ $currentSoal->kategori_latihan_soal_id }}/' + soalId;
            window.location.href = url;
        }

        // Fungsi untuk memperbarui warna tombol ketika halaman dimuat
        function updateButtonColorOnLoad() {
            const buttons = document.querySelectorAll('.btn-square-social');
            buttons.forEach(function(button) {
                const soalId = button.id.replace('questionButton_', '');
                const raguRagu = sessionStorage.getItem('ragu_ragu_' + soalId);
                if (raguRagu) {
                    button.classList.add('btn-warning'); // Tambahkan warna kuning jika ragu-ragu
                }
            });
        }

        // Panggil fungsi untuk memperbarui warna tombol saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            updateButtonColorOnLoad();
        });
    </script>

    <script>
        function konfirmasiAkhiriUjian() {
            Swal.fire({
                title: "Apakah anda yakin ingin mengakhiri latihan soal ini ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Latihan Soal Selesai!",
                        icon: "success",
                    }).then(() => {
                        window.location.href = "{{ route('user.hasil-akhir-latihan-soal') }}";
                    });
                }
            });
        }
    </script>

<script>
    // Fungsi untuk menandai atau menghapus tanda ragu-ragu
    function tandaiRaguRagu() {
        const checkbox = document.getElementById('ragu-ragu-checklist');
        const checked = checkbox.checked;
        const currentSoalId = '{{ $currentSoal->id }}';

        if (checked) {
            // Tandai ragu-ragu
            sessionStorage.setItem('ragu_ragu_' + currentSoalId, true);
            // Perbarui warna tombol pada modal
            perbaruiWarnaTombol(currentSoalId, true);
        } else {
            // Hapus tanda ragu-ragu
            sessionStorage.removeItem('ragu_ragu_' + currentSoalId);
            // Perbarui warna tombol pada modal
            perbaruiWarnaTombol(currentSoalId, false);
        }
    }

    // Fungsi untuk memperbarui warna latar belakang tombol pada modal
    function perbaruiWarnaTombol(soalId, raguRagu) {
        // Periksa apakah tombol ada pada modal
        const buttonElement = document.getElementById('questionButton_' + soalId);
        if (buttonElement) {
            // Perbarui warna tombol
            if (raguRagu) {
                buttonElement.classList.add('btn-warning');
            } else {
                buttonElement.classList.remove('btn-warning');
            }
        }
    }

    // Inisialisasi status checklist saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('ragu-ragu-checklist');
        const currentSoalId = '{{ $currentSoal->id }}';
        const raguRagu = sessionStorage.getItem('ragu_ragu_' + currentSoalId);

        if (raguRagu) {
            checkbox.checked = true;
            // Perbarui warna tombol pada modal jika raguRagu dicentang saat halaman dimuat
            perbaruiWarnaTombol(currentSoalId, true);
        } else {
            checkbox.checked = false;
        }

        // Memperbarui warna tombol pada modal ketika pengguna pindah ke soal selanjutnya
        const buttons = document.querySelectorAll('.bg-primary');
        buttons.forEach(function(button) {
            const soalId = button.id.replace('questionButton_', '');
            const raguRagu = sessionStorage.getItem('ragu_ragu_' + soalId);
            if (raguRagu) {
                button.classList.add('btn-warning');
            }
        });
    });
</script>
</body>
</html>
