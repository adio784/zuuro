<?php

namespace App\Helpers;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Paystack;// Paystack package
use Auth;
use App\Student; // Student Model
use App\Payment; // Payment Model
use App\User; // User model

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class StripeAccountController extends Controller
{
    // login auth construstor
    public function __Construct(){
        $this->middleware(['isLogged']);
    }

    public static function token(){
        return "sk_test_17cfff997f0293b3ae8c0e5164e32b06c03c1f75";
    } 
    public static function flutterToken(){
        return "FLWSECK_TEST-b4d2f626639fadc77e5187e428352e2b-X"; //"FLWSECK_TEST-417a6e218031dae18d5628489a9dcd49-X";
    }
    // Get token functions
    public function getToken(){
        $token = "sk_test_17cfff997f0293b3ae8c0e5164e32b06c03c1f75";
        return $token;
    }

    // creating checkout function
    public function create_checkout_session(Request $request){
        $request->validate([
            'pay_amount' => 'required'
        ]);
        $uemail = Auth::user()->email;
        $client = new \GuzzleHttp\Client(['cookies' => true]);
            $jar = new \GuzzleHttp\Cookie\CookieJar;
            $r = $client->request('GET', 'http://httpbin.org/cookies', [
                'cookies' => $jar
            ]);
        try{
            $response = $client->request('POST', 'https://api.paystack.co/transaction/initialize', [
                'json' => [
                    'amount'=> $request->pay_amount,
                    'email'=> $uemail
                ],
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '. $this->getToken()
                    ],
                    'http_errors' => false,

            ]);
        $paymentResponse = json_decode($response->getBody()->getContents(), true);
        // return $paymentResponse['data']['authorization_url'];
        if($paymentResponse['status'] == 1){
            $authorization_url = $paymentResponse['data']['authorization_url'];
            $dataaccess_code = $paymentResponse['data']['access_code'];
            $datareference = $paymentResponse['data']['reference'];
            $dataamount = $request->amount;
            $dataemail = $uemail;
            return redirect($authorization_url);
        }else{
            return back()->with('fail', 'Invalid amount, min amount is 1000');
        }
            // return Paystack::getAuthorizationUrl()->redirectNow();
            // {"status":true,
            //     "message":"Authorization URL created",
            //     "data":{"
            //         authorization_url":"https:\/\/checkout.paystack.com\/1vu1omkia4v2bla",
            //         "access_code":"1vu1omkia4v2bla",
            //         "reference":"u951fdwss7"}
            // }
        }catch(ClientException $e) {
            return back()->with('fail', 'Temporary Server Error, please try later !!!');
        } 


        // creating checkout function ends here
    }

    public static function verifyPayment($reference, Request $request){
        // return $id;
        $uid = Auth::user()->id;
        $client = new \GuzzleHttp\Client(['cookies' => true]);
        $jar = new \GuzzleHttp\Cookie\CookieJar;
        $r = $client->request('GET', 'http://httpbin.org/cookies', [
            'cookies' => $jar
        ]);
        $request = $client->request('GET', 'https://api.paystack.co/transaction/verify/'.$reference, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '. self::token()
                ],
                'http_errors' => false,

        ]);
        $response = json_decode($request->getBody()->getContents(), true);
        // $response = $request->getBody()->getContents(); 
       
        if($response['status'] == 1){
            $query = DB::table('payments')->insert([
                'user_id' => $uid,
                'amount' => $response['data']['amount']/100,
                'currency' => $response['data']['currency'],
                'payment_id' => $response['data']['id'],
                'reference' => $response['data']['reference'],
                'message' => $response['message']
            ]);
           
            if($query){
                $newAmount = $response['data']['amount']/100;
                $user_id = $uid;

                $update_balance = DB::table('wallet_balance')
                                ->where('user_id', $user_id)
                                ->increment('user_balance', $newAmount);

                $notification = DB::table('notifications')
                                ->insert([
                                    'user_id'=> $uid,
                                    'message' => 'Account funded with the sum of '. $response['data']['amount']/100,
                                ]);

                $query_card_details = DB::table('user_card_details')->insert([
                    'user_id' => $uid,
                    'account_name' => $response['data']['authorization']['account_name'],
                    'authorization_code' => $response['data']['authorization']['authorization_code'],
                    'bank' => $response['data']['authorization']['bank'],
                    'bin' => $response['data']['authorization']['bin'],

                    'brand' => $response['data']['authorization']['brand'],
                    'card_type' => $response['data']['authorization']['card_type'],
                    'country_code' => $response['data']['authorization']['country_code'],
                    'exp_month' => $response['data']['authorization']['exp_month'],
                    'exp_year' => $response['data']['authorization']['exp_year'],
                    'last4' => $response['data']['authorization']['last4'],

                    'reusable' => $response['data']['authorization']['reusable'],
                    'signature' => $response['data']['authorization']['signature']
                ]);
                return $response;
            }else{
                return "Error occured";
            }
        }else{
            $response ="Payment could not be completed";
            return $response;
        }
    }

    // Flutterwave verify payment
    public static function verifyPaymentFlutterWave(Request $request){
        $txid = $_POST['transaction_id']; //3525613  SNK-778034308

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Content-Type: application/json",
              "Authorization: Bearer FLWSECK_TEST-b4d2f626639fadc77e5187e428352e2b-X"
            ),
          ));
          
          $response = curl_exec($curl);
          
          curl_close($curl);
          
          $result = json_decode($response);
          $newAmount = $result->data->charged_amount;
          $user_id = $uid;

        //   return $result;
          if($result->status == 'success')
          {
                $query = DB::table('payments')->insert([
                    'user_id' => $user_id,
                    'amount' => $result->data->charged_amount,
                    'currency' => $result->data->currency,
                    'payment_id' => $result->data->id,
                    'reference' => $result->data->flw_ref,
                    'message' => $result->message
                ]);
               
                if($query){
                    $update_balance = DB::table('wallet_balance')
                                    ->where('user_id', $user_id)
                                    ->increment('user_balance', $newAmount);

                    $notification = DB::table('notifications')
                                    ->insert([
                                        'user_id'=> $uid,
                                        'message' => 'Account funded with the sum of '. $result->data->charged_amount,
                                    ]);
                                    
                        $accountDetails = DB::table('user_account_details')->insert([
                            'user_id' => $user_id,
                            'originatoramount' => $newAmount,
                            'accountnumber' => $result->data->meta->originatoraccountnumber,
                            'originatorname' => $result->data->meta->originatorname,
                            'bankname' => $result->data->meta->bankname
                        ]);
                        return "Transaction Successful ...";
                }else{
                    return "Error occured";
                }
            }else{
                $response ="Payment could not be completed";
                return $response;
            }
    }

    // public function redirectToGateway(Request $request)
    // {
    //     try{
    //         return Paystack::getAuthorizationUrl()->redirectNow();
    //     }catch(\Exception $e) {
    //         return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
    //     }        
    // }

    // public function paymentGatewayCallback()
    // {
    //  //Getting authenticated user 
    //     $id = session('LoggedUserId'); //Auth::id();
    //     // Getting the specific student and his details
    //     $student = User::where('id',$id)->first();
    //     $class_id = $student->class_id;
    //     $section_id = $student->section_id; 
    //     $level_id = $student->level_id; 
    //     $student_id = $student->id; 
        
    //     $paymentDetails = Paystack::getPaymentData(); //this comes with all the data needed to process the transaction
    //     // Getting the value via an array method
    //     $inv_id = $paymentDetails['data']['metadata']['invoiceId'];// Getting InvoiceId I passed from the form
    //     $status = $paymentDetails['data']['status']; // Getting the status of the transaction
    //     $amount = $paymentDetails['data']['amount']; //Getting the Amount
    //     $number = $randnum = rand(1111111111,9999999999);// this one is specific to application
    //     $number = 'year'.$number;
    //     // dd($status);
    //     if($status == "success"){ //Checking to Ensure the transaction was succesful
          
    //         Payment::create(['student_id' => $student_id,'invoice_id'=>$inv_id,'amount'=>$amount,'status'=>1]); // Storing the payment in the database
    //         Student::where('user_id', $id)
    //               ->update(['register_no' => $number,'acceptance_status' => 1]);
                  
    //         return view('student.studentFees'); 
    //     }


    // }
    // Class ends here 
}



// {status: true, 
//     message: 'Verification successful', 
//     data: {id: 1899378307, 
//         domain: 'test', 
//         status: 'success', 
//         reference: '12973609', 
//         amount: 235600, …}
//     message: "Verification successful"
//     status: true
// }
