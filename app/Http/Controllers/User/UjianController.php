<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketSoalUjian;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;
use App\Models\SoalUjian;
use App\Models\Prodi;

class UjianController extends Controller
{
    public function index()
    {
        $paketSoalUjians = PaketSoalUjian::all();

        return view('user.ujian.detail-menu', compact('paketSoalUjians'));
    }

    public function detailPaketSoal($id)
    {
        $paketSoal = PaketSoalUjian::find($id);

        // $soal = $paketSoal->SoalUjian;

        $soal = SoalUjian::where('paket_soal_id', $id)->get();

        // Mengelompokkan soal berdasarkan kategori
        $soalByCategory = $soal->groupBy('kategori_id');

         // Mengacak urutan soal di setiap kategori
         $soalByCategory->transform(function ($category) {
            return $category->shuffle();
        });

         // Menyimpan urutan soal yang sudah diacak ke dalam sesi Laravel
         Session::put('soalByCategory', $soalByCategory);

        $firstSoalId = SoalUjian::where('paket_soal_id', $id)
            ->orderBy('kategori_id')
            ->orderBy('id')
            ->value('id');

        $kategoris = Kategori::withCount(['SoalUjian' => function ($query) use ($soal) {
            $query->whereIn('id', $soal->pluck('id'));
        }])->get();

        return view('user.ujian.detail-paket-soal', compact('paketSoal', 'firstSoalId', 'kategoris', 'soalByCategory'));
    }

    public function mulaiUjian(Request $request, $paketSoalId, $soalId)
    {
        $soals = SoalUjian::with('kategori')
            ->where('paket_soal_id', $paketSoalId)
            ->orderBy('kategori_id')
            ->orderBy('id')
            ->get();

        // Mengambil urutan soal yang sudah diacak dari sesi Laravel
        $soalByCategory = Session::get('soalByCategory');

        // Menggabungkan semua soal dari setiap kategori menjadi satu koleksi soal
        $soals = collect();
        foreach ($soalByCategory as $category) {
            $soals = $soals->concat($category);
        }

        // Mengambil soal yang sedang ditampilkan
        $currentSoal = $soals->firstWhere('id', $soalId);

        // Menemukan index soal yang sedang ditampilkan dalam koleksi soal
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

        //  dd(session()->all());

        $currentSoal->ragu_ragu = $request->session()->get('ragu_ragu_' . $currentSoal->id, false);

        return view('user.ujian.soal', compact('soals', 'currentSoalIndex', 'currentSoal', 'previousSoal', 'lastSoal', 'nextSoal'));
    }

    public function jawaban()
    {
        $prodi = Prodi::find(auth()->user()->prodis_id);

        return view('user.ujian.hasil', compact('prodi'));
    }

    public function kriteriaKelulusan($prodiId)
    {
        $prodi = Prodi::findOrFail($prodiId);
        return view('user.ujian.kriteria-kelulusan', compact('prodi'));
    }
}
