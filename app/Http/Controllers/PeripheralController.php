<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeripheralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mcount = MaintenanceLog::all();
        // session(['maintenancecount' => count($mcount)]);

        // $dcount = DisposalArchive::all();
        // session(['disposalcount' => count($dcount)]);

        // $peripherals = Peripheral::orderBy('computer_id','asc')->paginate(5);
        $peripherals = [];
        // $statuses = Status::skip(0)->take(2)->get();
        $statuses = [];

        return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteAll($id, Request $request) {
        // $verifyPassword = User::find($id)->password;

        // if(Hash::check($request->delall_password, $verifyPassword)) {
        //     DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //     Peripheral::truncate();
        //     DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //     session()->flash('error','All data has been deleted!');
        //     return redirect('/desktops');
        // } else {
        //     session()->flash('error','Entered password is incorrect!');
        //     return back();
        // }
    }

    public function showMonitor() {
        // $typeID = 2;
        // $logcount = MaintenanceLog::all();
        // session(['logcount' => count($logcount)]);
        
        // $peripherals = Peripheral::where('type_id', '=', $typeID)->paginate(5);
        // $statuses = Status::skip(0)->take(2)->get();
        
        // return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    public function showKeyboard() {
        // $typeID = 3;
        // $logcount = MaintenanceLog::all();
        // session(['logcount' => count($logcount)]);
        
        // $peripherals = Peripheral::where('type_id', '=', $typeID)->paginate(5);
        // $statuses = Status::skip(0)->take(2)->get();
        
        // return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    public function showMouse() {
        // $typeID = 4;
        // $logcount = MaintenanceLog::all();
        // session(['logcount' => count($logcount)]);
        
        // $peripherals = Peripheral::where('type_id', '=', $typeID)->paginate(5);
        // $statuses = Status::skip(0)->take(2)->get();
        
        // return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    public function showHeadset() {
        // $typeID = 5;
        // $logcount = MaintenanceLog::all();
        // session(['logcount' => count($logcount)]);
        
        // $peripherals = Peripheral::where('type_id', '=', $typeID)->paginate(5);
        // $statuses = Status::skip(0)->take(2)->get();
        
        // return view('pages.general.peripherals', compact('peripherals','statuses'));
    }

    public function updateStatus(
        // MaintenanceLog $maintenance, 
        Request $request
    ) {
        // Peripheral::where('id', '=',$request->peripheralID)->update(['status_id' => $request->statusID]); 

        // if($request->statusID == 2){
        //     $peripheralQuery = Peripheral::find($request->peripheralID);
        //     $peripheralUnique = strtoupper($peripheralQuery->serial_number);
        //     $checkData = MaintenanceLog::where('serial_number', '=', $peripheralUnique)->first();

        //     if($checkData) {
        //         var_dump($checkData);
        //     } else {
        //         date_default_timezone_set('Asia/Manila');
        //         $date = date('Y/m/d H:i:s');

        //         $maintenance->assigned_computer = $peripheralQuery->computer->location->row.$peripheralQuery->computer->pc_number;
        //         $maintenance->name = $peripheralQuery->name;
        //         $maintenance->brand = $peripheralQuery->brand;
        //         $maintenance->type = Type::find($peripheralQuery->type_id)->name;
        //         $maintenance->serial_number = $peripheralUnique;     
        //         $maintenance->logged_at = $date;                
        //         $maintenance->remarks = "None";
        //         $maintenance->save();
        //     }
        // } else {
        //     $peripheralQuery = Peripheral::find($request->peripheralID);
        //     $peripheralUnique = strtoupper($peripheralQuery->serial_number);

        //     MaintenanceLog::where('serial_number', '=', $peripheralUnique)->delete();
        //     MaintenanceLog::onlyTrashed()->where('serial_number', '=', $peripheralUnique)->first()->forceDelete();
        //     DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');
        // }

        // $mcount = count(MaintenanceLog::all());
        // echo $mcount;
    }
}
