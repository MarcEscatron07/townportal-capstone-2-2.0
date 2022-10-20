<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // $mcount = MaintenanceLog::all();
        // session(['maintenancecount' => count($mcount)]);

        // $dcount = DisposalArchive::all();
        // session(['disposalcount' => count($dcount)]);
        
        // $desktops = Desktop::paginate(5);
        $desktops = [];
        // $statuses = Status::skip(0)->take(2)->get();
        $statuses = [];

        return view('pages.general.desktops', compact('desktops','statuses'));
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
        //     Desktop::truncate();
        //     DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //     session()->flash('error','All data has been deleted!');
        //     return redirect('/desktops');
        // } else {
        //     session()->flash('error','Entered password is incorrect!');
        //     return back();
        // }
    }

    public function updateStatus(
        // MaintenanceLog $maintenance, 
        Request $request
    ) {
        // Desktop::where('id', '=',$request->desktopID)->update(['status_id' => $request->statusID]); 

        // if($request->statusID == 2){
        //     $desktopQuery = Desktop::find($request->desktopID);
        //     $desktopUnique = strtoupper($desktopQuery->serial_number);
        //     $checkData = MaintenanceLog::where('serial_number', '=', $desktopUnique)->first();

        //     if($checkData) {
        //         var_dump($checkData);
        //     } else {
        //         date_default_timezone_set('Asia/Manila');
        //         $date = date('Y/m/d H:i:s');

        //         $maintenance->assigned_computer = $desktopQuery->computer->location->row.$desktopQuery->computer->pc_number;
        //         $maintenance->name = $desktopQuery->name;
        //         $maintenance->brand = $desktopQuery->brand;
        //         $maintenance->type = Type::find(1)->name;
        //         $maintenance->serial_number = $desktopUnique;                
        //         $maintenance->logged_at = $date;
        //         $maintenance->remarks = "None";
        //         $maintenance->save();
        //     }
        // } else {
        //     $desktopQuery = Desktop::find($request->desktopID);
        //     $desktopUnique = strtoupper($desktopQuery->serial_number);

        //     MaintenanceLog::where('serial_number', '=', $desktopUnique)->delete();
        //     MaintenanceLog::onlyTrashed()->where('serial_number', '=', $desktopUnique)->first()->forceDelete();
        //     DB::statement('ALTER TABLE maintenance_logs AUTO_INCREMENT=1;');
        // }

        // $mcount = count(MaintenanceLog::all());
        // echo $mcount;
    }
}
