<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('home', [
            'computerCount' => 0,
            'desktopCount' => 0,
            'peripheralCount' => 0,
        ]);
    }
}
