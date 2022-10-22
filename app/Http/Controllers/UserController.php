<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Models\MaintenanceLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        $users = User::paginate(5);
        // $users = [];

        return view('pages.others.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRoles = UserRole::all();

        return view('actions.others.create_user', compact('userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkUsername = User::where('username', '=', $request->usr_username)->first(); 
        $checkEmail = User::where('email', '=', $request->usr_email)->first();

        $users = new User;

        if($checkUsername && $checkEmail) {
            session()->flash('error','User already exists!');
            return back();
        } else if($checkUsername) {
            session()->flash('error','Username already taken!');
            return back();
        } else if($checkEmail) {
            session()->flash('error','Email already taken!');
            return back();
        } else {
            if($request->hasFile('usr_image')) {
                $directory_path = 'images/profile/'.$request->usr_username.'/';
                $image = $request->file('usr_image');
                $image_path = $directory_path.$image->getClientOriginalName();

                if(!file_exists($directory_path)) {
                    mkdir($directory_path);
                }
        
                $image->move($directory_path, $image_path);
            } else {
                $image_path = 'images/profile/default.png';
            }

            $users->username = $request->usr_username;
            $users->firstname = $request->usr_firstname;
            $users->lastname = $request->usr_lastname;
            $users->email = $request->usr_email;
            $users->password = Hash::make($request->usr_password);
            $users->image = $image_path;
            $users->user_role_id = $request->usr_role;

            $users->save();

            session()->flash('success', 'User Added!');
            return redirect('/users');  
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
    public function edit(User $user)
    {
        $userRoles = UserRole::all();

        return view('actions.others.update_user', compact('user','userRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $currentUsername = User::find($user->id)->username;
        $currentEmail = User::find($user->id)->email;

        $checkUsername = User::where('username', '=', $request->usr_username)->first(); 
        $checkEmail = User::where('email', '=', $request->usr_email)->first();

        if($checkUsername && $checkEmail && 
        $currentUsername != $request->usr_username && $currentEmail != $request->usr_email) {
            session()->flash('error','User already exists!');
            return back();
        } else if($checkUsername && $currentUsername != $request->usr_username) {
            session()->flash('error','Username already taken!');
            return back();
        } else if($checkEmail && $currentEmail != $request->usr_email) {
            session()->flash('error','Email already taken!');
            return back();
        } else {
            $oldImage = User::find($user->id)->image;        
            
            if($request->hasFile('usr_image')) {
                if($oldImage != 'images/profile/default.png') {
                    if(file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
                
                $directory_path = 'images/profile/'.$request->usr_username.'/';
                $image = $request->file('usr_image');
                $image_path = $directory_path.$image->getClientOriginalName();

                if(!file_exists($directory_path)) {
                    mkdir($directory_path);
                }
        
                $image->move($directory_path, $image_path);
            } else {
                $image_path = $oldImage;
            }

            $user->username = $request->usr_username;
            $user->firstname = $request->usr_firstname;
            $user->lastname = $request->usr_lastname;
            $user->email = $request->usr_email;
            $user->password = Hash::make($request->usr_password);
            $user->image = $image_path;
            $user->user_role_id = $request->usr_role;

            $user->save();

            session()->flash('success', 'User Updated!');
            return redirect('/users'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $user->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        session()->flash('error','User has been deactivated!');
        return redirect('/users/deactivated');
    }

    public function showDeactivatedUsers() {
        $users = User::onlyTrashed()->paginate(5);
        
        return view('pages.others.deactivated_users', compact('users'));
    }

    public function restore($id) {
        User::onlyTrashed()->find($id)->restore();

        session()->flash('success','User has been restored!');
        return redirect('/users');
    }

    public function permanentDelete($id) {
        // remove these codes if you want the user's profile picture to be used upon account restoration
        $accountImage = User::onlyTrashed()->find($id)->image;
        $accountUsername = User::onlyTrashed()->find($id)->username;

        if($accountImage != 'images/profile/default.png') {
            if(file_exists($accountImage)){
                unlink($accountImage);
            }
        }

        $directory_path = 'images/profile/'.$accountUsername.'/';
        if(file_exists($directory_path)){
            rmdir($directory_path);
        }
        //
        
        User::onlyTrashed()->find($id)->forceDelete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT=1;');

        session()->flash('error','User has been permnanently deleted!');
        return redirect('/users/deactivated/');
    }
}
