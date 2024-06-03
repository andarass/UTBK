<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

class HomeController extends Controller
{
    public function index() {
        $reviews = Review::with('user')->get();

        return view('user.home', compact('reviews'));
    }
}
