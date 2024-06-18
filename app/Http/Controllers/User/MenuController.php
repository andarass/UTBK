<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index() {
        return view('user.menu');
    }
    public function dataPengguna(Request $request) {

        $user = Auth::user();

        if(is_null($user->nomer_tlp) || is_null($user->kota_lahir) || is_null($user->tanggal_lahir) ||
        is_null($user->kecamatan) || is_null($user->kelurahan) || is_null($user->kode_pos)) {
            return view('user.data-diri-pengguna');
        }

        return redirect()->route('user.menu');
    }

    public function storeDataPengguna(Request $request) {
        $user = Auth::user();
        $user->update($request->only('nomer_tlp', 'tanggal_lahir', 'kota_lahir', 'kecamatan', 'kelurahan', 'kode_pos'));

        return redirect()->route('user.menu')->with('status', 'Data diri berhasil disimpan');
    }
}
