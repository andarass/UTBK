<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Hasil Akhir Ujian | KITAPTN</title>
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
        <div class="col-8">
            <div class="card widget-card border-light shadow">
                <div class="card-header bg-transparent p-4 border-light-subtle">
                    <h5 class="card-title widget-card-title m-0 text-center">Review Hasil</h5>
                </div>
                <div class="card-body p-4">
                    <div class="col-md-12">
                        <table id="resultTable" class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jawaban Kamu</th>
                                    <th scope="col">Kategori Soal</th>
                                    <th scope="col">Point Soal</th>
                                </tr>
                            </thead>
                            <tbody id="resultTableBody">
                                {{-- User's answers will be populated here dynamically --}}
                            </tbody>
                        </table>
                        <div id="statusLulus" class="text-center mt-4"></div>
                        @if (auth()->user()->prodis_id)
                            <a href="{{ route('prodi.kriteriaKelulusan', auth()->user()->prodis_id) }}"
                                class="btn btn-info mt-4">Lihat Kriteria Kelulusan</a>
                        @endif
                        <button onclick="logoutAndRedirect()" class="btn btn-danger mt-4">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center gy-3 gy-md-4 mt-4">
        <div class="col-8">
            <div class="card widget-card border-light shadow">
                <div class="card-header bg-transparent p-4 border-light-subtle">
                    <h5 class="card-title widget-card-title m-0 text-center">Form Testimoni</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('user.testimoni.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama</label>
                            <select class="form-select custom-placeholder" name="user_id" data-control="select2"
                                data-placeholder="Pilih User">
                                <option disabled selected>Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Pesan</label>
                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.toastr')
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        // Ambil data dari sesi Laravel
        const soalByCategory = {!! json_encode(session('soalByCategory')) !!};

        function displayUserAnswers() {
            const resultTableBody = document.getElementById('resultTableBody');
            let totalPoints = 0;
            let questionNumber = 1;

            // Iterasi setiap kategori dan tampilkan jawaban sesuai urutan soalByCategory
            Object.keys(soalByCategory).forEach(kategoriId => {
                const category = soalByCategory[kategoriId];
                const kategoriName = category[0].kategori.name; // Ambil nama kategori dari data sesi Laravel
                category.forEach(soal => {
                    const sessionStorageKey = `jawabanSoal_${soal.id}`;
                    const jawaban = JSON.parse(sessionStorage.getItem(sessionStorageKey));
                    const points = jawaban.opsiDipilih === jawaban.correctAnswer ? parseInt(jawaban
                        .points) : 0;

                    // Tambahkan poin ke total
                    totalPoints += points;

                    // Tampilkan jawaban dalam tabel
                    const resultRow = `
                        <tr>
                            <td>${questionNumber}</td>
                            <td>${jawaban.opsiDipilih}</td>
                            <td>${kategoriName}</td>
                            <td>${points}</td>
                        </tr>
                    `;
                    resultTableBody.innerHTML += resultRow;
                    questionNumber++;
                });
            });

            // Tampilkan total poin
            const totalRow = `
                <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td><b>${totalPoints}/1000</b></td>
                </tr>
            `;
            resultTableBody.innerHTML += totalRow;

            // Tentukan status lulus atau tidak
            const minimalPoints = {{ $prodi ? $prodi->nilai_minimal : 500 }};
            const statusLulus = document.getElementById('statusLulus');
            if (totalPoints >= minimalPoints) {
                statusLulus.innerHTML = '<h4 class="text-success">Lulus</h4>';
            } else {
                statusLulus.innerHTML = '<h4 class="text-danger">Tidak Lulus</h4>';
            }
        }

        document.addEventListener('DOMContentLoaded', displayUserAnswers);
    </script>

    <script>
        function logoutAndRedirect() {
            Swal.fire({
                title: 'Apakah anda ingin kembali ke menu ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Clear sessionStorage
                    sessionStorage.clear();

                    // Redirect to logout route
                    window.location.href = '/menu';
                }
            });
        }
    </script>
</body>

</html>
