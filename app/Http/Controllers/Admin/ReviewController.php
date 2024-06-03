<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use Yajra\DataTables\DataTables;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $review = Review::get();
        if ($request->ajax()) {
            return DataTables::of($review)
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
                            <a href="' . route('ReviewAplikasi.show', $item->id) . '" class="menu-link px-3">
                                Review Detail
                            </a>
                        </div>
                    <div class="menu-item px-3">
                            <a href="' . route('ReviewAplikasi.edit', $item->id) . '" class="menu-link px-3">
                                Edit Data
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('user_id', function ($item) {
                    return $item->user->name ? $item->user->name : "-";
                })
                ->rawColumns(['actions'])
                ->make();
        }
        return view('admin.review.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();

        return view('admin.review.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $validate = [
            'user_id' => 'required',
        ];

        if ($request->has('description')) {
            $validate['description'] = 'string';
            $input = strip_tags($request->input('description'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['description'] = 'nullable|string';
            $data['description'] = $input;
        } else {
            $data['description'] = null;
        }

        $request->validate($validate);

        Review::create($data);

        return redirect()->route('ReviewAplikasi.index')->with('success', 'Berhasil Tambah Review');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reviews = Review::find($id);

        return view('admin.review.show', compact('reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::find($id);

        $users = User::select(['id', 'name'])->get();

        return view('admin.review.edit', compact('review', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');

        $validate = [
            'user_id' => 'required',
        ];

        if ($request->has('description')) {
            $validate['description'] = 'string';
            $input = strip_tags($request->input('description'));
            $input = preg_replace('/&hellip;|&nbsp;/', '', $input);
            $input = preg_replace('/&rdquo;/', '"', $input);
            $validate['description'] = 'nullable|string';
            $data['description'] = $input;
        }

        $review = Review::find($id);

        $review->update($data);

        return redirect()->route('ReviewAplikasi.index')->with('success', 'Berhasil Ubah Review');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $review = Review::find($id);

            if (!$review) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Review pengguna not found',
                ], 404);
            }

            $review->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Review pengguna deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
