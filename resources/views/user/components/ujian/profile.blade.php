<div class="card-header bg-transparent p-4 border-light-subtle d-flex flex-column align-items-center">
    <img class="rounded-circle mt-5" width="200" height="200" src="{{ asset('assets/images/user/logo-user.png') }}"
        alt="logo-user">
    <h5 class="card-title widget-card-title mb-3 mt-4">{{ Auth::user()->name }}</h5>
    <p class="fw-medium">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
</div>
