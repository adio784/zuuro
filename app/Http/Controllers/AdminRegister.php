<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminRegister extends Controller
{
    //
    // public function __construct(){
    //     $this->middleware(['auth']);
    // }
    public function __Construct(){
        $this->middleware(['isLoggedAdmin']);
    }

    public function admin_register(){
        return view('app.admin.admin_register');
    }

    public function register(Request $request){
        $request->validate([
            'fullname' => 'required|max:255',
            'email'    => 'required|email|unique:users|max:255',
            'number'=> 'required|max:11',
            'username' => 'required|max:255',
            'password' => 'required|confirmed'
        ]);

        $user = DB::table('users')->create([
            'name'    => $request->fullname,
            'email'   => $request->email,
            'telephone' => $request->number,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'dob'       => '',
            'zipcode'   => '',
            'country'   => 'Nigeria',
            'picture'   => 'assets/img/avatars/usr-img.png'
        ]);

        if($user){
            $act = DB::table('activity')
                    ->insert([
                        'username' => $request->fullname,
                        'report'   => 'just registered as an admin'
                    ]);
            return redirect('admin_login')->with('success', 'Registration Completed, login to continue ');
        }else{
            return back()->with('fail', 'Error occur during registration ');
        }
      
    }
}
