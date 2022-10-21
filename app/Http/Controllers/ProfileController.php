<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        // $mcount = MaintenanceLog::all();
        // session(['maintenancecount' => count($mcount)]);

        // $dcount = DisposalArchive::all();
        // session(['disposalcount' => count($dcount)]);
        
        return view('pages.profile');
    }

    public function updateImage($id, Request $request) {        
        // $oldImage = User::find($id)->image;        
        // if($oldImage != 'images/profile/default.png') {
        //     if(file_exists($oldImage)) {
        //         unlink($oldImage);
        //     }
        // }

        // $directory_path = 'images/profile/'.$request->prf_currentuser.'/';
        // $image = $request->file('prf_image');
        // $image_path = $directory_path.$image->getClientOriginalName();

        // if(!file_exists($directory_path)) {
        //     mkdir($directory_path);
        // }

        // $image->move($directory_path, $image_path);

        // User::where('id', '=', $id)->update(['image' => $image_path]);

        // return redirect('/profile');
    }

    public function updateUser($id, Request $request) {
        // $currentUsername = User::find($id)->username;
        // $currentEmail = User::find($id)->email;

        // $checkUsername = User::where('username', '=', $request->prf_username)->first(); 
        // $checkEmail = User::where('email', '=', $request->prf_email)->first();

        // if($checkUsername && $checkEmail && 
        // $currentUsername != $request->prf_username && $currentEmail != $request->prf_email) {
        //     session()->flash('error','User already exists!');
        //     return back();
        // } else if($checkUsername && $currentUsername != $request->prf_username) {
        //     session()->flash('error','Username already taken!');
        //     return back();
        // } else if($checkEmail && $currentEmail != $request->prf_email) {
        //     session()->flash('error','Email already taken!');
        //     return back();
        // } else {
        //     User::where('id', '=', $id)->update(['username' => $request->prf_username,
        //     'firstname' => $request->prf_firstname,
        //     'lastname' => $request->prf_lastname,
        //     'email' => $request->prf_email,
        //     ]);

        //     session()->flash('success', 'User details successfully updated!');
        //     return redirect('/profile');
        // }
    }

    public function updatePassword($id, Request $request) {
        // $currentPassword = User::find($id)->password;

        // if(Hash::check($request->prf_currentpass, $currentPassword)){
        //     User::where('id', '=', $id)->update(['password' => Hash::make($request->prf_newpass)]);

        //     session()->flash('success', 'Password successfully updated!');
        //     return redirect('/profile');
        // } else {
        //     session()->flash('error','Current password is incorrect!');
        //     return back();
        // } 
    }

    public function deleteAccount($id, Request $request) {
        // $verifyPassword = User::find($id)->password;
        
        // if(Hash::check($request->delacc_password, $verifyPassword)){
        //     User::where('id', '=', $id)->delete();
        //     DB::statement('ALTER TABLE users AUTO_INCREMENT=1;');

        //     return redirect('/');
        // } else {
        //     session()->flash('error','Entered password is incorrect!');
        //     return back();
        // }
    }
}
