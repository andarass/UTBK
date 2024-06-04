<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('dashboard') }}">
            <img alt="Logo"
                src="{{ isset($setting->logo_default) ? asset('storage/' . $setting->logo_default) : asset('assets/images/logo-aplikasi.png') }}"
                class="h-20 ms-20 app-sidebar-logo-default" />
            <img alt="Logo"
                src="{{ isset($setting->logo_square) ? asset('storage/' . $setting->logo_square) : asset('assets/images/logo-aplikasi.png') }}"
                class="h-60px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                @hasanyrole('Super Admin')
                    <div class="menu-item">
                        <a class="menu-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ Route::is('User*') ? 'active' : '' }}" href="{{ route('User.index') }}">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                </svg>
                            </span>
                            <span class="menu-title">User Management</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ Route::is('ReviewAplikasi*') ? 'active' : '' }}"
                            href="{{ route('ReviewAplikasi.index') }}">
                            <span class="menu-icon">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <span class="menu-title">Review Aplikasi</span>
                        </a>
                    </div>
                    {{-- <div class="menu-item">
                    <a class="menu-link {{ Route::is('Universitas*') ? 'active' : '' }}"
                        href="{{ route('Universitas.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-mortarboard"></i>
                        </span>
                        <span class="menu-title">Universitas</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ Route::is('Prodi*') ? 'active' : '' }}"
                        href="{{ route('Prodi.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-mortarboard"></i>
                        </span>
                        <span class="menu-title">Prodi</span>
                    </a>
                </div> --}}
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is(['Universitas*', 'Prodi*']) ? 'show' : '' }}">
                        <span class="menu-link {{ request()->is(['Universitas*', 'Prodi*']) ? 'active' : '' }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                                        <path
                                            d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                                        <path fill-rule="evenodd"
                                            d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Perguruan Tinggi</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('Universitas*') ? 'active' : '' }}"
                                    href="{{ route('Universitas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Universitas</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('Prodi*') ? 'active' : '' }}"
                                    href="{{ route('Prodi.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Prodi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ Route::is('Kategori*') ? 'active' : '' }}"
                            href="{{ route('admin.kategori') }}">
                            <span class="menu-icon">
                                <i class="bi bi-clipboard2-plus"></i>
                            </span>
                            <span class="menu-title">Kategori Soal</span>
                        </a>
                    </div>
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is(['PaketUjianSoal*', 'SoalUjian*']) ? 'show' : '' }}">
                        <span class="menu-link {{ request()->is(['PaketUjianSoal*', 'SoalUjian*']) ? 'active' : '' }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                                        <path
                                            d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                                        <path fill-rule="evenodd"
                                            d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Ujian</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('PaketUjianSoal*') ? 'active' : '' }}"
                                    href="{{ route('PaketUjianSoal.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Paket Soal</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('SoalUjian*') ? 'active' : '' }}"
                                    href="{{ route('SoalUjian.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Soal Ujian</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ request()->is(['KTLatihanSoal*', 'LatihanSoal*']) ? 'show' : '' }}">
                        <span class="menu-link {{ request()->is(['KTLatihanSoal*', 'LatihanSoal*']) ? 'active' : '' }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                                        <path
                                            d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                                        <path fill-rule="evenodd"
                                            d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Latihan Soal</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">

                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('KTLatihanSoal*') ? 'active' : '' }}"
                                    href="{{ route('KTLatihanSoal.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Kategori</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link {{ Route::is('LatihanSoal*') ? 'active' : '' }}"
                                    href="{{ route('LatihanSoal.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Soal</span>
                                </a>
                            </div>

                            {{-- <div class="menu-item">
                            <a class="menu-link {{ Route::is('admin.reading-latihan-soal*') ? 'active' : '' }}"
                                href="{{ route('admin.reading-latihan-soal') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Reading Content</span>
                            </a>
                        </div> --}}
                        </div>
                    </div>
                @endhasanyrole

                @hasanyrole('User')
                    <div class="menu-item">
                        <a class="menu-link {{ Route::is('dashboard-user') ? 'active' : '' }}"
                            href="{{ route('dashboard.user') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ Route::is('ProfileUser*') ? 'active' : '' }}"
                            href="{{ route('ProfileUser.index') }}">
                            <span class="menu-icon">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <span class="menu-title">Data Pengguna</span>
                        </a>
                    </div>
                @endhasanyrole
                {{-- <div class="menu-item">
                    <a class="menu-link {{ Route::is('changePassword') ? 'active' : '' }}"
                        href="{{ route('changePassword') }}">
                        <span class="menu-icon">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512"><path d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V448h40c13.3 0 24-10.7 24-24V384h40c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/></svg>
                            </span>
                        </span>
                        <span class="menu-title">Change Password</span>
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        @if (Auth::user()->hasRole('Super Admin'))
            <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">
                @csrf
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click">
                    <span class="btn-label">Logout</span>
                    <span class="svg-icon btn-icon svg-icon-2 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M20 12h-9.5m7.5 3l3-3l-3-3m-5-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2v-1" />
                        </svg>
                    </span>
                </a>
            </form>
        @elseif (Auth::user()->hasRole('User'))
            <form action="{{ route('user.logout') }}" method="GET" id="logout-form">
                @csrf
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click">
                    <span class="btn-label">Logout</span>
                    <span class="svg-icon btn-icon svg-icon-2 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M20 12h-9.5m7.5 3l3-3l-3-3m-5-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2v-1" />
                        </svg>
                    </span>
                </a>
            </form>
        @endif

    </div>
</div>
