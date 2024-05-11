<div class="form-check">
    <input class="form-check-input" type="checkbox" value="A" id="option1" name="option"
    {{ old('answer') == 'a' || (isset($jawaban['opsiDipilih']) && $jawaban['opsiDipilih'] == 'A') ? 'checked' : '' }} >
    <label class="form-check-label" for="option1">
        @php
            $jawabanTeks = $currentSoal->jawaban_a;
            $jawabanGambar = $currentSoal->jawaban_a_gambar;
        @endphp
        @if ($jawabanTeks)
            {{ $jawabanTeks }}
        @elseif ($jawabanGambar)
            <img id="jawaban-a-gambar" src="{{ asset('storage/jawaban_a/' . $jawabanGambar) }}" width="10%"
                height="10%">
        @endif
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="B" id="option2" name="option"
        {{ old('answer') == 'b' || (isset($jawaban['opsiDipilih']) && $jawaban['opsiDipilih'] == 'B') ? 'checked' : '' }}>
    <label class="form-check-label" for="option2">
        @php
            $jawabanTeks = $currentSoal->jawaban_b;
            $jawabanGambar = $currentSoal->jawaban_b_gambar;
        @endphp
        @if ($jawabanTeks)
            {{ $jawabanTeks }}
        @elseif ($jawabanGambar)
            <img id="jawaban-b-gambar" src="{{ asset('storage/jawaban_b/' . $jawabanGambar) }}" width="10%"
                height="10%">
        @endif
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="C" id="option3" name="option"
        {{ old('answer') == 'c' || (isset($jawaban['opsiDipilih']) && $jawaban['opsiDipilih'] == 'C') ? 'checked' : '' }}>
    <label class="form-check-label" for="option3">
        @php
            $jawabanTeks = $currentSoal->jawaban_c;
            $jawabanGambar = $currentSoal->jawaban_c_gambar;
        @endphp
        @if ($jawabanTeks)
            {{ $jawabanTeks }}
        @elseif ($jawabanGambar)
            <img id="jawaban-c-gambar" src="{{ asset('storage/jawaban_c/' . $jawabanGambar) }}" width="10%"
                height="10%">
        @endif
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="D" id="option4" name="option"
        {{ old('answer') == 'd' || (isset($jawaban['opsiDipilih']) && $jawaban['opsiDipilih'] == 'D') ? 'checked' : '' }}>
    <label class="form-check-label" for="option4">
        @php
            $jawabanTeks = $currentSoal->jawaban_d;
            $jawabanGambar = $currentSoal->jawaban_d_gambar;
        @endphp
        @if ($jawabanTeks)
            {{ $jawabanTeks }}
        @elseif ($jawabanGambar)
            <img id="jawaban-d-gambar" src="{{ asset('storage/jawaban_d/' . $jawabanGambar) }}" width="10%"
                height="10%">
        @endif
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="E" id="option5" name="option"
        {{ old('answer') == 'e' || (isset($jawaban['opsiDipilih']) && $jawaban['opsiDipilih'] == 'E') ? 'checked' : '' }}>
    <label class="form-check-label" for="option5">
        @php
            $jawabanTeks = $currentSoal->jawaban_e;
            $jawabanGambar = $currentSoal->jawaban_e_gambar;
        @endphp
        @if ($jawabanTeks)
            {{ $jawabanTeks }}
        @elseif ($jawabanGambar)
            <img id="jawaban-e-gambar" src="{{ asset('storage/jawaban_e/' . $jawabanGambar) }}" width="10%"
                height="10%">
        @endif
    </label>
</div>
