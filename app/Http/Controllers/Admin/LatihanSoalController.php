<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LatihanSoal;
use App\Models\PaketSoalLatihanSoal;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class LatihanSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jumlahPaketSoal = PaketSoalLatihanSoal::count();

        if ($request->ajax()) {
            $latihanSoal = LatihanSoal::get();
            return DataTables::of($latihanSoal)
                ->addIndexColumn()
                ->editColumn('soal', function ($item) {
                    if ($item->soal) {
                        return $item->soal;
                    } else {
                        return '-';
                    }
                })
                ->editColumn('soal_gambar', function ($item) {
                    if ($item->soal_gambar) {
                        $imagePath = "storage/soal/{$item->soal_gambar}";
                        $imageUrl = asset($imagePath);
                        return  '<img src="' . $imageUrl . '" width="50%" height="50%">';
                    } else {
                        return '-';
                    }
                })

                ->editColumn('soal_audio', function ($item) {
                    if ($item->soal_audio) {
                        $audioPath = "storage/soal/{$item->soal_audio}";
                        $audioUrl = asset($audioPath);
                        return '<audio controls><source src="' . $audioUrl . '" type="audio/mpeg"></audio>';
                    } else {
                        return '-';
                    }
                })
                ->addColumn('actions', function ($item) {
                    return
                        '<div class="dropdown text-end">
                    <button type="button" class="btn btn-secondary btn-sm btn-active-light-primary rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-bs-toggle="dropdown">
                        Actions
                        <span class="svg-icon svg-icon-3 rotate-180 ms-3 me-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                            </svg>
                        </span>
                    </button>
                    <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-100px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="' . route('LatihanSoal.show', $item->id) . '" class="menu-link px-3">
                                Soal Detail
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="' . route('LatihanSoal.edit', $item->id) . '" class="menu-link px-3">
                                Edit Soal
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('kategori', function ($item) {
                    return $item->Kategori->name ? $item->Kategori->name : "-";
                })
                ->editColumn('paket_soal', function ($item) {
                    return $item->PaketSoal->name ?? "-";
                })
                ->rawColumns(['actions', 'soal_gambar', 'soal_audio', 'soal'])
                ->make();
        }
        return view('admin.latihan-soal.index', compact('jumlahPaketSoal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paketSoals = PaketSoalLatihanSoal::select(['id', 'name'])->get();
        $kategoris = Kategori::select(['id', 'name'])->get();

        return view('admin.latihan-soal.create', compact('paketSoals', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $validate = [
            'soal_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'soal_audio' => 'nullable|audio|mimes:mpeg,mpga,mp3,wav,aac|max:5120',
            'jawaban_a_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jawaban_b_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jawaban_c_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jawaban_d_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jawaban_e_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kunci_jawaban' => 'required|string',
            'point_soal' => 'required|string',
            'paket_soal_id' => 'required',
            'kategori_id' => 'required',
            'konten_bacaan_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        //soal
        if ($request->has('soal')) {
            $validate['soal'] = 'string';
            $input = strip_tags($request->input('soal'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['soal'] = 'nullable|string';
            $data['soal'] = $input;
        } else {
            $data['soal'] = null;
        }

        //soal image
        if ($request->hasFile('soal_gambar')) {
            $imageQuestion = $request->file('soal_gambar');
            $originalImageQuestion = Str::random(10) . $imageQuestion->getClientOriginalName();
            $imageQuestion->storeAs('public/soal', $originalImageQuestion);
            $data['soal_gambar'] = $originalImageQuestion;
        } else {
            $data['soal_gambar'] = null;
        }

        //soal audio
        if ($request->hasFile('soal_audio')) {
            $audioQuestion = $request->file('soal_audio');
            $originalAudioQuestion = Str::random(10) . $audioQuestion->getClientOriginalName();
            $audioQuestion->storeAs('public/soal', $originalAudioQuestion);
            $data['soal_audio'] = $originalAudioQuestion;
        } else {
            $data['soal_audio'] = null;
        }

        //answer a
        if ($request->input('answer_a_type') === 'text') {
            $validate['jawaban_a'] = 'string';
            $data['jawaban_a'] = $request->input('jawaban_a');
            $data['jawaban_a_gambar'] = null;
        } elseif ($request->input('answer_a_type') === 'image') {
            $answerAImage = $request->file('jawaban_a_gambar');
            $originalAnswerAImage = Str::random(10) . $answerAImage->getClientOriginalName();
            $answerAImage->storeAs('public/jawaban_a', $originalAnswerAImage);
            $data['jawaban_a_gambar'] = $originalAnswerAImage;
            $data['jawaban_a'] = null;
        }

        //answer b
        if ($request->input('answer_b_type') === 'text') {
            $validate['answer_b'] = 'string';
            $data['answer_b'] = $request->input('answer_b');
            $data['jawaban_b_gambar'] = null;
        } else if ($request->input('answer_b_type') === 'image') {
            $answerBImage = $request->file('jawaban_b_gambar');
            $originalAnswerBImage = Str::random(10) . $answerBImage->getClientOriginalName();
            $answerBImage->storeAs('public/jawaban_b', $originalAnswerBImage);
            $data['jawaban_b_gambar'] = $originalAnswerBImage;
            $data['answer_b'] = null;
        }

        //answer c
        if ($request->input('answer_c_type') === 'text') {
            $validate['answer_c'] = 'string';
            $data['answer_c'] = $request->input('answer_c');
            $data['jawaban_c_gambar'] = null;
        } else if ($request->input('answer_c_type') === 'image') {
            // $answerCImage = $request->input('jawaban_c_gambar');
            $answerCImage = $request->file('jawaban_c_gambar');
            $originalAnswerCImage = Str::random(10) . $answerCImage->getClientOriginalName();
            $answerCImage->storeAs('public/jawaban_c', $originalAnswerCImage);
            $data['jawaban_c_gambar'] = $originalAnswerCImage;
            $data['answer_c'] = null;
        }

        //answer d
        if ($request->input('answer_d_type') === 'text') {
            $validate['answer_d'] = 'string';
            $data['answer_d'] = $request->input('answer_d');
            $data['jawaban_d_gambar'] = null;
        } else if ($request->input('answer_d_type') === 'image') {
            $answerDImage = $request->file('jawaban_d_gambar');
            $originalAnswerDImage = Str::random(10) . $answerDImage->getClientOriginalName();
            $answerDImage->storeAs('public/jawaban_d', $originalAnswerDImage);
            $data['jawaban_d_gambar'] = $originalAnswerDImage;
            $data['jawaban_d'] = null;
        }

         //answer e
         if ($request->input('answer_e_type') === 'text') {
            $validate['jawaban_e'] = 'string';
            $data['jawaban_e'] = $request->input('jawaban_e');
            $data['jawaban_e_gambar'] = null;
        } else if ($request->input('answer_e_type') === 'image') {
            $answerEImage = $request->file('jawaban_e_gambar');
            $originalAnswerEImage = Str::random(10) . $answerEImage->getClientOriginalName();
            $answerEImage->storeAs('public/jawaban_e', $originalAnswerEImage);
            $data['jawaban_e_gambar'] = $originalAnswerEImage;
            $data['jawaban_e'] = null;
        }

        $data['kunci_jawaban'] = $request->input('kunci_jawaban');

        //text content
        if ($request->has('konten_bacaan_teks')) {
            $validate['konten_bacaan_teks'] = 'string';
            $input = strip_tags($request->input('konten_bacaan_teks'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['konten_bacaan_teks'] = 'nullable|string';
            $data['konten_bacaan_teks'] = $input;
        } else {
            $data['konten_bacaan_teks'] = null;
        }

        //konten_bacaan_gambar
        if ($request->hasFile('konten_bacaan_gambar')) {
            $imageQuestion = $request->file('konten_bacaan_gambar');
            $originalImageQuestion = Str::random(10) . $imageQuestion->getClientOriginalName();
            $imageQuestion->storeAs('public/reading-latihan-soal', $originalImageQuestion);
            $data['konten_bacaan_gambar'] = $originalImageQuestion;
        } else {
            $data['konten_bacaan_gambar'] = null;
        }

        $request->validate($validate);

        LatihanSoal::create($data);

        return redirect()->route('LatihanSoal.index')->with('success', 'Berhasil Tambah Soal');
    }

    /**
     * Display the specified resource.
     */
    public function show(LatihanSoal $latihanSoal, $id)
    {
        $latihanSoal = LatihanSoal::find($id);

        return view('admin.latihan-soal.show', compact('latihanSoal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LatihanSoal $latihanSoal, $id)
    {
        $latihanSoal = LatihanSoal::find($id);

        $paketSoal = PaketSoalLatihanSoal::select(['id', 'name'])->get();

        $kategoriSoals = Kategori::select(['id', 'name'])->get();

        return view('admin.latihan-soal.edit', [
            'paketSoal' => $paketSoal,
            'kategoriSoals' => $kategoriSoals,
            'latihanSoal' => $latihanSoal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LatihanSoal $latihanSoal, $id)
    {
        $data = $request->except('_token');

        $validate = [
            'soal_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'soal_audio' => 'nullable|audio|mimes:mpeg,mpga,mp3,wav,aac|max:5120',
            'jawaban_a_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jawaban_b_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jawaban_c_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jawaban_d_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jawaban_e_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kunci_jawaban' => 'required|string',
            'point_soal' => 'required|string',
            'paket_soal_id' => 'required',
            'kategori_id' => 'required',
            'konten_bacaan_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $latihanSoal = LatihanSoal::find($id);

        if ($request->has('soal')) {
            $validate['soal'] = 'string';
            $input = strip_tags($request->input('soal'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['soal'] = 'nullable|string';
            $data['soal'] = $input;
        }

        //question image
        if ($request->hasFile('soal_gambar')) {
            $imageQuestion = $request->file('soal_gambar');
            $originalImageQuestion = Str::random(10) . $imageQuestion->getClientOriginalName();
            $imageQuestion->storeAs('public/soal', $originalImageQuestion);
            $data['soal_gambar'] = $originalImageQuestion;

            Storage::delete('public/soal/' . $latihanSoal->soal_gambar);
        }

        if ($request->hasFile('soal_audio')) {
            $audioQuestion = $request->file('soal_audio');
            $originalAudioQuestion = Str::random(10) . $audioQuestion->getClientOriginalName();
            $audioQuestion->storeAs('public/soal', $originalAudioQuestion);
            $data['soal_audio'] = $originalAudioQuestion;

            Storage::delete('public/soal/' . $latihanSoal->soal_audio);
        }

        //answer a
        if ($request->input('answer_a_type') === 'text') {
            $validate['jawaban_a'] = 'string';
            $data['jawaban_a'] = $request->input('jawaban_a');
            $data['jawaban_a_gambar'] = null;
        } elseif ($request->input('answer_a_type') === 'image') {
            $answerAImage = $request->file('jawaban_a_gambar');
            $originalAnswerAImage = Str::random(10) . $answerAImage->getClientOriginalName();
            $answerAImage->storeAs('public/jawaban_a', $originalAnswerAImage);
            $data['jawaban_a_gambar'] = $originalAnswerAImage;

            Storage::delete('public/jawaban_a/' . $latihanSoal->jawaban_a_gambar);

            $data['jawaban_a'] = null;
        } else {
            $data['jawaban_a_gambar'] = $latihanSoal->jawaban_a_gambar;
            $data['jawaban_a'] = null;
        }

        //answer b
        if ($request->input('answer_b_type') === 'text') {
            $validate['jawaban_b'] = 'string';
            $data['jawaban_b'] = $request->input('jawaban_b');
            $data['jawaban_b_gambar'] = null;
        } else if ($request->input('answer_b_type') === 'image') {
            // $answerBImage = $request->input('jawaban_b_gambar');
            $answerBImage = $request->file('jawaban_b_gambar');
            $originalAnswerBImage = Str::random(10) . $answerBImage->getClientOriginalName();
            $answerBImage->storeAs('public/jawaban_b', $originalAnswerBImage);
            $data['jawaban_b_gambar'] = $originalAnswerBImage;

            Storage::delete('public/jawaban_b/' . $latihanSoal->jawaban_b_gambar);

            $data['jawaban_b'] = null;
        } else {
            $data['jawaban_b_gambar'] = $latihanSoal->jawaban_b_gambar;
            $data['jawaban_b'] = null;
        }

        //answer c
        if ($request->input('answer_c_type') === 'text') {
            $validate['jawaban_c'] = 'string';
            $data['jawaban_c'] = $request->input('jawaban_c');
            $data['jawaban_c_gambar'] = null;
        } else if ($request->input('answer_c_type') === 'image') {
            // $answerCImage = $request->input('jawaban_c_gambar');
            $answerCImage = $request->file('jawaban_c_gambar');
            $originalAnswerCImage = Str::random(10) . $answerCImage->getClientOriginalName();
            $answerCImage->storeAs('public/jawaban_c', $originalAnswerCImage);
            $data['jawaban_c_gambar'] = $originalAnswerCImage;

            Storage::delete('public/jawaban_c/' . $latihanSoal->jawaban_c_gambar);

            $data['jawaban_c'] = null;
        } else {
            $data['jawaban_c_gambar'] = $latihanSoal->jawaban_c_gambar;
            $data['jawaban_c'] = null;
        }

        //answer d
        if ($request->input('answer_d_type') === 'text') {
            $validate['jawaban_d'] = 'string';
            $data['jawaban_d'] = $request->input('answer_d');
            $data['jawaban_d_gambar'] = null;
        } else if ($request->input('answer_d_type') === 'image') {
            // $answerDImage = $request->input('jawaban_d_gambar');
            $answerDImage = $request->file('jawaban_d_gambar');
            $originalAnswerDImage = Str::random(10) . $answerDImage->getClientOriginalName();
            $answerDImage->storeAs('public/jawaban_d', $originalAnswerDImage);
            $data['jawaban_d_gambar'] = $originalAnswerDImage;

            Storage::delete('public/jawaban_d/' . $latihanSoal->jawaban_d_gambar);

            $data['answer_d'] = null;
        } else {
            $data['jawaban_d_gambar'] = $latihanSoal->jawaban_d_gambar;
            $data['answer_d'] = null;
        }

        //answer e
        if ($request->input('answer_e_type') === 'text') {
            $validate['jawaban_e'] = 'string';
            $data['jawaban_e'] = $request->input('answer_e');
            $data['jawaban_e_gambar'] = null;
        } else if ($request->input('answer_e_type') === 'image') {
            // $answerDImage = $request->input('jawaban_d_gambar');
            $answerEImage = $request->file('jawaban_e_gambar');
            $originalAnswerEImage = Str::random(10) . $answerEImage->getClientOriginalName();
            $answerEImage->storeAs('public/jawaban_e', $originalAnswerEImage);
            $data['jawaban_e_gambar'] = $originalAnswerEImage;

            Storage::delete('public/jawaban_e/' . $latihanSoal->jawaban_e_gambar);

            $data['jawaban_e'] = null;
        } else {
            $data['jawaban_e_gambar'] = $latihanSoal->jawaban_e_gambar;
            $data['answer_e'] = null;
        }


        if ($request->has('konten_bacaan_teks')) {
            $validate['konten_bacaan_teks'] = 'string';
            $input = strip_tags($request->input('konten_bacaan_teks'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['konten_bacaan_teks'] = 'nullable|string';
            $data['konten_bacaan_teks'] = $input;
        }

        if ($request->hasFile('konten_bacaan_gambar')) {
            $imageQuestion = $request->file('konten_bacaan_gambar');
            $originalImageQuestion = Str::random(10) . $imageQuestion->getClientOriginalName();
            $imageQuestion->storeAs('public/reading-latihan-soal', $originalImageQuestion);
            $data['konten_bacaan_gambar'] = $originalImageQuestion;

            Storage::delete('public/reading-latihan-soal/' . $latihanSoal->konten_bacaan_gambar);
        }

        $latihanSoal->update($data);

        return redirect()->route('LatihanSoal.index')->with('success', 'Berhasil Ubah Soal');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LatihanSoal $latihanSoal, $id)
    {
        try {
            $latihanSoal = LatihanSoal::find($id);

            if (!$latihanSoal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Soal not found',
                ], 404);
            }

            Storage::delete('public/soal/' . $latihanSoal->soal_gambar);
            Storage::delete('public/soal/' . $latihanSoal->question_audio);
            Storage::delete('public/jawaban_a/' . $latihanSoal->jawaban_a_gambar);
            Storage::delete('public/jawaban_b/' . $latihanSoal->jawaban_b_gambar);
            Storage::delete('public/jawaban_c/' . $latihanSoal->jawaban_c_gambar);
            Storage::delete('public/jawaban_d/' . $latihanSoal->jawaban_d_gambar);
            Storage::delete('public/jawaban_e/' . $latihanSoal->answer_e_image);
            Storage::delete('public/reading-latihan-soal/' . $latihanSoal->konten_bacaan_gambar);

            //Menghapus soal
            $latihanSoal->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Soal deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteImage($id)
    {
        $latihanSoal =  LatihanSoal::find($id);

        //question image
        if ($latihanSoal && $latihanSoal->soal_gambar) {
            Storage::delete('public/soal/' . $latihanSoal->soal_gambar);

            $latihanSoal->update(['soal_gambar' => null]);

            return redirect()->back()->with('success', 'Gambar soal berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        //image content reading
        if ($latihanSoal && $latihanSoal->konten_bacaan_gambar) {
            Storage::delete('public/reading-latihan-soal/' . $latihanSoal->konten_bacaan_gambar);

            $latihanSoal->update(['konten_bacaan_gambar' => null]);

            return redirect()->back()->with('success', 'Gambar reading content berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        // answer a image
        if ($latihanSoal && $latihanSoal->jawaban_a_gambar) {
            Storage::delete('public/jawaban_a/' . $latihanSoal->jawaban_a_gambar);

            $latihanSoal->update(['jawaban_a_gambar' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban a berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        // answer b image
        if ($latihanSoal && $latihanSoal->jawaban_b_gambar) {
            Storage::delete('public/jawaban_b/' . $latihanSoal->jawaban_b_gambar);

            $latihanSoal->update(['jawaban_b_gambar' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban b berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        // answer c image
        if ($latihanSoal && $latihanSoal->jawaban_c_gambar) {
            Storage::delete('public/jawaban_c/' . $latihanSoal->jawaban_c_gambar);

            $latihanSoal->update(['jawaban_c_gambar' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban c berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        // answer d image
        if ($latihanSoal && $latihanSoal->jawaban_d_gambar) {
            Storage::delete('public/jawaban_d/' . $latihanSoal->jawaban_d_gambar);

            $latihanSoal->update(['jawaban_d_gambar' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban d berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }

        if ($latihanSoal && $latihanSoal->jawaban_e_gambar) {
            Storage::delete('public/jawaban_e/' . $latihanSoal->jawaban_e_gambar);

            $latihanSoal->update(['jawaban_e_gambar' => null]);

            return redirect()->back()->with('success', 'Gambar jawaban e berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada gambar yang dapat dihapus.');
        }
    }

    public function deleteAudio($id)
    {
        $latihanSoal = LatihanSoal::find($id);

        if ($latihanSoal && $latihanSoal->soal_audio) {
            Storage::delete('public/soal/' . $latihanSoal->soal_audio);

            $latihanSoal->update(['soal_audio' => null]);

            return redirect()->back()->with('success', 'Audio soal berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada audio yang dapat dihapus.');
        }
    }
}
