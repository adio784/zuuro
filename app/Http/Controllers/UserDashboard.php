<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


class UserDashboard extends Controller
{
    public function __Construct(){
        $this->middleware(['isLogged', 'verified']);
        // $this->middleware(['isLogged']);
    }

    // <<<<<<<<<<<<<<<<<< AJAX REQUESTS FROM USER PAGE >>>>>>>>>>>>>>>>>>>>..
    // getOperatorByCountry
    public function getOperatorByCountry($id){
        $operator = DB::table('network_providers')
                    ->where('CountryIso', $id)
                    ->get();

        return response()->json([
            'Operators' => $operator
        ]);
    }

    // getAirtimeOperatorByCountry
    public function getAirtimeOperatorByCountry($id){
        $operator = DB::table('network_providers')
                    ->where('CountryIso', $id)
                    ->get();

        return response()->json([
            'Operators' => $operator
        ]);
    }

    // getPhoneCodeIso
    public function getPhoneCodeIso($id){
        $operator_code = DB::table('countries')
                    ->where('iso3', $id)
                    ->get();

        return response()->json([
            'PhoneCode' => $operator_code
        ]);
    }

    // getLogoByProviderCode
    public function getLogoByProviderCode($id){
        $operator_code = DB::table('network_providers')
                    ->where('ProviderCode', $id)
                    ->get();

        return response()->json([
            'OperatorLogos' => $operator_code
        ]);
    }



// <<<<<<<<<<<<<<<<<< AJAX REQUESTS FROM USER PAGE >>>>>>>>>>>>>>>>>>>>..

    public function welcome(){
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
                            ->orderBy('id', 'DESC')->get()
            
        );
        return view('app.user.user-welcome', $data);
    }

    public function checkout_page(){
        return view('app.user.checkout_page');
    }
    public function automated_bank_transfer(){
        return view('app.user.automated_bank_transfer');
    }

    public function service(){
        return view('app.user.user-services');
    }
    public function about(){
        return view('app.user.user-about');
    }

    public function data(){

        $data = array(
            'CountryInfo' => DB::table('countries')->get(),
            'NetworkInfo' => DB::table('mobile_network_list')->get(),
            'Dataplan' => DB::table('data_pricing')->get()
        );
        return view('app.user.loan_data', $data);
    }

    public function user_notifications(){
        $data = array(
            'Notifications' => DB::table('notifications')
                                ->JOIN('users', 'users.id', '=', 'notifications.user_id')
                                ->where('notifications.user_id', '=', Auth::user()->id)
                                ->orderBy('notifications.id', 'DESC')
                                ->get()
        );
        return view('app.user.user_notifications', $data);
    }
    public function airtime(){
        $data = array(
            'CountryInfo' => DB::table('countries')->get(),
            'NetworkInfo' => DB::table('mobile_network_list')->get(),
            'Dataplan' => DB::table('data_pricing')->get()
        );
        return view('app.user.loan_airtime', $data);
    }
    public function loan_airtime_receipt(){
        return view('app.user.loan_airtime_receipt');
    }

    public function data_transaction(){
        return view('app.user.data_transaction');
    }
    public function airtime_transaction(){
        return view('app.user.airtime_transaction');
    }
    public function payment_history(){
        return view('app.user.payment_history');
    }
    public function data_pricing(){
        return view('app.user.data_pricing');
    }
    public function airtime_pricing(){
        return view('app.user.airtime_pricing');
    }
    
    public function support_page(){
        $data = [
            'dt' => 0,
            'PageInfo'=>DB::table('support')->get()
        ];
        return view('app.user.customer_support', $data);
    }
    public function faq_page(){
        $data = array(
            'FaqInfo' => DB::table('faq')
                            ->get()
        );
        return view('app.user.user_faq', $data);
    }
    public function loan_summary(){
        $data = array(
            'LoanInfo' => DB::table('transactions')
                            ->where('TransactionType', 2)
                            ->get()
        );
        return view('app.user.loan_summary', $data);
    }

    public function user_fund_history(){
        $data = array(
            'LoanInfo' => DB::table('payments')
                            ->where('user_id', Auth::user()->id)
                            ->orderBy('id', 'DESC')
                            ->get()
            );
        return view('app.user.fund_history', $data);
    }

    // Getting transactions details
    public function transactions(){
        $data = array(
            'LoanInfo' => DB::table('transactions')
                          ->join('network_providers', 'transactions.ProviderCode', '=', 'network_providers.ProviderCode')
                          ->where('user_id', Auth::user()->id)
                          ->orderBy('transactions.id', 'DESC')->get()
        );
        return view('app.user.transactions', $data);
    }

    // ->select('users.id', 'contacts.phone', 'orders.price')
    // Getting load receipt
    public function loan_receipt($id){
        $data = array(
            'LoanInfo' => DB::table('transactions')
                          ->join('network_providers', 'transactions.ProviderCode', '=', 'network_providers.ProviderCode')
                          ->where('transactions.TransferRef', '=', $id)
                          ->select('transactions.TransferRef', 'transactions.DataPlan', 'transactions.ReceiveCurrencyIso', 'transactions.Topup', 'transactions.AccountNumber', 'transactions.ReceiveValue', 'transactions.ProcessingState', 'transactions.CompletedUtc', 'network_providers.Name')
                          ->first()
        );
        // $nwt = DB::table('network_providers')->where('ProviderCode', $data->)->first()
        return view('app.user.loan_receipt', $data);
    }

    public function user_term_conditions(){
        $data = array(
            'TermofUse' => DB::table('term_conditions')->first()
        );
        return view('app.user.user_term_conditions', $data);
    }


    // user_account_cardfund
    public function user_account_cardfund(){
        return view('app.user.user_account_cardfund');
    }









    
    public function reset_password(){
        return view('app.user.reset_password_page');
    }
 
    // User Profile
    public function userProfile(){

        if( Auth::user()->id ){

            $data = [
                'LoggedUserInfo'=> User::where('id', '=', Auth::user()->id )->first()
            ];
        }
        return view('app.user.user_profile', $data);
    }

}

