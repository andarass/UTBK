@if ($currentSoal->soal && $currentSoal->konten_bacaan_teks)
<p class="mt-2">
    {!! nl2br(e($currentSoal->konten_bacaan_teks)) !!}
</p>
<p class="card-body widget-card-body mt-3">
    {!! nl2br(e($currentSoal->soal)) !!}
</p>
@elseif ($currentSoal->soal && $currentSoal->soal_gambar)
<img id="gambarSoal" class="mt-2"  src="{{ asset('storage/soal/' . $currentSoal->soal_gambar) }}" alt="image" height="50%" width="50%">
<p class="card-body widget-card-body mt-3">
    {!! nl2br(e($currentSoal->soal)) !!}
</p>
@else
<p class="card-body widget-card-body">
    {!! nl2br(e($currentSoal->soal)) !!}
</p>
@endif
