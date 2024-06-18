<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Skor Akhir Latihan Soal | KITAPTN</title>
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
        <div class="col-8">
            <div class="card widget-card border-light shadow">
                <div class="card-header p-4 border-light-subtle" style="background-color:#0C3080;">
                    <h5 class="card-title widget-card-title m-0 text-center text-white">Review Hasil</h5>
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
                        <button onclick="logoutAndRedirect()" class="btn btn-danger mt-4">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <script>
        function displayUserAnswers() {
            const resultTableBody = document.getElementById('resultTableBody');
            const sessionStorageKeys = Object.keys(sessionStorage).filter(key => key.includes('jawabanSoal_'));

            let questionNumber = 1;
            let totalPoints = 0;

            sessionStorageKeys.forEach(key => {
                const jawaban = JSON.parse(sessionStorage.getItem(key));

                // Determine points based on whether opsiDipilih is correct
                const points = jawaban.opsiDipilih === jawaban.correctAnswer ? parseInt(jawaban.points) : 0;

                // Construct table row for each question
                const resultRow = `
                    <tr>
                        <td>${questionNumber}</td>
                        <td>${jawaban.opsiDipilih}</td>
                        <td>${jawaban.kategori}</td>
                        <td>${points}</td>
                    </tr>
                `;
                resultTableBody.innerHTML += resultRow;

                // Increment total points
                totalPoints += points;

                questionNumber++;
            });

            // Display the total points
            const totalRow = `
                <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td><b>${totalPoints}/100</b></td>
                </tr>
            `;
            resultTableBody.innerHTML += totalRow;

              // Tentukan status lulus atau tidak
              const minimalPoints = 80;
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