// $users = DB::table('users')
//             ->join('contacts', 'users.id', '=', 'contacts.user_id')
//             ->join('orders', 'users.id', '=', 'orders.user_id')
//             ->select('users.*', 'contacts.phone', 'orders.price')
//             ->get();
// ACCESS token

    // eyJraWQiOiI1N2JjZjNhNy01YmYwLTQ1M2QtODQ0Mi03ODhlMTA4OWI3MDIiLCJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI2MTU5IiwiaXNzIjoiaHR0cHM6Ly9yZWxvYWRseS1zYW5kYm94LmF1dGgwLmNvbS8iLCJodHRwczovL3JlbG9hZGx5LmNvbS9zYW5kYm94Ijp0cnVlLCJodHRwczovL3JlbG9hZGx5LmNvbS9wcmVwYWlkVXNlcklkIjoiNjE1OSIsImd0eSI6ImNsaWVudC1jcmVkZW50aWFscyIsImF1ZCI6Imh0dHBzOi8vdG9wdXBzLWhzMjU2LXNhbmRib3gucmVsb2FkbHkuY29tIiwibmJmIjoxNjUzNDMwNzI4LCJhenAiOiI2MTU5Iiwic2NvcGUiOiJzZW5kLXRvcHVwcyByZWFkLW9wZXJhdG9ycyByZWFkLXByb21vdGlvbnMgcmVhZC10b3B1cHMtaGlzdG9yeSByZWFkLXByZXBhaWQtYmFsYW5jZSByZWFkLXByZXBhaWQtY29tbWlzc2lvbnMiLCJleHAiOjE2NTM1MTcxMjgsImh0dHBzOi8vcmVsb2FkbHkuY29tL2p0aSI6ImI5OWRmNGVlLTkyNDktNGEzYS1iN2M1LTBkNGExOTA5NDRjYiIsImlhdCI6MTY1MzQzMDcyOCwianRpIjoiZDhmNWQ2ZDItNDRlNy00ZGU5LTlkNzMtMjQwZTdkNTMxOWU4In0.W5li4KR3iWlqm9MO_7N2TL_wlB_1tB1U9YNs0BEGvWI -->
