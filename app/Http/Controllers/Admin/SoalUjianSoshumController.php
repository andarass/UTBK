<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriSoalSoshum;
use App\Models\SoalUjianSoshum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Models\PaketSoalUjianSoshum;

class SoalUjianSoshumController extends Controller
{
    public function index(Request $request)
    {
        $soalUjianSoshum = SoalUjianSoshum::get();

        if ($request->ajax()) {
            return DataTables::of($soalUjianSoshum)
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
                        $imagePath = "storage/soal-soshum/{$item->soal_gambar}";
                        $imageUrl = asset($imagePath);
                        return  '<img src="' . $imageUrl . '" width="50%" height="50%">';
                    } else {
                        return '-';
                    }
                })

                ->editColumn('soal_audio', function ($item) {
                    if ($item->soal_audio) {
                        $audioPath = "storage/soal-soshum/{$item->soal_audio}";
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
                            <a href="' . route('admin.soal-ujian-soshum.edit', $item->id) . '" class="menu-link px-3">
                                Edit Soal
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('kategori_soal', function ($item) {
                    return $item->Kategori->name ? $item->Kategori->name : "-";
                })
                ->editColumn('paket_soal', function ($item) {
                    return $item->PaketSoal->name ?? "-";
                })
                ->editColumn('kategori_utbk', function ($item) {
                    return $item->KategoriTest->name ?? "-";
                })
                ->rawColumns(['actions', 'soal_gambar', 'soal_audio', 'soal'])
                ->make();
        }
    }
}
