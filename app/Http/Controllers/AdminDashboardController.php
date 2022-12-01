<?php

namespace App\Http\Controllers;

use App\Imports\DataPricingImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataPricing;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;


class AdminDashboardController extends Controller
{

    public function __construct(){
        $this->middleware(['isLoggedAdmin']);
        // middleware('isLoggedAdmin')
    }
    
    public function admin_dashboard(){
        return view('app.admin.admin_dashboard');
    }
    public function all_transaction_history(){
        $data = array(
            'LoanInfo' => DB::table('transactions')
                          ->join('network_providers', 'transactions.ProviderCode', '=', 'network_providers.ProviderCode')
                          ->orderBy('transactions.id', 'DESC')->get()
        );
        return view('app.admin.all_transaction_history', $data);
    }
    public function data_transaction_history(){
        $data = array(
            'LoanInfo' => DB::table('transactions')
                          ->join('network_providers', 'transactions.ProviderCode', '=', 'network_providers.ProviderCode')
                          ->where('Topup', 'Data')
                          ->orderBy('transactions.id', 'DESC')->get()
        );
        return view('app.admin.data_transaction_history', $data);
    }
    public function airtime_transaction_history(){
        $data = array(
            'LoanInfo' => DB::table('transactions')
                          ->join('network_providers', 'transactions.ProviderCode', '=', 'network_providers.ProviderCode')
                          ->where('Topup', 'Airtime')
                          ->orderBy('transactions.id', 'DESC')->get()
            );
        return view('app.admin.airtime_transaction_history', $data);
    }
    public function repayment_transaction_history(){
        $data = array(
            'LoanInfo' => DB::table('transactions')
                          ->join('network_providers', 'transactions.ProviderCode', '=', 'network_providers.ProviderCode')
                          ->orderBy('transactions.id', 'DESC')->get()
        );
        return view('app.admin.repayment_transaction_history', $data);
    }
    public function manage_country(){
        $ctr = DB::table('countries')->get();
        $dt = 0;
                $data = [
                    'CountryInfo'=>$ctr,
                    'dt' => $dt
                ];
        return view('app.admin.manage_country_page', $data);
    }
    public function manage_networks(){
        $dt = 0;
            $data = [
                'NetworkInfo'=> DB::table('networks')
                                ->join('countries', 'networks.country_id', '=', 'countries.id')
                                ->orderBy('networks.id', 'DESC')
                                ->get(),
                'Country' => DB::table('countries')->get(),
                'dt' => $dt
            ];
        return view('app.admin.manage_networks_page', $data);
    }
    public function data_history(){
        return view('app.admin.data_history_page');
    }
    public function airtime_history(){
        return view('app.admin.airtime_history_page');
    }
    public function repayment_history(){
        return view('app.admin.repayment_history_page');
    }
    public function manage_users(){
        $data = [
            'i' => 0,
            'UserInfo'=>DB::table('users')->get()
        ];
        return view('app.admin.manage_users_page', $data);
    }
    public function loan_payment(){
        $data = [
            'dt' => 0,
            'PaymentInfo'=>DB::table('payment_method')->get()
        ];
        return view('app.admin.loan_payment_method_page', $data);
    }
    public function manage_debtors(){
        $data = [
            'dt' => 0,
            'LoanInfo' => DB::table('users')->join('loan_record', 'users.id', '=', 'loan_record.user_id')
                          ->join('transactions', 'loan_record.referrence_id', '=', 'transactions.TransferRef')
                          ->orderBy('transactions.id', 'DESC')
                          ->get(),
        ];
        return view('app.admin.manage_debtors', $data);
    }
    public function late_loan_payment(){
        $today = NOW(); //date('Y-m-d');
        $data = [
            'dt' => 0,
            'LoanInfo' => DB::table('users')->where('loan_record.repayment', '<=', $today)
                          ->join('loan_record', 'users.id', '=', 'loan_record.user_id')
                          ->join('transactions', 'loan_record.referrence_id', '=', 'transactions.TransferRef')
                          ->orderBy('transactions.id', 'DESC')
                          ->get(),
        ];
        return view('app.admin.late_loan_payment', $data); 
    }
    public function loan_record(){
        $today = NOW();
        $data = [
            'TotalLoan' => DB::table('loan_record')->where('status', 0)->sum('loan_amount'),
            'DueLoan' => DB::table('loan_record')->where('repayment', '<=', NOW())->where('status', 0)->sum('loan_amount'),
            'TotalPaid' => DB::table('loan_record')->where('status', '=', 1)->sum('loan_amount')
        ];
        return view('app.admin.loan_record', $data);
    }
    public function paid_loan(){
        $today = NOW();
        $data=[
            'dt' => 0,
            'PaidInfo'=> DB::table('users')->where('transactions.TransactionType', '=', 3)
                        ->join('loan_record', 'users.id', '=', 'loan_record.user_id')
                        ->join('transactions', 'loan_record.referrence_id', '=', 'transactions.TransferRef')
                        ->orderBy('transactions.id', 'DESC')
                        ->get(),
        ];
        return view('app.admin.paid_loan', $data);
    }

