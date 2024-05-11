<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketSoalLatihanSoal;
use App\Models\LatihanSoal;
use App\Models\Kategori;

class LatihanSoalController extends Controller
{
    public function index() {
        $paketLatihanSoals = PaketSoalLatihanSoal::all();
        
        return view('user.latihan-soal.detail-menu', compact('paketLatihanSoals'));
    }
}
