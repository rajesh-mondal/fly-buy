<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // admin after login
    public function admin(){
        return view('admin.home');
    }

    // admin custom logout
    public function logout(){
        Auth::logout();
        $notification = array('message' => 'You are logged out!', 'alert-type' => 'success');

        return redirect()->route('admin.login')->with($notification);
    }

    //password change
    public function passwordChange(){
        return view('admin.profile.password_change');
    }

    //password update
    public function passwordUpdate(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $current_password = Auth::User()->password; //login user password get
        $oldpass = $request->old_password;  //old password get from input field
        $new_password = $request->password; //new password get from new password
        
        // checking old password and current user password same or not
        if(Hash::check($oldpass, $current_password)){
            $user = User::findorfail(Auth::id());   //current user data get
            $user->password = Hash::make($request->password);   //current user password hashing
            $user->save();  //password save
            Auth::logout(); //logout the admin user and redirect admin login panel 

            $notification = array('message' => 'Your Password Changed!', 'alert-type' => 'success');
            return redirect()->route('admin.login')->with($notification);
        }else{
            $notification = array('message' => 'Old Password Not Matched!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
