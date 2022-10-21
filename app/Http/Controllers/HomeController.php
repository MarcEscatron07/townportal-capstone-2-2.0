<?php

namespace App\Http\Controllers;

use App\Models\Desktop;
use App\Models\Computer;
use App\Models\Peripheral;
use Illuminate\Http\Request;
use App\Models\MaintenanceLog;
use App\Models\DisposalArchive;

class HomeController extends Controller
{
    public function index() {
        $mcount = MaintenanceLog::all();
        session(['maintenancecount' => count($mcount)]);

        $dcount = DisposalArchive::all();
        session(['disposalcount' => count($dcount)]);
        
        $computerCount = count(Computer::all());
        // $computerCount = 0;
        $desktopCount = count(Desktop::all());
        // $desktopCount = 0;
        $peripheralCount = count(Peripheral::all());
        // $peripheralCount = 0;

        return view('home', [
            'computerCount' => $computerCount,
            'desktopCount' => $desktopCount,
            'peripheralCount' => $peripheralCount,
        ]);
    }
}