    // Accounts Record ==========================================>
    public function paystack_record(){
        $today = NOW();
        $data = [
            'TotalLoan' => DB::table('loan_record')->where('status', 0)->sum('loan_amount'),
            'DueLoan' => DB::table('loan_record')->where('repayment', '<=', NOW())->where('status', 0)->sum('loan_amount'),
            'TotalPaid' => DB::table('loan_record')->where('status', '=', 1)->sum('loan_amount')
        ];
        return view('app.admin.paystack_record', $data);
    }
    public function dingconnect_record(){
        
        $today = NOW();
        $data = [
            'TotalLoan' => DB::table('loan_record')->where('status', 0)->sum('loan_amount'),
            'DueLoan' => DB::table('loan_record')->where('repayment', '<=', NOW())->where('status', 0)->sum('loan_amount'),
            'TotalPaid' => DB::table('loan_record')->where('status', '=', 1)->sum('loan_amount')
        ];
        return view('app.admin.dingconnect_record', $data);
    }
    public function direct_carrier_bill(){
        $today = NOW();
        $data = [
            'TotalLoan' => DB::table('loan_record')->where('status', 0)->sum('loan_amount'),
            'DueLoan' => DB::table('loan_record')->where('repayment', '<=', NOW())->where('status', 0)->sum('loan_amount'),
            'TotalPaid' => DB::table('loan_record')->where('status', '=', 1)->sum('loan_amount')
        ];
        return view('app.admin.direct_carrier_bill', $data);
    }
    public function flutterwave_record(){
        $today = NOW();
        $data = [
            'TotalLoan' => DB::table('loan_record')->where('status', 0)->sum('loan_amount'),
            'DueLoan' => DB::table('loan_record')->where('repayment', '<=', NOW())->where('status', 0)->sum('loan_amount'),
            'TotalPaid' => DB::table('loan_record')->where('status', '=', 1)->sum('loan_amount')
        ];
        return view('app.admin.flutterwave_record', $data);
    }
    // Accounts Record Ends Here ================================>
    public function loan_limit(){
        return view('app.admin.loan_limit_page');
    }
    public function loan_period(){
        return view('app.admin.loan_period_page');
    }
    public function loan_interest(){
        return view('app.admin.loan_interest_page');
    }
    public function sms_debtors(){
        $data = [
            'dt' => 0,
            'DebtorInfo'=>DB::table('sms_debtors')->get()
        ];
        return view('app.admin.sms_debtors_page', $data);
    }
    public function set_pricing(){
        $data = [
            'NetworkInfo'=> DB::table('networks')->get()
        ];
        return view('app.admin.set_pricing_page', $data);
    }

