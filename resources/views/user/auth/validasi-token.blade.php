<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Lupa Password | KITAPTN</title>
</head>

<body>
    <section class="py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="mb-5">
                        <h4 class="text-center mb-4">Password Reset</h4>
                    </div>
                    <div class="card border border-light-subtle rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <form action="{{ route('validasi-forgot-password-act') }}" method="POST">
                                @csrf
                                <p class="text-center mb-4">Masukan Password Baru Kamu</p>
                                <div class="row gy-3 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="hidden" name="token" value="{{ $token }}" />
                                            <input type="password" class="form-control" name="password" id="email"
                                                placeholder="Masukan password baru" required>
                                            <label for="password" class="form-label">Password</label>
                                        </div>
                                        @error('password')
                                        <div class="w-100 text-center">
                                            <small class="text-danger">{{$message}}</small>
                                        </div>
                                      @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg" type="submit">Reset
                                                Password</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "{{ session('success') }}";

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Password Berhasil direset!',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
</script>
</body>
</html>
