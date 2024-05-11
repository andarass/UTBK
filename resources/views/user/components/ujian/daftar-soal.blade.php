<div class="col-1 col-md-auto mb-2">
    @foreach ($soals as $index => $soal)
        @php
            $SameCategory = $currentSoal->kategori->id === $soal->kategori->id;
        @endphp

        @if (!$SameCategory)
            @continue
        @endif

        <button onclick="redirectToQuestion({{ $soal->id }})" class="btn btn-primary btn-square-social"
             @if (!$SameCategory) disabled @endif
            id="questionButton_{{ $soal->id }}">{{ $index + 1 }}</button>
    @endforeach
</div>