    // ->select('exam.exm_id as examID', 'exam.school_id as schoolID')
    public function manage_pricing(){
        $data = [
            'PriceInfo'=> DB::table('data_pricing')
                          ->select('data_pricing.id as dataID', 'data_quant', 'display_text', 'data_price', 'duration', 'interest', 'payment_period')
                          ->join('networks', 'data_pricing.network_code', '=', 'networks.id')
                          ->join('countries', 'networks.country_id', '=', 'countries.id')
                          ->orderBy('networks.id', 'DESC')
                          ->get(),
            'i' => 0
        ];
        return view('app.admin.manage_pricing_page', $data);
    }
    public function manage_faq(){
        $data = [
            'dt' => 0,
            'PaymentInfo'=>DB::table('faq')->get()
        ];
        return view('app.admin.manage_faq', $data);
    }
    public function support_page(){
        $data = [
            'dt' => 0,
            'PageInfo'=>DB::table('support')->get()
        ];
        return view('app.admin.support_page', $data);
    }
    public function term_conditions(){
        $data = [
            'dt' => 0,
            'PageInfo'=>DB::table('term_conditions')->get()
        ];
        return view('app.admin.term_conditions', $data);
    }
    public function admin_profile(){
        $data = array(
            'Profiles' => DB::table('admins')
                          ->where('id', '=', session('LoggedAdmin'))
                          ->first()
        );
        return view('app.admin.admin_profile', $data);
    }
    public function admin_notification(){
        $data = array(
            'Notifications' => DB::table('notifications')
                                ->JOIN('users', 'users.id', '=', 'notifications.user_id')
                                ->orderBy('notifications.id', 'DESC')
                                ->get()
        );
        return view('app.admin.admin_notification', $data);
    }
    public function user_transaction($id){
        $data = [
            'i' => 0,
            'UserInfo'=> DB::table('users')
                               ->where('users.id', '=', $id)
                               ->join('transactions', 'users.id', '=', 'transactions.user_id')
                               ->orderBy('transactions.id', 'DESC')
                               ->get()
        ];
        return view('app.admin.user_transaction_page', $data);
    }
    public function view_user($id){
        $upd = DB::table('users')
              ->where('id', $id)
              ->first();
            $data = [
                'getUserInfo'=>$upd
            ];
        return view('app.admin.view_user_info', $data);
    }

     public function manage_ads(){
        $upd = DB::table('advert')->get();
            $data = [
                'AdsInfo'=>$upd
            ];
        return view('app.admin.manage_ads', $data);
    }

