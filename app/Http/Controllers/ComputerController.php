<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index() {
        // $mcount = MaintenanceLog::all();
        // session(['maintenancecount' => count($mcount)]);

        // $dcount = DisposalArchive::all();
        // session(['disposalcount' => count($dcount)]);

    	// $locations = Location::all();
    	$locations = [];
        // $computers = Computer::paginate(5);
        $computers = [];
        // $peripherals = Peripheral::all();
        $peripherals = [];

    	return view('pages.general.computers', compact('locations','computers','peripherals'));
    }

    public function create() {

    }

    public function store() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {

    }
}
