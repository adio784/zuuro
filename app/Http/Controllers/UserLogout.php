<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserLogout extends Controller
{
    //
         // Logout script
         public function logout_user(){
            // auth()->logout();

                $act = DB::table('activity')
                           ->insert([
                               'username' => Auth::user()->name,
                               'report'   => 'Logged Out'
                           ]); 
                Auth::logout(); 
               
            return redirect('login');

           
        }
    
}
