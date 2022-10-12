<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetCountryIso extends Controller
{
    //
    // getPhoneCodeIso
    public function getPhoneCodeIsoregister($id){
        $operator_code = DB::table('countries')
                    ->where('name', $id)
                    ->get();

        return response()->json([
            'PhoneCode' => $operator_code
        ]);
    }
}
