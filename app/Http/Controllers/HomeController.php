<?php

namespace App\Helpers;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\Log;
use Illuminate\Support\Facades\Http;
// use GuzzleHttp\Client;
// use GuzzleHttp\Exception\RequestException;
// use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['isLogged', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array(
            'Account' => DB::table('wallet_balance')->where('user_id', Auth::user()->id)->first(),
            'Card' => DB::table('user_card_details')
                      ->where('user_id', Auth::user()->id)
                      ->limit(3)->get(),
                    //   ->groupBy('account_name')->get(),
            'UserD' => DB::table('users')
                       ->where('id', Auth::user()->id)->first(),
            'TotalFund' => DB::table('payments')->where('user_id', Auth::user()->id)->get(),
            'TotalSpend' => DB::table('transactions')
                            ->where('user_id', Auth::user()->id)
                            ->where('TransactionType', 1)
                            ->orderBy('id', 'DESC')->get(),
            'CardCount'=> DB::table('user_card_details')
                           ->where('user_id', Auth::user()->id)
                           ->count('id')
            
        );
        return view('home', $data);
    }

    public function mobile()
    {
        return view('auth.mobile');
    }

    public function verify_index(){
        return view('auth.input_verifymobile');
    }
    

    public function transaction_pin()
    {
        return view('app.user.transaction_pin');
    }

    public function create_pin(Request $request)
    {
        $request->validate([
            'pin' => ['required', 'string', 'max:4', 'confirmed'],
        ]);

        $sql = User::where('id', '=', Auth::user()->id)->first();

        if($sql->create_pin != "")
        {   
            $pin = User::where('id', Auth::user()->id)
                    ->update([
                        'create_pin' => Hash::make($request['pin']),
                    ]);
            return back()->with('success', 'PIN successfully updated');
        }else{
            $pin = User::where('id', Auth::user()->id)
                    ->update([
                        'create_pin' => Hash::make($request['pin']),
                    ]);

            if($pin){
                return back()->with('success', 'PIN successfully created');
            }else{
                return back()->with('fail', 'Error occured, try later');
            }
        }
        
    }
    

    public function addcard(Request $request){
        $request->validate([
            'bankName' => 'required',
            'cardNumber' => 'required'

        ]);
    }
    

    public function verify_mobile(Request $request){
        $data = $request->validate([
            'phone_number' => ['required', 'numeric']
        ]);

        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($request['phone_number'], "sms");

            return redirect()->route('verify_mobile')->with(['phone_number' => $data['phone_number']]);
        
    }


    protected function verify_otp(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);
        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(['code' => $data['verification_code'], 'to' => $data['phone_number']]);
        if ($verification->valid) {
            $user = tap(User::where('telephone', $data['phone_number']))->update(['isVerified' => true, 'number_verify_at'=> NOW()]);
            /* Authenticate user */
            // Auth::login($user->first());
            return redirect()->route('home')->with(['success' => 'Phone number verified']);
        }
        return back()->with(['phone_number' => $data['phone_number'], 'fail' => 'Invalid verification code entered!']);
    }




    // function to send OTP 
    public function sendOTP(Request $request){
        $otp = rand(1000, 9000);
        // Log::info(message: "otp = ". $otp);
        $user = User::where('telephone', '=', $request->phone_number)
                ->update(['otp' => $otp]);
                // Send otp to mobile no using sms api
            return response()->json([$user], status:200);
    }


    public function createservice(){
        
// QoinCo Telecommunications Nigeria Limited
        // Find your Account SID and Auth Token at twilio.com/console
        // and set the environment variables. See http://twil.io/secure
        
        // $sid = getenv("TWILIO_ACCOUNT_SID");
        // $token = getenv("TWILIO_AUTH_TOKEN");
        // $twilio = new Client($sid, $token);

        // $service = $twilio->verify->v2->services
        //                             ->create("QoinCO");

        // print($service->sid);


        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);

        $new_factor = $twilio->verify->v2->services("VA342cd486d79cd5428dc5c463093b714f")
                                        ->entities("ff483d1ff591898a9942916050d2ca3f")
                                        ->newFactors
                                        ->create("QoinCo", "totp");

        return ($new_factor->binding);


    }

}
