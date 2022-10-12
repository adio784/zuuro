<?php

namespace App\Helpers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;


class EndPoints {
    public static $BASE_URL = 'https://api.dingconnect.com'; // API URL
}  


class AccountController extends Controller
{
    //
    // login auth construstor
    public function __Construct(){
        // $this->middleware(['isLogged']);
    }

    // GETTING REQUEST TO THE API CALLS
    public static function getToken(){
        $client = new Client();
        $token = $client->request('POST', 'https://idp.ding.com/connect/token', [
            'form_params' => [
                'client_id'=> '919c366c-4645-46f8-80cc-35c77040014b',
                'client_secret' => '71apN0bg3CXO7ACVWe9mjjaibZu6sd4uC0VA2rH10GI=',
                'grant_type' => 'client_credentials'
            ],
            'headers' => [
                'key' => 'Content-Type',
                'value' => 'application/json'
            ]

        ]);
        $tokenResponse = json_decode($token->getBody(), true);
        return $tokenResponse['access_token'];
    }

    // Get DingConnect Account
    public function dingconnect_record(){ 
        $client = new Client();
        $response =  $client->request('GET','https://api.dingconnect.com/api/V1/GetBalance', [
                'headers' => [
                    'Accept: application/json',
                    'Authorization' => 'Bearer '. $this->getToken()
                ],
            ]);
        $dingAccount = json_decode($response->getBody()->getContents(), true);
        
        $today = NOW();
        $data = [
            'TotalLoan' => DB::table('loan_record')->where('status', 0)->sum('loan_amount'),
            'DueLoan' => DB::table('transactions')->where('TransactionType', 1)->sum('SendValue'),
            'TotalPaid' => DB::table('transactions')->where('TransactionType', 1)->sum('CommissionApplied'),
            'Ding' => $dingAccount
        ];
        return view('app.admin.dingconnect_record', $data);
    }

    public function admin_dashboard(){
        $client = new Client();
        $response =  $client->request('GET','https://api.dingconnect.com/api/V1/GetBalance', [
                'headers' => [
                    'Accept: application/json',
                    'Authorization' => 'Bearer '. $this->getToken()
                ],
            ]);
        $dingAccount = json_decode($response->getBody()->getContents(), true);
        $data = [
            'DingAccount' => $dingAccount,
            
        ];
        return view('app.admin.admin_dashboard', $data);
    }
}
