<?php

namespace App\Helpers;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Hash;

class EndPoints {
    public static $BASE_URL = 'https://api.dingconnect.com'; // API URL
}  

class SmeIfyEndPoints {
    public static $BASE_URL = 'https://api.smeify.com'; // API URL
}  

class ApiRequestController extends Controller
{

    // login auth construstor
    public function __Construct(){
        $this->middleware(['isLogged']);
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

    // GETTING REQUEST TO THE SMEIFY API CALLS
    public static function getSmeIfyToken(){
        $client = new Client();
        $token = $client->request('POST', 'https://api.smeify.com/api/v2/auth', [
            'form_params' => [
                'identity'=> 'adioridwan',
                'password' => 'Pradiology784'
            ],
            'headers' => [
                'key' => 'Content-Type',
                'value' => 'application/json'
            ]

        ]);
        $tokenResponse = json_decode($token->getBody(), true);
        return $tokenResponse['token'];
    }


    // Get Data Product By Mobile Number
    public function getProductByPhone($id){ 
        $client = new Client();
        $ph_number = $id;
        $response =  $client->request('GET','https://api.dingconnect.com/api/V1/GetProducts?benefits=data&accountNumber='.$id, [
                'headers' => [
                    'Accept: application/json',
                    'Authorization' => 'Bearer '. $this->getToken()
                ],
            ]);
        $productResponse = json_decode($response->getBody()->getContents(), true);
        return $productResponse['Items'];
    }

    // get Airtime Product By Phone
    public function getAirtimeProductByPhone($id){
        $client = new Client();
        $response =  $client->request('GET','https://api.dingconnect.com/api/V1/GetProducts?benefits=mobile&accountNumber='.$id, [
                'headers' => [
                    'Accept: application/json',
                    'Authorization' => 'Bearer '. $this->getToken()
                ],
            ]);
            $countryResponse = json_decode($response->getBody()->getContents(), true);
            return $countryResponse['Items'];
    }

    // , ['Products'=>$product['Items']]

    // Send data Transfer
    public function sendDataTransfer(Request $request){
        // dd($request->network_operator);
        $uid = Auth::user()->id;
        $user = User::where('id', '=', $uid)->first();
        if($user->email_verified_at !="" && $user->isVerified == 1){
          if(Hash::check($request->pin, $user->create_pin)){
                if($request->top_up == 2){
                    $request->validate([
                        'top_up' => 'required',
                        'country' => 'required',
                        'phoneNumber' => 'required',
                        'network_operator' => 'required',
                        'data_plan' => 'required',
                        'loan_term' => 'required'
                    ]);
                }else{
                    $request->validate([
                        'top_up' => 'required',
                        'country' => 'required',
                        'phoneNumber' => 'required',
                        'network_operator' => 'required',
                        'data_plan' => 'required'
                    ]);
                }
            
                if($request->top_up == 1 && $request->country == 'NG'){
                        $req_Account = DB::table('wallet_balance')->where('user_id', $uid)->first();
                        $req_bal = $req_Account->user_balance;
                    if($req_bal < $request->data_plan){
                            return back()->with('fail', ' Insufficient Fund ');
                    }else{
                            $chk_loan = DB::table('loan_record')
                                        ->where('user_id', $uid)
                                        ->where('loan_amount', '>', 0)->first();
                            if($chk_loan){
                                return back()->with('fail', ' We could not process your loan, you have an outstanding loan');
                            } else{
                                try {
                                    $reffrence = 'tranx'.rand();

                                    // NETWORK Operator convertion back to SMEIFY format >>>>>>>>>>>>>>>>>>>>>>>>
                                    if($request->network_operator=='MTNG'){ $network = 'MTN'; }
                                    elseif($request->network_operator=='GLNG'){ $network = 'GLO'; }
                                    elseif($request->network_operator=='ETNG'){ $network = '9MOBILE'; }
                                    elseif($request->network_operator=='ZANG'){ $network = 'AIRTEL'; }
                                    else{ $network = ''; }
                                    // NETWORK Operator convertion back to SMEIFY format ands here >>>>>>>>>>>>>>>>

                                    $client = new Client();
                
                                    $client = new \GuzzleHttp\Client(['cookies' => true]);
                                    $jar = new \GuzzleHttp\Cookie\CookieJar;
                                    $r = $client->request('GET', 'http://httpbin.org/cookies', [
                                        'cookies' => $jar
                                    ]);
                                    $response = $client->request('POST', 'https://api.smeify.com/api/v2/data', [
                                        'json' => [
                                            'plan'=> $request->SkuCode,
                                            'phones'=> $request->phoneNumber,
                                        ],
                                        'headers' => [
                                            'Content-Type' => 'application/json',
                                            'Authorization' => 'Bearer '. $this->getSmeIfyToken()
                                            ],
                                            'http_errors' => false,
                                
                                    ]);
                                    $dataResponse = json_decode($response->getBody()->getContents(), true);
                                    //  return $response->getBody();
                                    if($dataResponse['status'] == true){
                                        foreach ($dataResponse['data'] as $item) {
                                            // echo $item['amount'];
                                            $query = DB::table('transactions')->insert([
                                                'user_id' => $uid,
                                                'DistributorRef' => $reffrence,
                                                'TransferRef' => $item['reference'],
                                                'TransactionType' => $request->top_up,
                                                'Price' => $item['amount'],
                                                'ReceiveValue' => $item['amount'],
                                                'ProcessingState' => $item['status'],
                                                'ProviderCode' => $item['network'],
                                                'DataPlan'=> $item['plan'],
                                                'AccountNumber' => $item['phone'],

                                                'CustomerFee' => $request->data_plan,
                                                'DistributorFee' => 0,
                                                'ReceiveCurrencyIso' => '#',
                                                'ReceiveValueExcludingTax' => 0,
                                                'TaxRate' => 0,
                                                'SendValue' => $request->data_plan,
                                                'SendCurrencyIso' => '#',

                                                'SkuCode' => $dataResponse['TransferRecord']['SkuCode'],
                                                'RepaymentDay' => $request->loan_term,
                                                'Topup'=> 'Data',
                                                'ProviderCode' => $request->network_operator,
                                                'CommissionApplied' => '',
                                                'StartedUtc' => '',
                                                'CompletedUtc' => NOW(),
                                            ]);


                                        }
                                        $netName = DB::table('network_providers')
                                                ->where('ProviderCode', $request->network_operator)
                                                ->first();
                                        $networkOperator = $netName->Name;
                                        $nwkDetail = array(
                                            'nwkName' => $networkOperator,
                                            'dataPlan'=> $request->data_plan,
                                            'Price' => $request->data_price,
                                            'topup' => $request->top_up,
                                            'transTopup' => 'Data'
                                            );
                                        if($query){
                                            
                                            $notification = DB::table('notifications')
                                                        ->insert([
                                                            'user_id'=> $uid,
                                                            'message' => 'Successfully loan '. $request->data_plan .'to :'. $request->phoneNumber .'to be paid back :'. $dueDate,
                                                        ]);

                                            return view('app.user.loan_airtime_receipt', compact('nwkDetail'), ['receiptRespose' => $dataResponse['TransferRecord']] );
                                            // ['receiptRespose'=>$countryResponse['Items']];
                                            // return back()->with('success', 'Data Purchase successfully');
                                        }else{
                                            return back()->with('fail', ' We could not process your quest, please try later ');
                                        }
                                        
                                    }else{
                                        return back()->with('fail', 'Temporary Server Error, please try later !!!');
                                    }
                                    // return $countryResponse['ProcessingState'];
                                    
                                } catch (ClientException $e) {
                                    return Psr7\Message::toString($e->getRequest());
                                    return Psr7\Message::toString($e->getResponse());
                                }
                            }    
                    }
                }
                elseif($request->top_up == 2 && $request->country == 'NG')
                {

                    $req_Account = DB::table('wallet_balance')->where('user_id', $uid)->first();
                    $req_bal = $req_Account->user_balance;
                    if($req_bal >= $request->sendValue){
                            return back()->with('fail', ' We could not process your loan, your balance is still higher');
                    }else{
                            $chk_loan = DB::table('loan_record')
                                        ->where('user_id', $uid)
                                        ->where('loan_amount', '>', 0)->first();
                            if($chk_loan){
                                return back()->with('fail', ' We could not process your loan, you have an outstanding loan');
                            } else{
                                try {
                                    $reffrence = 'tranx'.rand();
                    
                                    // NETWORK Operator convertion back to SMEIFY format >>>>>>>>>>>>>>>>>>>>>>>>
                                    if($request->network_operator=='MTNG'){ $network = 'MTN'; }
                                    elseif($request->network_operator=='GLNG'){ $network = 'GLO'; }
                                    elseif($request->network_operator=='ETNG'){ $network = '9MOBILE'; }
                                    elseif($request->network_operator=='ZANG'){ $network = 'AIRTEL'; }
                                    else{ $network = ''; }
                                    // NETWORK Operator convertion back to SMEIFY format ands here >>>>>>>>>>>>>>>>
                    
                                    $client = new Client();
                    
                                    $client = new \GuzzleHttp\Client(['cookies' => true]);
                                    $jar = new \GuzzleHttp\Cookie\CookieJar;
                                    $r = $client->request('GET', 'http://httpbin.org/cookies', [
                                        'cookies' => $jar
                                    ]);
                                    $response = $client->request('POST', 'https://api.smeify.com/api/v2/data', [
                                        'json' => [
                                            'plan'=> $request->data_plan,
                                            'phones'=> $request->phoneNumber,
                                        ],
                                        'headers' => [
                                            'Content-Type' => 'application/json',
                                            'Authorization' => 'Bearer '. $this->getToken()
                                            ],
                                            'http_errors' => false,
                                
                                    ]);
                                    $dataResponse = json_decode($response->getBody()->getContents(), true);
                                    // return $dataResponse;
                                    if($dataResponse['status'] == true){
                                        foreach ($dataResponse['data'] as $item) {
                                            // echo $item['amount'];
                                            $query = DB::table('transactions')->insert([
                                                'user_id' => $uid,
                                                'DistributorRef' => $reffrence,
                                                'TransferRef' => $item['reference'],
                                                'TransactionType' => $request->top_up,
                                                'Price' => $item['amount'],
                                                'ReceiveValue' => $item['amount'],
                                                'ProcessingState' => $item['status'],
                                                'ProviderCode' => $item['network'],
                                                'DataPlan'=> $item['plan'],
                                                'AccountNumber' => $item['phone'],
                    
                                                'CustomerFee' => $request->data_plan,
                                                'DistributorFee' => 0,
                                                'ReceiveCurrencyIso' => '#',
                                                'ReceiveValueExcludingTax' => 0,
                                                'TaxRate' => 0,
                                                'SendValue' => $request->data_plan,
                                                'SendCurrencyIso' => '#',
                    
                                                'SkuCode' => $dataResponse['TransferRecord']['SkuCode'],
                                                'RepaymentDay' => $request->loan_term,
                                                'Topup'=> 'Data',
                                                'ProviderCode' => $request->network_operator,
                                                'CommissionApplied' => '',
                                                'StartedUtc' => '',
                                                'CompletedUtc' => NOW(),
                                            ]);
                    
                    
                                        }
                                        $netName = DB::table('network_providers')
                                                ->where('ProviderCode', $request->network_operator)
                                                ->first();
                                        $networkOperator = $netName->Name;
                                        $nwkDetail = array(
                                            'nwkName' => $networkOperator,
                                            'dataPlan'=> $request->data_plan,
                                            'Price' => $request->data_price,
                                            'topup' => $request->top_up,
                                            'transTopup' => 'Data'
                                            );
                                        if($query){
                                            $item_repayment = date('Y-m-d');
                                            $dueDate = date('Y-m-d', strtotime($item_repayment. '+ ' . $request->loan_term.' days'));
                                            $query_loan_record = DB::table('loan_record')->insert([
                                                'user_id'=> $uid,
                                                'referrence_id'=> $reffrence,
                                                'loan_amount'  => $request->data_price,
                                                'repayment'    => $dueDate,
                                                'status'       => 1
                                            ]);
                    
                                            $notification = DB::table('notifications')
                                                        ->insert([
                                                            'user_id'=> $uid,
                                                            'message' => 'Successfully loan '. $request->data_plan .'to :'. $request->phoneNumber .'to be paid back :'. $dueDate,
                                                        ]);
                    
                                            return view('app.user.loan_airtime_receipt', compact('nwkDetail'), ['receiptRespose' => $dataResponse['TransferRecord']] );
                                            // ['receiptRespose'=>$countryResponse['Items']];
                                            // return back()->with('success', 'Data Purchase successfully');
                                        }else{
                                            return back()->with('fail', ' We could not process your quest, please try later ');
                                        }
                                        
                                    }else{
                                        return back()->with('fail', 'Temporary Server Error, please try later !!!');
                                    }
                                    // return $countryResponse['ProcessingState'];
                                    
                                } catch (ClientException $e) {
                                    return Psr7\Message::toString($e->getRequest());
                                    return Psr7\Message::toString($e->getResponse());
                                }
                            }    
                    }

                
                }
            else{
                $req_Account_process = DB::table('wallet_balance')->where('user_id', $uid)->first();
                $req_bal_process = $req_Account_process->user_balance;
                if($req_bal_process < $request->sendValue){
                    return back()->with('fail', ' Insufficient fund');
                }else{  
                    $new_bal_process = $req_bal_process - $request->sendValue;
                    $update_bal_process = DB::table('wallet_balance')
                                ->where('user_id', $uid)
                                ->update([
                                    'user_balance' => $new_bal_process 
                                ]);
                                try {
                                    $client = new \GuzzleHttp\Client(['cookies' => true]);
                                    $jar = new \GuzzleHttp\Cookie\CookieJar;
                                    $r = $client->request('GET', 'http://httpbin.org/cookies', [
                                        'cookies' => $jar
                                    ]);
                                    $response = $client->request('POST', 'https://api.dingconnect.com/api/V1/SendTransfer', [
                                        'json' => [
                                            'SkuCode'=> $request->SkuCode,
                                            'SendValue'=> $request->sendValue,
                                            'SendCurrencyIso'=> $request->SendCurrencyIso,
                                            'AccountNumber'=> $request->phoneNumber, 
                                            'DistributorRef'=> $request->DistributorRef,
                                            'ValidateOnly'=> false,
                                            'RegionCode' => $request->network_operator
                                        ],
                                        'headers' => [
                                            'Content-Type' => 'application/json',
                                            'Authorization' => 'Bearer '. $this->getToken()
                                            ],
                                            'http_errors' => false,
                                
                                ]);
                                    $dataResponse = json_decode($response->getBody()->getContents(), true);
                                    // return $dataResponse;
                                    if($dataResponse['ResultCode'] ==1){
                                        $query = DB::table('transactions')->insert([
                                            'user_id' => $uid,
                                            'TransferRef' => $dataResponse['TransferRecord']['TransferId']['TransferRef'],
                                            'DistributorRef' => $dataResponse['TransferRecord']['TransferId']['DistributorRef'],
                                            'SkuCode' => $dataResponse['TransferRecord']['SkuCode'],
                                            'Price' => $dataResponse['TransferRecord']['Price']['ReceiveValue'],
                                            'TransactionType' => $request->top_up,
                                            'RepaymentDay' => $request->loan_term,
                                            'Topup'=> 'Data',
                                            'ProviderCode' => $request->network_operator,
                                            'DataPlan'=> $request->DefaultDisplayText,
                                
                                            'CustomerFee' => $dataResponse['TransferRecord']['Price']['CustomerFee'],
                                            'DistributorFee' => $dataResponse['TransferRecord']['Price']['DistributorFee'],
                                
                                            'ReceiveValue' => $dataResponse['TransferRecord']['Price']['ReceiveValue'],
                                            'ReceiveCurrencyIso' => $dataResponse['TransferRecord']['Price']['ReceiveCurrencyIso'],
                                            'ReceiveValueExcludingTax' => $dataResponse['TransferRecord']['Price']['ReceiveValueExcludingTax'],
                                            'TaxRate' => $dataResponse['TransferRecord']['Price']['TaxRate'],
                                            'SendValue' => $dataResponse['TransferRecord']['Price']['SendValue'],
                                            'SendCurrencyIso' => $dataResponse['TransferRecord']['Price']['SendCurrencyIso'],
                                
                                            'CommissionApplied' => $dataResponse['TransferRecord']['CommissionApplied'],
                                            'StartedUtc' => $dataResponse['TransferRecord']['StartedUtc'],
                                            'CompletedUtc' => $dataResponse['TransferRecord']['CompletedUtc'],
                                            'ProcessingState' => $dataResponse['TransferRecord']['ProcessingState'],
                                            'AccountNumber' => $dataResponse['TransferRecord']['AccountNumber'],
                                        ]);
                                        $notification = DB::table('notifications')
                                                    ->insert([
                                                        'user_id'=> $uid,
                                                        'message' => 'Data purchase of:'. $dataResponse['TransferRecord']['Price']['ReceiveValue'] .'Successfully sent to :'. $dataResponse['TransferRecord']['AccountNumber']
                                                    ]);

                                        $netName = DB::table('network_providers')
                                                ->where('ProviderCode', $request->network_operator)
                                                ->first();
                                        $networkOperator = $netName->Name;
                                        $nwkDetail = array(
                                            'nwkName' => $networkOperator,
                                            'dataPlan'=> $request->DefaultDisplayText,
                                            'topup' => $request->top_up,
                                            'transTopup' => 'Data'
                                            );
                                        if($query){
                                            return view('app.user.loan_airtime_receipt', compact('nwkDetail'), ['receiptRespose' => $dataResponse['TransferRecord']] );
                                            // ['receiptRespose'=>$countryResponse['Items']];
                                            // return back()->with('success', 'Data Purchase successfully');
                                        }else{
                                            return back()->with('fail', ' We could not process your quest, please try later ');
                                        }
                                        
                                    }else{
                                        // return user balance

                                        $update_bal_process = DB::table('wallet_balance')
                                                    ->where('user_id', $uid)
                                                    ->update([
                                                            'user_balance' => $req_bal_process 
                                                        ]);
                                        return back()->with('fail', 'Temporary Server Error, please try later !!!');
                                    }
                                    // return $countryResponse['ProcessingState'];
                                    
                                } catch (ClientException $e) {
                                    return Psr7\Message::toString($e->getRequest());
                                    return Psr7\Message::toString($e->getResponse());
                                }
                    }
                }
            }
        else{
                return back()->with('fail', 'Incorrect PIN');
            }
        }else{
            return back()->with('fail', 'Verify mobile and try later !!!');
        }
        

    }    

        







}
