<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\KategoriSoalSoshum;


class KategoriSoshum extends Controller
{
    public function index(Request $request) {
        $kategoriSoshum = KategoriSoalSoshum::get();

        if ($request->ajax()) {
            return DataTables::of($kategoriSoshum)
                ->addIndexColumn()
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
                            <a href="' . route('admin.kategori-soshum.edit', $item->id) . '" class="menu-link px-3">
                                Edit Data
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->rawColumns(['actions'])
                ->make();
        }
        return view('admin.kategori-soal.index');
    }

    public function create() {
        return view('admin.kategori-soal.createKategoriSoshum');
    }


    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
        ]);

        KategoriSoalSoshum::create($data);

        return redirect()->route('admin.kategori')->with('success', 'Berhasil Tambah Kategori Soal Soshum');
    }

    public function edit(string $id)
    {
        $kategoriSoshum = KategoriSoalSoshum::find($id);

        return view('admin.kategori-soshum.edit', compact('kategoriSoshum'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
        ]);

        $kategoriSoshum = KategoriSoalSoshum::find($id);

        $kategoriSoshum->update($data);

        return redirect()->route('admin.kategori')->with('success', 'Berhasil Ubah Kategori Soal Soshum');
    }

    public function destroy($id)
    {
        try {
            $kategoriSoshum = KategoriSoalSoshum::find($id);

            if (!$kategoriSoshum) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori Soal Soshum not found',
                ], 404);
            }

            $kategoriSoshum->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori Soal Soshum Deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



}