    public function niger_datapricing(){
        $upd = DB::table('data_pricing')->get();
            $data = [
                'DatInfo'=>$upd
            ];
        return view('app.admin.niger_datapricing', $data);
    }


    



    
// ADMIN FUNCTIONALITIES GOES HERE
public function manage_country_script(Request $request){
    $request->validate([
        'countryName' => 'required|max:255',
        'shortcode'   => 'required|max:255',
        'phonecode' => 'required|max:255',
        'capital' => 'required|max:255',
        'currency' => 'required|max:255',
        'currency_name' => 'required|max:255'
    ]);

    $query = DB::table('countries')->insert([
        'name' => $request->countryName,
        'iso3' => $request->shortcode,
        'phonecode' => $request->phonecode,
        'capital' => $request->capital,
        'currency' => $request->currency,
        'currency_name' => $request->currency_name
    ]);

    if($query){
        return back()->with('success', 'Country successfully added');
    }else{
        return back()->with('fail', 'Operation failed, try later ');
    }

    // Nigeria 	NGA 	NG 	234 	Abuja 	NGN 	Nigerian naira
}

public function manage_networks_script(Request $request){
    $request->validate([
        'countryName' => 'required|max:255',
        'operator'   => 'required|max:255',
        'display_text' => 'required|max:255'
    ]);

    $query_net = DB::table('networks')
            ->insert([
                'country_id' => $request->countryName,
                'operator' => $request->operator,
                'display_text' => $request->display_text
            ]);
    if($query_net){
        Toastr::success('Country successfully added :)', 'Success');
        return redirect()->back();
        // return back()->with('success', 'Country successfully added');
    }else{
        Toastr::error('Operation failed, try later :)', 'Failed');
        return redirect()->back();
        // return back()->with('fail', 'Operation failed, try later ');
    }
}

// Set pricing 
public function set_pricing_script(Request $request){
    $request->validate([
        'data_plan' => 'required|max:255',
        'network_code'   => 'required|max:255',
        'data_price' => 'required|max:255',
        'validity' => 'required|max:255',
        'interest' => 'required|max:255',
        'loan_amount' => 'required|max:255'
    ]);
    $query_pricing = DB::table('data_pricing')
            ->insert([
                'data_quant' => $request->data_plan,
                'network_code' => $request->network_code,
                'data_price' => $request->data_price,
                'duration' => $request->validity,
                'interest' => $request->interest,
                'loan_price' => $request->loan_amount
            ]);
    if($query_pricing){
        return back()->with('success', 'Pricing successfully set');
    }else{
        return back()->with('fail', 'Operation failed, try later ');
    }

}

// Set payment method
public function payment_method_script(Request $request){
    $request->validate([
        'payment_method' => 'required|max:255',
        'details'   => 'required|max:255'
    ]);
    $query_pay = DB::table('payment_method')
            ->insert([
                'method' => $request->payment_method,
                'details' => $request->details
            ]);
    if($query_pay){
        return back()->with('success', 'Payment method created');
    }else{
        return back()->with('fail', 'Operation failed, try later ');
    }
}

// Set faq question
public function faq_script(Request $request){
    $request->validate([
        'question' => 'required|max:255',
        'answer'   => 'required|max:255'
    ]);
    $query_pay = DB::table('faq')
            ->insert([
                'question' => $request->question,
                'answer' => $request->answer
            ]);
    if($query_pay){
        return back()->with('success', 'Question created');
    }else{
        return back()->with('fail', 'Operation failed, try later ');
    }
}

// Set sms debtors
public function sms_debtors_script(Request $request){
    $request->validate([
        'sender' => 'required|max:255',
        'message'   => 'required|max:255'
    ]);
    $query_pay = DB::table('sms_debtors')
            ->insert([
                'sender' => $request->sender,
                'message' => $request->message
            ]);
    if($query_pay){
        return back()->with('success', 'Message Sent');
    }else{
        return back()->with('fail', 'Operation failed, try later ');
    }
}

// Set support
public function support_script(Request $request){
    $request->validate([
        'page'      => 'required|max:255',
        'page_name' => 'required|max:255',
        'page_link' => 'required|max:255',
        'page_icon' => 'required|max:255'
    ]);
    $query_sup = DB::table('support')
            ->insert([
                'page_type' => $request->page,
                'page_name' => $request->page_name,
                'page_link' => $request->page_link,
                'page_icon' => $request->page_icon
            ]);
    if($query_sup){
        return back()->with('success', 'Page Support Set');
    }else{
        return back()->with('fail', 'Operation failed, try later ');
    }
} 

// Set term_conditions
public function term__of_conditions(Request $request){
    $request->validate([
        'termOfUse'      => 'required|mimes:pdf,xlx,csv|max:2048'
    ]);
    $fileName = time().'.'.$request->termOfUse->extension();
    $query_sup = DB::table('term_conditions')
            ->insert([
                'fileName' => $fileName
            ]);
    
    if($query_sup){
        $request->termOfUse->move(public_path('uploads'), $fileName);
        return back()
            ->with('success','You have successfully upload term of use.')
            ->with('file', $fileName);
    }else{
        return back()->with('fail', 'Operation failed, try later ');
    }
    
    
    
}


public function submitads(Request $request){
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'ads_file' => 'required|mimes:jpg,jpeg,png,gif|max:5048'
    ]);
    $fileName = time().'.'.$request->ads_file->extension();
    $query_sup = DB::table('advert')
            ->insert([
                'title' => $request->title,
                'description'=> $request->description,
                'fileName' => $fileName
            ]);
    
    if($query_sup){
        $request->ads_file->move(public_path('uploads'), $fileName);
        return back()
            ->with('success','You have successfully upload advert.')
            ->with('file', $fileName);
    }else{
        return back()->with('fail', 'Operation failed, try later ');
    }

}

