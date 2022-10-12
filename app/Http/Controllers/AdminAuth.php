<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminAuth extends Controller
{
    // public function __Construct(){
    //     $this->middleware(['AlreadyLoggedAdmin']);
    // }

    public function admin_login(){
        return view('app.admin.admin_login_page');
    }

    public function admin_register(){
        return view('app.admin.admin_register');
    }

    public function adminAuth(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('admins')
                ->where('email', '=', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('LoggedAdmin', $user->id);
                $request->session()->put('LoggedAdminRole', $user->role);
                $request->session()->put('LoggedAdminFullName', $user->name);
                $request->session()->put('LoggedAdminEmail', $user->email);
                $request->session()->put('LoggedAdminTelephone', $user->telephone);

                $act = DB::table('activity')
                       ->insert([
                           'username' => Session('LoggedAdminFullName'),
                           'report'   => 'Logged In'
                       ]);
                $act = DB::table('activity')
                       ->insert([
                           'username' => Session('LoggedAdminFullName'),
                           'report'   => 'Logged In'
                       ]);
                return redirect('admin_dashboard');
            }else{
                return back()->with('fail', 'Invalid Login Details');
            }
        }else{
            return back()->with('fail', 'No account found for this email !!!');
        }
    }
}