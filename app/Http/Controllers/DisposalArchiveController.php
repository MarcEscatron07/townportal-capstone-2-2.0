<?php

namespace App\Http\Controllers;

use App\Models\Desktop;
use App\Models\Peripheral;
use Illuminate\Http\Request;
use App\Models\DisposalDetail;
use App\Models\MaintenanceLog;
use App\Models\DisposalArchive;
use Illuminate\Support\Facades\DB;

class DisposalArchiveController extends Controller
{
    public function index() {
        $mcount = MaintenanceLog::all();
        session(['maintenancecount' => count($mcount)]);

        $dcount = DisposalArchive::all();
        session(['disposalcount' => count($dcount)]);

        $disposals = DisposalArchive::paginate(5);
        // $disposals = [];

        return view('pages.disposal', compact('disposals'));
    }

    public function restoreItem($id) {
        $disposalQuery = DisposalArchive::find($id);
        $serialNumber = strtoupper($disposalQuery->serial_number);
        $checkType = $disposalQuery->type;
        
        if($checkType == "Desktop") {
            $checkData = Desktop::onlyTrashed()
            ->where('serial_number', '=', $serialNumber)->where('status_id', '=', 2)->first();
            if($checkData){
                MaintenanceLog::onlyTrashed()->where('serial_number', '=', $serialNumber)->first()->restore();
            }

            Desktop::onlyTrashed()->where('serial_number', '=', $serialNumber)->first()->restore();
        } else {
            $checkData = Peripheral::onlyTrashed()
            ->where('serial_number', '=', $serialNumber)->where('status_id', '=', 2)->first();
            if($checkData){
                MaintenanceLog::onlyTrashed()->where('serial_number', '=', $serialNumber)->first()->restore();
            }

            Peripheral::onlyTrashed()->where('serial_number', '=', $serialNumber)->first()->restore();
        }

        DisposalDetail::where('disposal_archive_id', '=', $id)->delete();
        DB::statement('ALTER TABLE disposal_details AUTO_INCREMENT=1;');

        DisposalArchive::find($id)->delete();
        DB::statement('ALTER TABLE disposal_archives AUTO_INCREMENT=1;');
        
        session()->flash('success','Item data has been restored!');
        return redirect('/disposalarchive');
    }

    public function disposeItem($id) {
        $disposalQuery = DisposalArchive::find($id);
        $serialNumber = strtoupper($disposalQuery->serial_number);
        $checkType = $disposalQuery->type;
        
        if($checkType == "Desktop") {
            $checkData = Desktop::onlyTrashed()
            ->where('serial_number', '=', $serialNumber)->where('status_id', '=', 2)->first();
            if($checkData){
                MaintenanceLog::onlyTrashed()->where('serial_number', '=', $serialNumber)->first()->forceDelete();
                DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');
            }

            Desktop::onlyTrashed()->where('serial_number', '=', $serialNumber)->first()->forceDelete();
            DB::statement('ALTER TABLE desktops AUTO_INCREMENT=1;');
        } else {
            $checkData = Peripheral::onlyTrashed()
            ->where('serial_number', '=', $serialNumber)->where('status_id', '=', 2)->first();
            if($checkData){
                MaintenanceLog::onlyTrashed()->where('serial_number', '=', $serialNumber)->first()->forceDelete();
                DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');
            }

            Peripheral::onlyTrashed()->where('serial_number', '=', $serialNumber)->first()->forceDelete();
            DB::statement('ALTER TABLE peripherals AUTO_INCREMENT=1;');
        }

        DisposalDetail::where('disposal_archive_id', '=', $id)->delete();
        DB::statement('ALTER TABLE disposal_details AUTO_INCREMENT=1;');

        DisposalArchive::find($id)->delete();
        DB::statement('ALTER TABLE disposal_archives AUTO_INCREMENT=1;');
        
        session()->flash('error','Item data permanently deleted!');
        return redirect('/disposalarchive');
    }

    public function getDisposedItemDetails($id) {
        echo DisposalArchive::find($id)->name."\n";
        echo DisposalArchive::find($id)->brand."\n";
        echo DisposalArchive::find($id)->type."\n";
        echo DisposalArchive::find($id)->serial_number."\n";
        echo "₱".number_format(DisposalArchive::find($id)->cost, 2)."\n";
        echo DisposalArchive::find($id)->purchase_date."\n";
        echo DisposalArchive::find($id)->disposal_date;
    }

    public function hasItemDetails($id) {        
        echo DisposalArchive::find($id)->hasDetails;
    }

    public function saveItemDetails($id, Request $request) {
        $checkItem = DisposalDetail::where('serial_number', '=', strtoupper($request->dsp_serial))->first();

        $details = new DisposalDetail;

        if($checkItem) {
            session()->flash('error','New item already archived!');
            return back();
        } else {
            $details->disposal_archive_id = $id;
            $details->name = $request->dsp_name;
            $details->brand = $request->dsp_brand;
            $details->type = $request->dsp_type;
            $details->serial_number = strtoupper($request->dsp_serial);
            $details->cost = $request->dsp_cost;
            $details->purchase_date = $request->dsp_pdate;
            if(trim($request->dsp_reason) == "") {
                $details->disposal_reason = "None";
            } else {
                $details->disposal_reason = $request->dsp_reason;
            }

            $details->save();

            DisposalArchive::where('id', '=', $id)->update(['hasDetails' => 1]);

            session()->flash('success', 'New item details saved!');
            return redirect('/disposalarchive'); 
        }
    }

    public function editItemDetails($id) {
        echo DisposalDetail::where('disposal_archive_id', '=', $id)->first()->name."\n";
        echo DisposalDetail::where('disposal_archive_id', '=', $id)->first()->brand."\n";
        echo DisposalDetail::where('disposal_archive_id', '=', $id)->first()->type."\n";
        echo DisposalDetail::where('disposal_archive_id', '=', $id)->first()->serial_number."\n";
        echo DisposalDetail::where('disposal_archive_id', '=', $id)->first()->cost."\n";
        echo DisposalDetail::where('disposal_archive_id', '=', $id)->first()->purchase_date."\n";
        echo DisposalDetail::where('disposal_archive_id', '=', $id)->first()->disposal_reason;
    }

    public function updateItemDetails($id, Request $request) {
        $currentSerial = DisposalDetail::where('disposal_archive_id', '=', $id)->first()->serial_number;
        $checkItem = DisposalDetail::where('serial_number', '=', strtoupper($request->dsp_serial))->first();

        if($checkItem && $currentSerial != strtoupper($request->dsp_serial)) {
            session()->flash('error','Duplicate serial number!');
            return back();
        } else {
            $disposalReason = "";
            if(trim($request->dsp_reason) == "") {
                $disposalReason = "None";
            } else {
                $disposalReason = $request->dsp_reason;
            }

            DisposalDetail::where('disposal_archive_id', '=', $id)
            ->update(
                ['name' => $request->dsp_name,
                'brand' => $request->dsp_brand,
                'type' => $request->dsp_type,
                'serial_number' => strtoupper($request->dsp_serial),
                'cost' => $request->dsp_cost,
                'purchase_date' => $request->dsp_pdate,
                'disposal_reason' => $disposalReason]
            );

            session()->flash('success', 'Changes to details saved!');
            return redirect('/disposalarchive');
        }
    }
}
