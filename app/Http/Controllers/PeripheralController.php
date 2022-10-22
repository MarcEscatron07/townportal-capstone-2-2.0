<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use App\Models\Status;
use App\Models\Computer;
use App\Models\Peripheral;
use Illuminate\Http\Request;
use App\Models\MaintenanceLog;
use App\Models\DisposalArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PeripheralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mcount = MaintenanceLog::all();
        session(['maintenancecount' => count($mcount)]);

        $dcount = DisposalArchive::all();
        session(['disposalcount' => count($dcount)]);

        $peripherals = Peripheral::orderBy('computer_id','asc')->paginate(5);
        // $peripherals = [];
        $statuses = Status::skip(0)->take(2)->get();
        // $statuses = [];

        return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $computers = Computer::all();
        $types = Type::skip(1)->take(4)->get();

        return view('actions.create_peripheral', compact('computers','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkComputer = Peripheral::where('computer_id', '=', $request->per_num)->first(); 
        $checkPeripheral = Peripheral::where('serial_number', '=', strtoupper($request->per_serial))->first();

        $peripherals = new Peripheral;

        if($checkComputer || $checkPeripheral) {
            session()->flash('error','Peripheral already exists!');
            return redirect('/peripherals/create');
        } else {
            $peripherals->computer_id = $request->per_num;
            $peripherals->name = $request->per_name;
            $peripherals->brand = $request->per_brand;
            $peripherals->type_id = $request->per_type;
            $peripherals->serial_number = strtoupper($request->per_serial);
            $peripherals->cost = $request->per_cost;
            $peripherals->purchase_date = $request->per_pdate;

            if(!empty(trim($request->per_remarks))) {
                $peripherals->remarks = $request->per_remarks;
            } else {
                $peripherals->remarks = "None";
            }

            $peripherals->save();

            session()->flash('success', 'Peripheral Added');
            return redirect('/peripherals');  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Peripheral $peripheral)
    {
        $computers = Computer::all();        
        $statuses = Status::skip(0)->take(2)->get();
        $types = Type::skip(1)->take(4)->get();

        return view('actions.update_peripheral', compact('peripheral','computers','statuses','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Peripheral $peripheral, Request $request)
    {
        $checkComputer = Peripheral::where('computer_id', '=', $request->per_num)->first(); 
        $checkPeripheral = Peripheral::where('serial_number', '=', strtoupper($request->per_serial))->first();

        if($checkComputer || $checkPeripheral) {
            session()->flash('error','Peripheral already exists!');
            return back();
        } else {
            $peripheral->computer_id = $request->per_num;
            $peripheral->name = $request->per_name;
            $peripheral->brand = $request->per_brand;
            $peripheral->type_id = $request->per_type;
            $peripheral->serial_number = strtoupper($request->per_serial);
            $peripheral->cost = $request->per_cost;
            $peripheral->purchase_date = $request->per_pdate;
            $peripheral->remarks = "None";
    
            $peripheral->save();
    
            session()->flash('success', 'Peripheral successfully updated!');
            return redirect('/peripherals');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peripheral $peripheral, DisposalArchive $disposal)
    {
        $peripheralQuery = Peripheral::find($peripheral->id);
        $peripheralUnique = strtoupper($peripheralQuery->serial_number);
        $checkData = DisposalArchive::where('serial_number', '=', $peripheralUnique)->first();

        if($checkData) {
            var_dump($checkData);
        } else {
            date_default_timezone_set('Asia/Manila');
            $date = date('Y/m/d');
            $dateTime = date('Y/m/d H:i:s');

            $disposal->assigned_computer = $peripheralQuery->computer->location->row.$peripheralQuery->computer->pc_number;
            $disposal->name = $peripheralQuery->name;
            $disposal->brand = $peripheralQuery->brand;
            $disposal->type = Type::find($peripheralQuery->type_id)->name;
            $disposal->serial_number = $peripheralUnique;
            $disposal->cost = $peripheralQuery->cost;     
            $disposal->purchase_date = $peripheralQuery->purchase_date;
            $disposal->disposal_date = $date;
            $disposal->archived_at = $dateTime;
            $disposal->save();
        }

        $checkMaintenanceData = MaintenanceLog::where('serial_number', '=', $peripheralUnique)->first(); 
        if($checkMaintenanceData) {
            $checkMaintenanceData->delete();
            DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $peripheral->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        session()->flash('error','Item has been set for disposal!');
        return redirect('/peripherals');
    }

    public function deleteAll($id, Request $request) {
        $verifyPassword = User::find($id)->password;

        if(Hash::check($request->delall_password, $verifyPassword)) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Peripheral::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            session()->flash('error','All data has been deleted!');
            return redirect('/desktops');
        } else {
            session()->flash('error','Entered password is incorrect!');
            return back();
        }
    }

    public function showMonitor() {
        $typeID = 2;
        $logcount = MaintenanceLog::all();
        session(['logcount' => count($logcount)]);
        
        $peripherals = Peripheral::where('type_id', '=', $typeID)->paginate(5);
        $statuses = Status::skip(0)->take(2)->get();
        
        return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    public function showKeyboard() {
        $typeID = 3;
        $logcount = MaintenanceLog::all();
        session(['logcount' => count($logcount)]);
        
        $peripherals = Peripheral::where('type_id', '=', $typeID)->paginate(5);
        $statuses = Status::skip(0)->take(2)->get();
        
        return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    public function showMouse() {
        $typeID = 4;
        $logcount = MaintenanceLog::all();
        session(['logcount' => count($logcount)]);
        
        $peripherals = Peripheral::where('type_id', '=', $typeID)->paginate(5);
        $statuses = Status::skip(0)->take(2)->get();
        
        return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    public function showHeadset() {
        $typeID = 5;
        $logcount = MaintenanceLog::all();
        session(['logcount' => count($logcount)]);
        
        $peripherals = Peripheral::where('type_id', '=', $typeID)->paginate(5);
        $statuses = Status::skip(0)->take(2)->get();
        
        return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    public function updateStatus(
        MaintenanceLog $maintenance,
        Request $request
    ) {
        Peripheral::where('id', '=',$request->peripheralID)->update(['status_id' => $request->statusID]); 

        if($request->statusID == 2){
            $peripheralQuery = Peripheral::find($request->peripheralID);
            $peripheralUnique = strtoupper($peripheralQuery->serial_number);
            $checkData = MaintenanceLog::where('serial_number', '=', $peripheralUnique)->first();

            if($checkData) {
                var_dump($checkData);
            } else {
                date_default_timezone_set('Asia/Manila');
                $date = date('Y/m/d H:i:s');

                $maintenance->assigned_computer = $peripheralQuery->computer->location->row.$peripheralQuery->computer->pc_number;
                $maintenance->name = $peripheralQuery->name;
                $maintenance->brand = $peripheralQuery->brand;
                $maintenance->type = Type::find($peripheralQuery->type_id)->name;
                $maintenance->serial_number = $peripheralUnique;     
                $maintenance->logged_at = $date;                
                $maintenance->remarks = "None";
                $maintenance->save();
            }
        } else {
            $peripheralQuery = Peripheral::find($request->peripheralID);
            $peripheralUnique = strtoupper($peripheralQuery->serial_number);

            MaintenanceLog::where('serial_number', '=', $peripheralUnique)->delete();
            MaintenanceLog::onlyTrashed()->where('serial_number', '=', $peripheralUnique)->first()->forceDelete();
            DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');
        }

        $mcount = count(MaintenanceLog::all());
        echo $mcount;
    }
}
