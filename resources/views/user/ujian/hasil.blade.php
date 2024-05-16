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
                        <button onclick="logoutAndRedirect()"
                            class="btn btn-danger mt-4">
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

            // Object to store answers based on category
            const answersByCategory = {};

            sessionStorageKeys.forEach(key => {
                const jawaban = JSON.parse(sessionStorage.getItem(key));

                // Determine points based on whether opsiDipilih is correct
                const points = jawaban.opsiDipilih === jawaban.correctAnswer ? parseInt(jawaban.points) : 0;

                // Store answers based on category
                if (!answersByCategory[jawaban.kategori]) {
                    answersByCategory[jawaban.kategori] = [];
                }
                answersByCategory[jawaban.kategori].push({
                    questionNumber: questionNumber,
                    opsiDipilih: jawaban.opsiDipilih,
                    points: points
                });

                // Increment total points
                totalPoints += points;

                questionNumber++;
            });

            // Iterate over categories and display answers
            Object.keys(answersByCategory).forEach(kategori => {
                const categoryAnswers = answersByCategory[kategori];
                // Sort answers by question number within the category
                categoryAnswers.sort((a, b) => a.questionNumber - b.questionNumber);
                categoryAnswers.forEach(answer => {
                    const resultRow = `
                        <tr>
                            <td>${answer.questionNumber}</td>
                            <td>${answer.opsiDipilih}</td>
                            <td>${kategori}</td>
                            <td>${answer.points}</td>
                        </tr>
                    `;
                    resultTableBody.innerHTML += resultRow;
                });
            });

            // Display the total points
            const totalRow = `
                <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td><b>${totalPoints}</b></td>
                </tr>
            `;
            resultTableBody.innerHTML += totalRow;
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
                confirmButtonText: 'Yes, Logout',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Clear sessionStorage
                    sessionStorage.clear();

                    // Redirect to logout route
                    window.location.href = '/';
                }
            });
        }
    </script>
    {{-- @endpush --}}
</body>

</html>
