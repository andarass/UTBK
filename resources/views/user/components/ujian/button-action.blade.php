<div class="d-flex justify-content-between">
    @if ($previousSoal && $previousSoal->kategori_id === $currentSoal->kategori_id)
        <a href="{{ route('user.soal-ujian', ['paketSoalId' => $currentSoal->paket_soal_id, 'soalId' => $previousSoal->id]) }}"
            class="btn btn-primary">Soal Sebelumnya</a>
    @endif

    <button onclick="tandaiRaguRagu()" class="btn btn-warning">
        <input type="checkbox" id="ragu-ragu-checklist">
        {{ $currentSoal->ragu_ragu ? 'checked' : '' }}
        <label for="ragu-ragu-checklist">Ragu-Ragu</label>
    </button>

    @if ($nextSoal)
        @php
            $nextQuestionUrl = route('user.soal-ujian', [
                'paketSoalId' => $currentSoal->paket_soal_id,
                'soalId' => $nextSoal->id,
            ]);
            $currentCategory = $currentSoal->kategori->id;
            $nextCategory = $nextSoal->kategori->id;
        @endphp

        <a href="{{ $nextQuestionUrl }}"
            onclick="return checkCategory('{{ $currentCategory }}', '{{ $nextCategory }}', '{{ $nextQuestionUrl }}')"
            class="btn btn-primary">
            @if ($lastSoal)
                Pindah Sesi
            @else
                Soal Selanjutnya
            @endif
        </a>
    @elseif ($nextSoal === null)
    <button onclick="konfirmasiAkhiriUjian()" class="btn btn-primary">Akhiri Ujian</button>
    @endif
</div>
