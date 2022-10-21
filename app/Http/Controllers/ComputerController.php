<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Computer;
use App\Models\Location;
use App\Models\Peripheral;
use Illuminate\Http\Request;
use App\Models\MaintenanceLog;
use App\Models\DisposalArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ComputerController extends Controller
{
    public function index() {
        $mcount = MaintenanceLog::all();
        session(['maintenancecount' => count($mcount)]);

        $dcount = DisposalArchive::all();
        session(['disposalcount' => count($dcount)]);

    	$locations = Location::all();
    	// $locations = [];
        $computers = Computer::paginate(5);
        // $computers = [];
        $peripherals = Peripheral::all();
        // $peripherals = [];

    	return view('pages.general.computers', compact('locations','computers','peripherals'));
    }

    public function create() {
        $actionFlag = 1;
        $locations = Location::all();     

    	return view('actions.action_computer', compact('actionFlag','locations'));
    }

    public function store(Request $request) {
        $checkRow = Computer::where('location_id', '=', $request->cmp_row)->first(); 
        $checkNumber = Computer::where('pc_number', '=', $request->cmp_num)->first();

        $computer = new Computer;

        if($checkRow && $checkNumber) {            
            session()->flash('error','Computer already exists!');
            return redirect('/computers/create');
        } else {
            $computer->location_id = $request->cmp_row;
            $computer->pc_number = $request->cmp_num;

            $computer->save();

            session()->flash('success','Computer added!');
            return redirect('/computers/create');
        }
    }

    public function show() {

    }

    public function edit(Computer $computer) {
        $actionFlag = 0;
        $locations = Location::all();
        
        return view('actions.action_computer', compact('actionFlag','computer', 'locations'));
    }

    public function update(Computer $computer, Request $request) {
        $checkRow = Computer::where('location_id', '=', $request->cmp_row)->first(); 
        $checkNumber = Computer::where('pc_number', '=', $request->cmp_num)->first();

        if($checkRow && $checkNumber) {  
            session()->flash('error','Computer already exists!');
            return back();
        } else {
            $computer->location_id=$request->cmp_row;
            $computer->pc_number=$request->cmp_num;
    
            $computer->save();
    
            session()->flash('success','Computer successfully updated!');
            return redirect('/computers');
        }
    }

    public function destroy(Computer $computer, Request $request) {
        $verifyPassword = User::find($request->deldata_userid)->password;

        if(Hash::check($request->deldata_password, $verifyPassword)) {
            $computer->delete();
            DB::statement('ALTER TABLE computers AUTO_INCREMENT=1;');
            // reset AUTO_INCREMENT to the other tables affected as well
            DB::statement('ALTER TABLE desktops AUTO_INCREMENT=1;');
            DB::statement('ALTER TABLE peripherals AUTO_INCREMENT=1;');
    
            session()->flash('error','Data has been deleted!');
            return redirect('/computers');
        } else {
            session()->flash('error','Entered password is incorrect!');
            return back();
        }
    }
}
