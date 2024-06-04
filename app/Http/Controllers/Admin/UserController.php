<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Universitas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::whereIn('name', ['Super Admin', 'User'])->get();
        $user = User::role($roles)->get();
        if ($request->ajax()) {
            return DataTables::of($user)
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
                            <a href="' . route('User.edit', $item->id) . '" class="menu-link px-3">
                                Edit Data
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a class="menu-link px-3 delete-confirm" data-id="' . $item->id . '" role="button">Hapus</a>
                        </div>
                    </div>
                </div>';
                })
                ->editColumn('profile_photo_path', function ($item) {
                    if ($item->profile_photo_path) {
                        $imagePath = "storage/{$item->profile_photo_path}";
                        $imageUrl = asset($imagePath);
                        return  '<img src="' . $imageUrl . '" width="50%" height="50%">';
                    } else {
                        return '-';
                    }
                })
                ->editColumn('role', function ($item) {
                    return $item->getRoleNames()->first() ?? '-';
                })
                ->editColumn('universitas_id', function ($item) {
                    return $item->universitas->name ?? '-';
                })
                ->editColumn('prodis_id', function ($item) {
                    return $item->prodi->name ?? '-';
                })
                ->rawColumns(['actions', 'profile_photo_path'])
                ->make();
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodis = Prodi::get();
        $universitas = Universitas::get();
        return view('admin.user.create', [
            'user' => new User(),
            'prodis' => $prodis,
            'universitas' => $universitas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string',
                'password' => 'required',
                'email' => 'required|string|',
                'prodis_id' => 'nullable',
                'universitas_id' => 'nullable',
            ]);

            $data = [
                'name' => $request->name,
                'username' => $request->username ?? 0,
                'password' => Hash::make($request->password),
                'prodis_id' => $request->prodis_id,
                'universitas_id' => $request->universitas_id,
                'email' => $request->email ?? 0,
            ];

            $user = User::create($data);

            $role = Role::firstOrCreate(['name' => $request['role']]);
            $user->assignRole($role);

            return to_route('User.index', $user)->with('success', 'User create successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::whereId($id)->firstOrFail();

        $users = User::whereIn('id', function ($query) {
            $query->select(DB::raw('MIN(id)'))
                ->from('users')
                ->groupBy('prodis_id');
        })->get();

        $prodis = Prodi::select(['id', 'name'])->get();

        $universitas = Universitas::select(['id', 'name'])->get();

        return view('admin.user.edit', [
            'user' => $user,
            'users' => $users,
            'prodis' => $prodis,
            'universitas' => $universitas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string',
                'email' => 'required|string|',
                'prodis_id' => 'nullable',
                'universitas_id' => 'nullable',
            ]);

            $user = User::findOrFail($id);


            $user->update([
                'name'          => $request->name ?? $user->name,
                'username'      => $request->username ?? $user->username,
                'email'         => $request->email ?? $user->email,
                'prodis_id'     => $request->prodis_id ?? $user->prodis_id,
                'universitas_id'     => $request->universitas_id ?? $user->universitas_id,
            ]);

            return to_route('User.index')->with('success', 'User update successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
