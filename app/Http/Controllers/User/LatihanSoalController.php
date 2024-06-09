<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriLatihanSoal;
use App\Models\LatihanSoal;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;

class LatihanSoalController extends Controller
{
    public function index()
    {
        $kategoriLatihanSoals = KategoriLatihanSoal::get();
        $kategoris = Kategori::get();

        return view('user.latihan-soal.detail-menu', compact('kategoriLatihanSoals', 'kategoris'));
    }

    private function fisherYatesShuffle($array)
    {
        // Menghitung panjang array
        $count = count($array);

        // Iterasi mundur untuk pengacakan
        for ($i = $count - 1; $i > 0; $i--) {
            // Memilih indeks acak
            $j = rand(0, $i);
             // Penukaran elemen jika indeks tidak sama
            if ($i != $j) {
                list($array[$i], $array[$j]) = array($array[$j], $array[$i]);
            }
        }
         // Mengembalikan array yang sudah teracak
        return $array;
    }

    public function detailKategori($id)
    {
        $soal = LatihanSoal::where('kategori_latihan_soal_id', $id)->get();

        $kategoriLatihanSoals = KategoriLatihanSoal::withCount(['LatihanSoal' => function ($query) use ($soal) {
            $query->whereIn('id', $soal->pluck('id'));
        }])->get();

        $soalIds = LatihanSoal::where('kategori_latihan_soal_id', $id)
            ->orderBy('kategori_id')
            ->pluck('id')
            ->toArray();

        $jumlahSoal = $soal->count();

        $jumlahSoalDiambil = min($jumlahSoal, 10);

        // Ambil 10 soal secara acak
        $shuffleSoal = $soal->random($jumlahSoalDiambil);

        // Ambil array ID dari 10 soal yang diacak
        $shuffledSoalIds = $shuffleSoal->pluck('id')->toArray();

        // Lakukan Fisher-Yates Shuffle pada array ID soal
        $shuffledSoalIds = $this->fisherYatesShuffle($shuffledSoalIds);

         // Simpan urutan soal yang telah diacak ke dalam session
        session(['shuffledSoalIds' => $shuffledSoalIds]);

        //Ambil elemen pertama dari shuffledSoalIds untuk digunakan di view
         $soalAcakId = $shuffledSoalIds[0];
         $soalAcak = LatihanSoal::find($soalAcakId);

        return view('user.latihan-soal.detail-kategori', ['kategoriLatihanSoals' => $kategoriLatihanSoals, 'soalIds' => $soalIds, 'shuffledSoalIds' => $shuffledSoalIds,   'soalAcak' => $soalAcak]);
    }

    public function mulaiLatihanSoal(Request $request, $kategoriLatihanSoalId, $soalId)
    {
        $soals = LatihanSoal::with('kategori')
            ->where('kategori_latihan_soal_id', $kategoriLatihanSoalId)
            ->orderBy('kategori_id')
            ->orderBy('id')
            ->get();

        $currentSoal = $soals->firstWhere('id', $soalId);

        if (!$currentSoal) {
            return redirect()->back()->with('error', 'Soal tidak ditemukan.');
        }

        $shuffleSoal = $soals->random(10);
        $shuffledSoalIds = $shuffleSoal->pluck('id')->toArray();

           // Cek apakah session untuk urutan soal sudah ada atau belum
           if (!Session::has('shuffledSoalIds')) {
            $shuffledSoalIds = $this->fisherYatesShuffle($shuffledSoalIds);

            Session::put('shuffledSoalIds', $shuffledSoalIds);
        } else {
            // Jika sudah ada, gunakan urutan soal yang telah disimpan di session
            $shuffledSoalIds = Session::get('shuffledSoalIds');
        }

         // Mendapatkan indeks soal yang sedang dikerjakan
         $currentSoalIndex = array_search($soalId, $shuffledSoalIds);

         // Mendapatkan soal sebelumnya dan berikutnya
         $previousSoal = null;
         $nextSoal = null;
         if ($currentSoalIndex !== false) {
             $previousSoalIndex = $currentSoalIndex - 1;
             $nextSoalIndex = $currentSoalIndex + 1;

             if (isset($shuffledSoalIds[$previousSoalIndex])) {
                 $previousSoal = $soals->firstWhere('id', $shuffledSoalIds[$previousSoalIndex]);
             }

             if (isset($shuffledSoalIds[$nextSoalIndex])) {
                 $nextSoal = $soals->firstWhere('id', $shuffledSoalIds[$nextSoalIndex]);
             }
         }

         // Tentukan apakah soal yang sedang dikerjakan adalah yang terakhir dalam urutan soal
         $lastSoal = $currentSoalIndex === (count($shuffledSoalIds) - 1);

         $currentSoal->ragu_ragu = $request->session()->get('ragu_ragu_' . $currentSoal->id, false);

        //  dd(session()->all());

        return view('user.latihan-soal.soal', [
            'soals' => $soals,
            'jumlahSoals' => $soals->count(),
            'currentSoal' => $currentSoal,
            'previousSoal' => $previousSoal,
            'nextSoal' => $nextSoal,
            'currentSoalIndex' => $currentSoalIndex,
            'lastSoal' => $lastSoal,
            'shuffledSoalIds' => $shuffledSoalIds,
        ]);
    }
    public function hasilAkhir() {
        return view('user.latihan-soal.hasil');
    }
}
