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

class ApiRequestAirtimeController extends Controller
{
    //// login auth construstor
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

    // Send Airtime Transfer
    public function send_airtime(Request $request){
        $uid = Auth::user()->id;
        $user = User::where('id', '=', $uid)->first();
        if($user->email_verified_at !="" && $user->isVerified == 1){
          if(Hash::check($request->pin, $user->create_pin)){
                if($request->top_up == 2){
                    $request->validate([
                        'top_up' => 'required',
                        'country_select' => 'required',
                        'mobileNumber' => 'required',
                        'network_airtime' => 'required',
                        'input_amount' => 'required',
                        'loan_term' => 'required'
                    ]);
                }else{
                    $request->validate([
                        'top_up' => 'required',
                        'country_select' => 'required',
                        'mobileNumber' => 'required',
                        'network_airtime' => 'required',
                        'input_amount' => 'required'
                    ]);
                }
       
        // Validating
            if($request->top_up == 2){
                $req_Account = DB::table('wallet_balance')->where('user_id', $uid)->first();
                $req_bal = $req_Account->user_balance;
                if($req_bal > $request->sendValue){
                    return back()->with('fail', ' We could not process your loan, your balance is still high');
                }else{
                    $chk_loan = DB::table('loan_record')
                            ->where('user_id', $uid)
                            ->where('status', 1)->first();
                    if($chk_loan){
                        return back()->with('fail', ' We could not process your loan, you have an outstanding loan');
                    } else{
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
                                        'AccountNumber'=> $request->mobileNumber, 
                                        'DistributorRef'=> $request->DistributorRef,
                                        'ValidateOnly'=> false,
                                        'RegionCode' => $request->network_airtime
                                    ],
                                    'headers' => [
                                        'Content-Type' => 'application/json',
                                        'Authorization' => 'Bearer '. $this->getToken()
                                        ],
                                        'http_errors' => false,
                
                            ]);
                            $airtimeResponse = json_decode($response->getBody()->getContents(), true);
                            if($airtimeResponse['ResultCode'] ==1){
                                $query = DB::table('transactions')->insert([
                                    'user_id' => $uid,
                                    'TransferRef' => $airtimeResponse['TransferRecord']['TransferId']['TransferRef'],
                                    'DistributorRef' => $airtimeResponse['TransferRecord']['TransferId']['DistributorRef'],
                                    'SkuCode' => $airtimeResponse['TransferRecord']['SkuCode'],
                                    'Price' => $airtimeResponse['TransferRecord']['Price']['ReceiveValue'],
                                    'TransactionType' => $request->top_up,
                                    'RepaymentDay' => $request->loan_term,
                                    'Topup'=> 'Airtime',
                                    'ProviderCode' => $request->network_airtime,
                
                                    'CustomerFee' => $airtimeResponse['TransferRecord']['Price']['CustomerFee'],
                                    'DistributorFee' => $airtimeResponse['TransferRecord']['Price']['DistributorFee'],
                                    'ReceiveValue' => $airtimeResponse['TransferRecord']['Price']['ReceiveValue'],
                                    'ReceiveCurrencyIso' => $airtimeResponse['TransferRecord']['Price']['ReceiveCurrencyIso'],
                                    'ReceiveValueExcludingTax' => $airtimeResponse['TransferRecord']['Price']['ReceiveValueExcludingTax'],
                                    'TaxRate' => $airtimeResponse['TransferRecord']['Price']['TaxRate'],
                                    'SendValue' => $airtimeResponse['TransferRecord']['Price']['SendValue'],
                                    'SendCurrencyIso' => $airtimeResponse['TransferRecord']['Price']['SendCurrencyIso'],
                
                                    'CommissionApplied' => $airtimeResponse['TransferRecord']['CommissionApplied'],
                                    'StartedUtc' => $airtimeResponse['TransferRecord']['StartedUtc'],
                                    'CompletedUtc' => $airtimeResponse['TransferRecord']['CompletedUtc'],
                                    'ProcessingState' => $airtimeResponse['TransferRecord']['ProcessingState'],
                                    'AccountNumber' => $airtimeResponse['TransferRecord']['AccountNumber'],
                                ]);
                                $netName = DB::table('network_providers')
                                        ->where('ProviderCode', $request->network_airtime)
                                        ->first();
                                $networkOperator = $netName->Name;
                                // return $networkOperator;
                                $nwkDetail = array(
                                    'nwkName' => $networkOperator,
                                    'dataPlan'=> $request->sendValue,
                                    // 'nwkName' => $request->network_airtime,
                                    'topup' => $request->top_up,
                                    'transTopup' => 'Airtime'
                                    );
                                if($query){
                                    $errCode = 400; //$airtimeResponse['ErrorCodes']['Code'];
                                    $item_repayment = date('Y-m-d');
                                    $errContext = 'ValueOutOfRange'; //$airtimeResponse['ErrorCodes']['Context'];
                                    $dueDate = date('Y-m-d', strtotime($item_repayment. '+ ' . $request->loan_term.' days'));

                                    $notification = DB::table('notifications')
                                                    ->insert([
                                                        'user_id'=> $uid,
                                                        'message' => 'Successfully loan '. $airtimeResponse['TransferRecord']['Price']['ReceiveValue'] .'to :'. $request->mobileNumber .'to be paid back :'. $dueDate,
                                                    ]);

                                    $query_loan_record = DB::table('loan_record')->insert([
                                        'user_id'=> $uid,
                                        'referrence_id' => $airtimeResponse['TransferRecord']['TransferId']['TransferRef'],
                                        'loan_amount'   => $airtimeResponse['TransferRecord']['Price']['SendValue'],
                                        'repayment' => $dueDate
                                    ]);
                                    return view('app.user.loan_airtime_receipt', compact('nwkDetail'), ['receiptRespose' => $airtimeResponse['TransferRecord']] );
                                    // ['receiptRespose'=>$countryResponse['Items']];
                                    // return back()->with('success', 'Country successfully added');
                                }else{
                                    $errCode = $airtimeResponse['ErrorCodes']['Code'];
                                    $errContext = $airtimeResponse['ErrorCodes']['Context']; //'ValueOutOfRange';
                                    return back()->with('fail', 'Error ' . $errCode .' Internal Server Error, Try later, '. $errContext . '!!!');
                                }
                                
                            }else{
                                return back()->with('fail', 'Temporary Server Error, please try later !!!');
                            }
                            return $airtimeResponse['TransferRecord'];
                            
                        } catch (ClientException $e) {
                            return Psr7\Message::toString($e->getRequest());
                            return Psr7\Message::toString($e->getResponse());
                        }
                    }
                }
            }else{
            $req_Account_process = DB::table('wallet_balance')->where('user_id', $uid)->first();
            $req_bal_process = $req_Account_process->user_balance;
            if($req_bal_process < $request->sendValue){
                return back()->with('fail', ' Insufficient fund, you can loan or topup');
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
                                        'AccountNumber'=> $request->mobileNumber, 
                                        'DistributorRef'=> $request->DistributorRef,
                                        'ValidateOnly'=> false,
                                        'RegionCode' => $request->network_airtime
                                    ],
                                    'headers' => [
                                        'Content-Type' => 'application/json',
                                        'Authorization' => 'Bearer '. $this->getToken()
                                        ],
                                        'http_errors' => false,
                
                            ]);
                            $airtimeResponse = json_decode($response->getBody()->getContents(), true);
                            if($airtimeResponse['ResultCode'] ==1){
                                $query = DB::table('transactions')->insert([
                                    'user_id' => $uid,
                                    'TransferRef' => $airtimeResponse['TransferRecord']['TransferId']['TransferRef'],
                                    'DistributorRef' => $airtimeResponse['TransferRecord']['TransferId']['DistributorRef'],
                                    'SkuCode' => $airtimeResponse['TransferRecord']['SkuCode'],
                                    'Price' => $airtimeResponse['TransferRecord']['Price']['ReceiveValue'],
                                    'TransactionType' => $request->top_up,
                                    'RepaymentDay' => $request->loan_term,
                                    'Topup'=> 'Airtime',
                                    'ProviderCode' => $request->network_airtime,
                
                                    'CustomerFee' => $airtimeResponse['TransferRecord']['Price']['CustomerFee'],
                                    'DistributorFee' => $airtimeResponse['TransferRecord']['Price']['DistributorFee'],
                                    'ReceiveValue' => $airtimeResponse['TransferRecord']['Price']['ReceiveValue'],
                                    'ReceiveCurrencyIso' => $airtimeResponse['TransferRecord']['Price']['ReceiveCurrencyIso'],
                                    'ReceiveValueExcludingTax' => $airtimeResponse['TransferRecord']['Price']['ReceiveValueExcludingTax'],
                                    'TaxRate' => $airtimeResponse['TransferRecord']['Price']['TaxRate'],
                                    'SendValue' => $airtimeResponse['TransferRecord']['Price']['SendValue'],
                                    'SendCurrencyIso' => $airtimeResponse['TransferRecord']['Price']['SendCurrencyIso'],
                
                                    'CommissionApplied' => $airtimeResponse['TransferRecord']['CommissionApplied'],
                                    'StartedUtc' => $airtimeResponse['TransferRecord']['StartedUtc'],
                                    'CompletedUtc' => $airtimeResponse['TransferRecord']['CompletedUtc'],
                                    'ProcessingState' => $airtimeResponse['TransferRecord']['ProcessingState'],
                                    'AccountNumber' => $airtimeResponse['TransferRecord']['AccountNumber'],
                                ]);
                                $notification = DB::table('notifications')
                                                    ->insert([
                                                        'user_id'=> $uid,
                                                        'message' => 'Purchase of: '. $airtimeResponse['TransferRecord']['Price']['ReceiveValue'] .'Successfully sent to :'. $request->mobileNumber
                                                    ]);
                                $netName = DB::table('network_providers')
                                            ->where('ProviderCode', $request->network_airtime)
                                            ->first();
                                $networkOperator = $netName->Name;
                                // return $networkOperator;
                                $nwkDetail = array(
                                    'nwkName' => $networkOperator,
                                    'dataPlan'=> $request->sendValue,
                                    // 'nwkName' => $request->network_airtime,
                                    'topup' => $request->top_up,
                                    'transTopup' => 'Airtime'
                                    );
                                if($query){
                                    $errCode = 400; //$airtimeResponse['ErrorCodes']['Code'];
                                    $errContext = 'ValueOutOfRange'; //$airtimeResponse['ErrorCodes']['Context'];
                                    return view('app.user.loan_airtime_receipt', compact('nwkDetail'), ['receiptRespose' => $airtimeResponse['TransferRecord']] );
                                    // ['receiptRespose'=>$countryResponse['Items']];
                                    // return back()->with('success', 'Country successfully added');
                                }else{
                                    return back()->with('fail', 'Error ' . $errCode .' Internal Server Error, Try later, '. $errContext . '!!!');
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
                            return $airtimeResponse['TransferRecord'];
                            
                        } catch (ClientException $e) {
                            return Psr7\Message::toString($e->getRequest());
                            return Psr7\Message::toString($e->getResponse());
                        }
                    }
                }
            }else{
                return back()->with('fail', 'Incorrect PIN');
            }
        }else{
            return back()->with('fail', 'Verify account and try later !!!');
        }
    }


}
