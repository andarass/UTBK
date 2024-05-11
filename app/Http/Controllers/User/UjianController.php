<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketSoalUjian;
use App\Models\Kategori;
use App\Models\SoalUjian;

class UjianController extends Controller
{
    public function index() {
        $paketSoalUjians = PaketSoalUjian::all();

        return view('user.ujian.detail-menu', compact('paketSoalUjians'));
    }

    public function detailPaketSoal($id) {
        $paketSoal = PaketSoalUjian::find($id);

        // $soal = $paketSoal->SoalUjian;

         $soal = SoalUjian::where('paket_soal_id', $id)->get();

        $firstSoalId = SoalUjian::where('paket_soal_id', $id)
        ->orderBy('kategori_id')
        ->orderBy('id')
        ->value('id');

        $kategoris = Kategori::withCount(['SoalUjian' => function ($query) use ($soal) {
            $query->whereIn('id', $soal->pluck('id'));
        }])->get();

        return view('user.ujian.detail-paket-soal', compact('paketSoal', 'firstSoalId', 'kategoris'));
    }

    public function mulaiUjian($paketSoalId, $soalId) {
        $soals = SoalUjian::with('kategori')
        ->where('paket_soal_id', $paketSoalId)
        ->orderBy('kategori_id')
        ->orderBy('id')
        ->get();

        $currentSoal = $soals->firstWhere('id', $soalId);

        $currentSoalIndex = $soals->search(function ($soal) use ($currentSoal) {
            return $soal->id === optional($currentSoal)->id;
        });

        $previousSoal = null;
        $nextSoal = null;

        if ($currentSoalIndex !== false) {
            $isFirstQuestion = $currentSoalIndex === 0;
            $isLastQuestion = $currentSoalIndex === $soals->count() - 1;


            if (!$isFirstQuestion) {
                $previousSoal = $soals->get($currentSoalIndex - 1);
            }

            if (!$isLastQuestion) {
                $previousSoal = $soals->get($currentSoalIndex - 1);
                $nextSoal = $soals->get($currentSoalIndex + 1);
            }
        }

        $currentCategory = $currentSoal->kategori_id;
        $lastSoalCategory = $soals->where('kategori_id', $currentCategory);
        $lastSoal = $lastSoalCategory->last() && $currentSoal->id === $lastSoalCategory->last()->id;


        return view('user.ujian.soal', compact('soals', 'currentSoalIndex', 'currentSoal', 'previousSoal', 'lastSoal', 'nextSoal'));
    }

    public function jawaban() {
        return view('user.ujian.hasil');
    }
}
