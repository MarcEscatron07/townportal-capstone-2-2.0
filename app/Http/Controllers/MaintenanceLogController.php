<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceLogController extends Controller
{
    public function index() {
        // $mcount = MaintenanceLog::all();
        // session(['maintenancecount' => count($mcount)]);

        // $dcount = DisposalArchive::all();
        // session(['disposalcount' => count($dcount)]);
        
        // $maintenancelogs = MaintenanceLog::paginate(5);
        $maintenancelogs = [];
        
    	return view('pages.maintenance', compact('maintenancelogs'));
    }

    public function setStatus() {

    }

    public function setDisposal() {

    }

    public function getRemarks() {

    }

    public function updateRemarks() {

    }
}
