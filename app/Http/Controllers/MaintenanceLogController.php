<?php

namespace App\Http\Controllers;

use App\Models\Desktop;
use App\Models\Peripheral;
use Illuminate\Http\Request;
use App\Models\MaintenanceLog;
use App\Models\DisposalArchive;
use Illuminate\Support\Facades\DB;

class MaintenanceLogController extends Controller
{
    public function index() {
        $mcount = MaintenanceLog::all();
        session(['maintenancecount' => count($mcount)]);

        $dcount = DisposalArchive::all();
        session(['disposalcount' => count($dcount)]);
        
        $maintenancelogs = MaintenanceLog::paginate(5);
        // $maintenancelogs = [];
        
    	return view('pages.maintenance', compact('maintenancelogs'));
    }

    public function setStatus($id){        
        $checkType = MaintenanceLog::find($id)->type;
        $serialNumber = strtoupper(MaintenanceLog::find($id)->serial_number);
        if($checkType == 'Desktop') {
            Desktop::where('serial_number', '=', $serialNumber)->update(['status_id' => 1]);
        } else {
            Peripheral::where('serial_number', '=', $serialNumber)->update(['status_id' => 1]);
        }

        MaintenanceLog::find($id)->delete();
        MaintenanceLog::onlyTrashed()->where('id', '=', $id)->first()->forceDelete();
        DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');

        session()->flash('success','Item status has been set!');
        return redirect('/maintenancelog');
    }

    public function setDisposal($id, DisposalArchive $disposal) {        
        $itemQuery = MaintenanceLog::find($id);
        $checkType = $itemQuery->type;
        $serialNumber = strtoupper($itemQuery->serial_number);

        $checkData = DisposalArchive::where('serial_number', '=', $serialNumber)->first();
        if($checkData) {
            var_dump($checkData);
        } else {
            date_default_timezone_set('Asia/Manila');
            $date = date('Y/m/d');
            $dateTime = date('Y/m/d H:i:s');

            $disposal->assigned_computer = $itemQuery->assigned_computer;
            $disposal->name = $itemQuery->name;
            $disposal->brand = $itemQuery->brand;
            $disposal->type = $itemQuery->type;
            $disposal->serial_number = $serialNumber;           
            $disposal->disposal_date = $date;
            $disposal->archived_at = $dateTime;

            if($checkType == 'Desktop') {
                $disposal->cost = DB::table('desktops')
                ->where('serial_number', '=', $serialNumber)->first()->cost;

                $disposal->purchase_date = DB::table('desktops')
                ->where('serial_number', '=', $serialNumber)->first()->purchase_date;
            } else {
                $disposal->cost = DB::table('peripherals')
                ->where('serial_number', '=', $serialNumber)->first()->cost;

                $disposal->purchase_date = DB::table('peripherals')
                ->where('serial_number', '=', $serialNumber)->first()->purchase_date;
            }

            $disposal->save();
        }

        if($checkType == 'Desktop') {
            Desktop::where('serial_number', '=', $serialNumber)->delete();            
        } else {
            Peripheral::where('serial_number', '=', $serialNumber)->delete();            
        }

        MaintenanceLog::find($id)->delete();

        session()->flash('error','Item has been set for disposal!');
        return redirect('/maintenancelog');
    }

    public function getRemarks(Request $request) {
        echo MaintenanceLog::find($request->remarksID)->remarks;
    }

    public function updateRemarks(Request $request) {
        MaintenanceLog::where('id', '=',$request->remarksID)->update(['remarks' => $request->formRemarks]);
        
        session()->flash('success', 'Remarks saved!');
        return redirect('/maintenancelog');
    }
}
