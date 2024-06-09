<div class="card-header bg-transparent p-4 border-light-subtle d-flex flex-column align-items-center">
    @if (auth()->user()->profile_photo_path)
        <img class="object-fit-cover rounded-circle mt-5" width="200" height="200" alt="User Profile" src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" />
    @else
        <img class="object-fit-cover rounded-circle mt-5" width="200" height="200" src="{{ asset('assets/images/user.png') }}"
            alt="User Profile">
    @endif
    <h5 class="card-title widget-card-title mb-3 mt-4">{{ Auth::user()->name }}</h5>
    <p class="fw-medium">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
</div>
