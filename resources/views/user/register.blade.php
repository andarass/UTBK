<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-aplikasi.png') }}" type="image/png">
    <title>Register | KITAPTN</title>
</head>

<body>
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div>
                    {{-- <img src="https://storage.googleapis.com/devitary-image-host.appspot.com/15846435184459982716-LogoMakr_7POjrN.png"
                        class="w-32 mx-auto" /> --}}
                    <img src="{{ asset('assets/images/logo-aplikasi.png') }}" alt="logo" class="w-32 mx-auto" />
                </div>
                <div class="mt-8 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold">
                        Register
                    </h1>
                    <div class="w-full flex-1 mt-8">
                        <div class="flex flex-col items-center">

                        </div>

                        {{-- <div class="my-12 border-b text-center">
                            <div
                                class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2">
                                Or log in with e-mail
                            </div>
                        </div> --}}

                        <div class="mx-auto max-w-xs">
                            <form action="{{ route('user.register.store') }}" method="POST">
                                @csrf
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                    type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Nama Lengkap" />
                                @error('name')
                                    <div class="invalid-feedback text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="text" name="username" value="{{ old('username') }}"
                                    placeholder="Username" />
                                @error('username')
                                    <div class="invalid-feedback text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <select
                                    class="form-select custom-placeholder w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    name="universitas" id="universitas" data-control="select2" required
                                    data-placeholder="Pilih Universitas">
                                    <option value="" hidden>Pilih Universitas</option>
                                    @foreach ($universitas as $university)
                                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                                    @endforeach
                                </select>
                                <select
                                    class="form-select custom-placeholder w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    name="prodi" id="prodi" data-control="select2" data-placeholder="Pilih Prodi"
                                    required>
                                    <option value="" hidden>Pilih Prodi</option>
                                </select>
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                                @error('email')
                                    <div class="invalid-feedback text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="password" name="password" value="{{ old('password') }}"
                                    placeholder="Password" />
                                @error('password')
                                    <div class="invalid-feedback text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <button type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                    <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                        <circle cx="8.5" cy="7" r="4" />
                                        <path d="M20 8v6M23 11h-6" />
                                    </svg>
                                    <span class="ml-3">
                                        Register
                                    </span>
                                </button>
                            </form>
                        </div>
                        <div class="mt-5 text-sm text-center">
                            have an account?
                            <a href="{{ route('user.login') }}"
                                class="font-medium text-indigo-500 hover:text-indigo-600">
                                Login here
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 bg-blue-100 text-center hidden lg:flex">
                <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
                    style="background-image: url('assets/images/user/logo-register.svg');">
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil data prodi dari server side dan simpan di JavaScript
            var prodis = @json($prodis);

            // Event listener untuk select universitas
            document.getElementById('universitas').addEventListener('change', function () {
                var universitasId = this.value;
                var prodiSelect = document.getElementById('prodi');

                // Clear existing options
                prodiSelect.innerHTML = '<option value="" hidden>Pilih Prodi</option>';

                // Filter dan tambahkan prodi yang sesuai dengan universitas yang dipilih
                prodis.filter(function (prodi) {
                    return prodi.universitas_id == universitasId;
                }).forEach(function (prodi) {
                    var option = document.createElement('option');
                    option.value = prodi.id;
                    option.text = prodi.name;
                    prodiSelect.appendChild(option);
                });
            });
        });
    </script> --}}

    <script>
        document.getElementById('universitas').addEventListener('change', function() {
            var universityId = this.value;
            var prodiSelect = document.getElementById('prodi');
            prodiSelect.innerHTML = '<option value="" hidden>Pilih Prodi</option>'; // Reset Prodi options

            @foreach ($prodis as $prodi)
                if ({{ $prodi->universitas_id }} == universityId) {
                    var option = document.createElement('option');
                    option.value = {{ $prodi->id }};
                    option.text = '{{ $prodi->name }}';
                    prodiSelect.appendChild(option);
                }
            @endforeach
        });
    </script>
</body>

</html>
