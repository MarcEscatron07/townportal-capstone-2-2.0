<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use App\Models\Status;
use App\Models\Desktop;
use App\Models\Computer;
use Illuminate\Http\Request;
use App\Models\MaintenanceLog;
use App\Models\DisposalArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DesktopController extends Controller
{
    /*
        To create a Controller resource, run this artisan command:
        -   php artisan make:controller NameOfController --resource
    */

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
        
        $desktops = Desktop::paginate(5);
        // $desktops = [];
        $statuses = Status::skip(0)->take(2)->get();
        // $statuses = [];

        return view('pages.general.desktops', compact('desktops','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $computers = Computer::all();

        return view('actions.create_desktop', compact('computers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkComputer = Desktop::where('computer_id', '=', $request->dsk_num)->first(); 
        $checkDesktop = Desktop::where('serial_number', '=', strtoupper($request->dsk_serial))->first();

        $desktops = new Desktop;
        
        if($checkComputer || $checkDesktop){
            session()->flash('error','Desktop already exists!');
            return redirect('/desktops/create');
        } else {
            $desktops->computer_id = $request->dsk_num;
            $desktops->name = $request->dsk_name;
            $desktops->brand = $request->dsk_brand;
            $desktops->serial_number = strtoupper($request->dsk_serial);
            $desktops->cost = $request->dsk_cost;
            $desktops->purchase_date = $request->dsk_pdate;

            $desktops->save();

            session()->flash('success', 'Desktop Added');
            return redirect('/desktops');                
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
    public function edit(Desktop $desktop)
    {
        $computers = Computer::all();        
        $statuses = Status::skip(0)->take(2)->get();

        return view('actions.update_desktop', compact('desktop','computers','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Desktop $desktop, Request $request)
    {
        $checkComputer = Desktop::where('computer_id', '=', $request->dsk_num)->first(); 
        $checkDesktop = Desktop::where('serial_number', '=', strtoupper($request->dsk_serial))->first();

        if($checkComputer || $checkDesktop){
            session()->flash('error','Desktop already exists!');
            return back();
        } else {
            $desktop->computer_id = $request->dsk_num;
            $desktop->name = $request->dsk_name;
            $desktop->brand = $request->dsk_brand;
            $desktop->serial_number = strtoupper($request->dsk_serial);
            $desktop->cost = $request->dsk_cost;
            $desktop->purchase_date = $request->dsk_pdate;
    
            $desktop->save();
    
            session()->flash('success', 'Desktop successfully updated!');
            return redirect('/desktops');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desktop $desktop, DisposalArchive $disposal)
    {
        $desktopQuery = Desktop::find($desktop->id);
        $desktopUnique = strtoupper($desktopQuery->serial_number);
        $checkData = DisposalArchive::where('serial_number', '=', $desktopUnique)->first();

        if($checkData) {
            var_dump($checkData);
        } else {
            date_default_timezone_set('Asia/Manila');
            $date = date('Y/m/d');
            $dateTime = date('Y/m/d H:i:s');

            $disposal->assigned_computer = $desktopQuery->computer->location->row.$desktopQuery->computer->pc_number;
            $disposal->name = $desktopQuery->name;
            $disposal->brand = $desktopQuery->brand;
            $disposal->type = Type::find(1)->name;
            $disposal->serial_number = $desktopUnique;
            $disposal->cost = $desktopQuery->cost;   
            $disposal->purchase_date = $desktopQuery->purchase_date;
            $disposal->disposal_date = $date;
            $disposal->archived_at = $dateTime;
            $disposal->save();
        }

        $checkMaintenanceData = MaintenanceLog::where('serial_number', '=', $desktopUnique)->first(); 
        if($checkMaintenanceData) {
            $checkMaintenanceData->delete();
            DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $desktop->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        session()->flash('error','Item has been set for disposal!');
        return redirect('/desktops');
    }

    public function deleteAll($id, Request $request) {
        $verifyPassword = User::find($id)->password;

        if(Hash::check($request->delall_password, $verifyPassword)) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Desktop::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            session()->flash('error','All data has been deleted!');
            return redirect('/desktops');
        } else {
            session()->flash('error','Entered password is incorrect!');
            return back();
        }
    }

    public function updateStatus(
        MaintenanceLog $maintenance,
        Request $request
    ) {
        Desktop::where('id', '=',$request->desktopID)->update(['status_id' => $request->statusID]); 

        if($request->statusID == 2){
            $desktopQuery = Desktop::find($request->desktopID);
            $desktopUnique = strtoupper($desktopQuery->serial_number);
            $checkData = MaintenanceLog::where('serial_number', '=', $desktopUnique)->first();

            if($checkData) {
                var_dump($checkData);
            } else {
                date_default_timezone_set('Asia/Manila');
                $date = date('Y/m/d H:i:s');

                $maintenance->assigned_computer = $desktopQuery->computer->location->row.$desktopQuery->computer->pc_number;
                $maintenance->name = $desktopQuery->name;
                $maintenance->brand = $desktopQuery->brand;
                $maintenance->type = Type::find(1)->name;
                $maintenance->serial_number = $desktopUnique;                
                $maintenance->logged_at = $date;
                $maintenance->remarks = "None";
                $maintenance->save();
            }
        } else {
            $desktopQuery = Desktop::find($request->desktopID);
            $desktopUnique = strtoupper($desktopQuery->serial_number);

            MaintenanceLog::where('serial_number', '=', $desktopUnique)->delete();
            MaintenanceLog::onlyTrashed()->where('serial_number', '=', $desktopUnique)->first()->forceDelete();
            DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');
        }

        $mcount = count(MaintenanceLog::all());
        echo $mcount;
    }
}