// Importing Excel Data Pricing
public function importExcel(Request $request)
{
    $request->validate([
        'pricing_file' => 'required|mimes:csv|max:10048'
    ]);

    Excel::import(new DataPricingImport, $request->file('pricing_file')->store('files'));
    return back()->with('success','Imported Successfully ....');
}






// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


        // User Profile
        function userProfile(){

            if(session()->has('LoggedAdmin')){
                $user = DB::table('admins')->where('id', '=', session('LoggedAdmin'))->first();
                $data = [
                    'LoggedAdminInfo'=>$user
                ];
            }
            return view('app.admin.admin_profile', $data);
        }

        // Activate User Account
        // Disable User
        public function activate_user($id){
            $query = DB::table('users')
                 ->where('id', $id)
                 ->update([
                     'status' =>1
                 ]);
                 if($query){
                    return back()->with('success', 'User Activated');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        } 

        // Disable User
        public function update_ads($id){
            $query = DB::table('advert')
                 ->where('id', $id)
                 ->update([
                     'active' =>1
                 ]);
                 if($query){
                    return back()->with('success', 'Status Activated');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        }

        // Disable User
        public function disable_user($id){
            $query = DB::table('users')
                 ->where('id', $id)
                 ->update([
                     'status' =>0
                 ]);
                 if($query){
                    return back()->with('success', 'User Disabled');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        }

        // Delete faq
        public function delete_faq($id){
            $query = DB::table('faq')
                 ->where('id', $id)
                 ->delete();
                 if($query){
                    return back()->with('success', 'Deleted');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        }

        // Delete sms debtor
        public function delete_sms($id){
            $query = DB::table('sms_debtors')
                 ->where('id', $id)
                 ->delete();
                 if($query){
                    return back()->with('success', 'Deleted');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        }

        // Delete support page
        public function delete_support($id){
            $query = DB::table('support')
                 ->where('id', $id)
                 ->delete();
                 if($query){
                    return back()->with('success', 'Deleted');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        }

        // Delete term of use page
        public function delete_term($id){
            $query = DB::table('term_conditions')
                 ->where('id', $id)
                 ->delete();
                 if($query){
                    return back()->with('success', 'Deleted');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        }

        // Delete pricing  
        public function delete_pricing($id){
            $query = DB::table('data_pricing')
                    ->where('id', $id)
                    ->delete();
                 if($query){
                    return back()->with('success', 'Deleted');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        }

        // Delete delete_payment_method
        public function delete_payment_method($id){

            $sq = DB::table('payment_method')->where('id', $id)->first();
            if( $sq->status == 0 ){ $st =1; }else{ $st=0; }

            $query = DB::table('payment_method')
                    ->where('id', $id)
                    ->update([
                        'status'=>$st
                    ]);
                 if($query){
                    return back()->with('success', 'Updated');
                 }else{
                    return back()->with('fail', 'Operation failed, try later :)');
                 }
        }
    
    
         // Logout script
         public function signout(){
            if(session()->has('LoggedAdmin')){
                session()->pull('LoggedAdmin'); 
                $act = DB::table('activity')
                           ->insert([
                               'username' => Session('LoggedAdminFullName'),
                               'report'   => 'Logged Out'
                           ]);
                return redirect()->route('admin_login');
            }
        }

        //  public function logout(){
        //     auth()->logout();
        //         $act = DB::table('activity')
        //                    ->insert([
        //                        'username' => Session('LoggedAdminFullName'),
        //                        'report'   => 'Logged Out'
        //                    ]);
        //         return redirect()->route('admin_login');
        //     }
}
