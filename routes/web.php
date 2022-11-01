<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\AdminRegister;
use App\Http\Controllers\UserDashboard;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ApiRequestController;
use App\Http\Controllers\StripeAccountController;
use App\Http\Controllers\ApiRequestAirtimeController; 
use App\Http\Controllers\AccountController; 
use App\Http\Controllers\UserLogout; 
use App\Http\Controllers\GetCountryIso;
use App\Http\Controllers\FlutterWaveController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user_services', function () {
    return view('app.user.user-services');
});


Route::get('/user_about_us', function () {
    return view('app.user.user-about');
});
Route::get('/countact_us', function () {
    return view('app.user.contact_us');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/mobile', [HomeController::class, 'mobile'])->name('mobile'); 
Route::get('/verify_mobile', [HomeController::class, 'verify_index'])->name('verify_mobile'); 
Route::get('/transaction_pin', [HomeController::class, 'transaction_pin'])->name('transaction_pin');
Route::post('create_pin', [HomeController::class, 'create_pin']); 
Route::post('verify_otp', [HomeController::class, 'verify_otp']);
Route::post('sendOTP', [HomeController::class, 'sendOTP']);

Route::post('verify_mobile', [HomeController::class, 'verify_mobile']);

Route::post('addcard', [HomeController::class, 'addcard']);

Route::any('createservice', [HomeController::class, 'createservice']);



// ------------------------- USER CONTROL SIDE -----------------------------------------
Route::get('user-welcome', [UserDashboard::class, 'welcome'])->name('user-welcome');

Route::get('forget-password', [UserDashboard::class, 'forget_password'])->name('forget-password');

Route::any('logout_user', [UserLogout::class, 'logout_user']); 

Route::get('user_profile', [UserDashboard::class, 'userProfile'])->name('user_profile');

Route::get('loan_data', [UserDashboard::class, 'data'])->name('loan_data'); 

Route::get('loan_airtime', [UserDashboard::class, 'airtime'])->name('loan_airtime');
Route::get('loan_airtime_receipt', [UserDashboard::class, 'loan_airtime_receipt'])->name('loan_airtime_receipt');

Route::get('user_term_conditions', [UserDashboard::class, 'user_term_conditions'])->name('user_term_conditions');
Route::get('data_transaction', [UserDashboard::class, 'data_transaction'])->name('data_transaction');
Route::get('airtime_transaction', [UserDashboard::class, 'airtime_transaction'])->name('airtime_transaction');
Route::get('payment_history', [UserDashboard::class, 'payment_history'])->name('payment_history');
Route::get('data_pricing', [UserDashboard::class, 'data_pricing'])->name('data_pricing');
Route::get('airtime_pricing', [UserDashboard::class, 'airtime_pricing'])->name('airtime_pricing');
Route::get('customer_support', [UserDashboard::class, 'support_page'])->name('customer_support');
Route::get('user_faq', [UserDashboard::class, 'faq_page'])->name('user_faq');
Route::get('reset_password_page', [UserDashboard::class, 'reset_password'])->name('reset_password_page');
Route::get('notifications', [UserDashboard::class, 'notice'])->name('notifications');
Route::get('referred_page', [UserDashboard::class, 'refer'])->name('referred_page');
Route::get('loan_summary', [UserDashboard::class, 'loan_summary'])->name('loan_summary');
Route::get('data_products', [UserDashboard::class, 'data_products'])->name('data_products');
Route::get('provider_data', [UserDashboard::class, 'provider_data'])->name('provider_data');
Route::get('regions', [UserDashboard::class, 'regions'])->name('regions');
Route::get('airtime_products', [UserDashboard::class, 'airtime_products'])->name('airtime_products');
Route::get('user_notifications', [UserDashboard::class, 'user_notifications'])->name('user_notifications');



// ------------------------------------- GETTING AJAX REQUEST FROM USER SID -----------------
Route::get('getOperatorByPhone/{id}', [UserDashboard::class, 'getOperatorByCountry']);
Route::get('getAirtimeOperatorByPhone/{id}', [UserDashboard::class, 'getAirtimeOperatorByCountry']); 
Route::get('getPhoneCodeIsoregister/{id}', [GetCountryIso::class, 'getPhoneCodeIsoregister']);
Route::get('getPhoneCodeIso/{id}', [UserDashboard::class, 'getPhoneCodeIso']);
Route::get('getLogoByProviderCode/{id}', [UserDashboard::class, 'getLogoByProviderCode']);

Route::get('getProductByPhone/{id}', [ApiRequestController::class, 'getProductByPhone']);
Route::get('getAirtimeProductByPhone/{id}', [ApiRequestController::class, 'getAirtimeProductByPhone']);
Route::POST('sendDataTransfer', [ApiRequestController::class, 'sendDataTransfer']);
Route::POST('send_airtime', [ApiRequestAirtimeController::class, 'send_airtime']);

Route::get('loan_receipt/{id}', [UserDashboard::class, 'loan_receipt']);
Route::get('transactions', [UserDashboard::class, 'transactions']);
Route::get('user_fund_history', [UserDashboard::class, 'user_fund_history']);



// ------------------------------ CARD REQUESTING ACTIONS ----------------------------
Route::get('user_account_cardfund', [UserDashboard::class, 'user_account_cardfund']);
Route::get('automated_bank_transfer', [UserDashboard::class, 'automated_bank_transfer']);
Route::get('checkout_page', [UserDashboard::class, 'checkout_page']);
Route::get('verifyPayment/{id}', [StripeAccountController::class, 'verifyPayment']); 
Route::any('verifyPaymentFlutterWave', [StripeAccountController::class, 'verifyPaymentFlutterWave']); 
Route::POST('create_checkout_session', [StripeAccountController::class, 'create_checkout_session']);









// <<<<<<<<<<<<<<<<<<<<<<< ROUTE ON ADMIN SIDE <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>
Route::get('admin_login', [AdminAuth::class, 'admin_login'])->name('admin_login')->middleware('AlreadyLoggedAdmin');
Route::get('admin_dashboard', [AccountController::class, 'admin_dashboard']);
Route::get('admin_register', [AdminAuth::class, 'admin_register'])->name('admin_register')->middleware('AlreadyLoggedAdmin');

Route::get('manage_country_page', [AdminDashboardController::class, 'manage_country'])->name('manage_country_page');
Route::get('manage_networks_page', [AdminDashboardController::class, 'manage_networks'])->name('manage_networks_page');
Route::get('data_history_page', [AdminDashboardController::class, 'data_history'])->name('data_history_page');
Route::get('airtime_history_page', [AdminDashboardController::class, 'airtime_history'])->name('airtime_history_page');
Route::get('repayment_history_page', [AdminDashboardController::class, 'repayment_history'])->name('repayment_history_page');
Route::get('manage_users_page', [AdminDashboardController::class, 'manage_users'])->name('manage_users_page');
Route::get('loan_payment_method_page', [AdminDashboardController::class, 'loan_payment'])->name('loan_payment_method_page');
Route::get('loan_limit_page', [AdminDashboardController::class, 'loan_limit'])->name('loan_limit_page');
Route::get('loan_period_page', [AdminDashboardController::class, 'loan_period'])->name('loan_period_page');
Route::get('loan_interest_page', [AdminDashboardController::class, 'loan_interest'])->name('loan_interest_page');

Route::get('sms_debtors_page', [AdminDashboardController::class, 'sms_debtors'])->name('sms_debtors_page');
Route::get('set_pricing_page', [AdminDashboardController::class, 'set_pricing'])->name('set_pricing_page');
Route::get('manage_pricing_page', [AdminDashboardController::class, 'manage_pricing'])->name('manage_pricing_page');
Route::get('manage_faq', [AdminDashboardController::class, 'manage_faq'])->name('manage_faq');
Route::get('support_page', [AdminDashboardController::class, 'support_page'])->name('support_page');
Route::get('term_conditions', [AdminDashboardController::class, 'term_conditions'])->name('term_conditions');
Route::get('admin_profile', [AdminDashboardController::class, 'admin_profile'])->name('admin_profile');
Route::get('admin_notification', [AdminDashboardController::class, 'admin_notification'])->name('admin_notification');
Route::get('user_transaction_page/{id}', [AdminDashboardController::class, 'user_transaction']);
Route::get('manage_debtors', [AdminDashboardController::class, 'manage_debtors'])->name('manage_debtors');

Route::get('view_user_info/{id}', [AdminDashboardController::class, 'view_user']);
Route::get('disable_users_page/{id}', [AdminDashboardController::class, 'disable_user']);
Route::get('activate_users_page/{id}', [AdminDashboardController::class, 'activate_user']);
Route::get('all_transaction_history', [AdminDashboardController::class, 'all_transaction_history'])->name('all_transaction_history');
Route::get('data_transaction_history', [AdminDashboardController::class, 'data_transaction_history'])->name('data_transaction_history');
Route::get('airtime_transaction_history', [AdminDashboardController::class, 'airtime_transaction_history'])->name('airtime_transaction_history');
Route::get('repayment_transaction_history', [AdminDashboardController::class, 'repayment_transaction_history'])->name('repayment_transaction_history');
Route::get('late_loan_payment', [AdminDashboardController::class, 'late_loan_payment'])->name('late_loan_payment');
Route::get('loan_record', [AdminDashboardController::class, 'loan_record'])->name('loan_record');
Route::get('paid_loan', [AdminDashboardController::class, 'paid_loan'])->name('paid_loan');
Route::get('manage_ads', [AdminDashboardController::class, 'manage_ads'])->name('manage_ads');
Route::get('niger_datapricing', [AdminDashboardController::class, 'niger_datapricing'])->name('niger_datapricing');
// 08055616287



// Accounts from the Admin Side --------------------------------------------------------------------->
Route::get('paystack_record', [AdminDashboardController::class, 'paystack_record'])->name('paystack_record');
Route::get('dingconnect_record', [AccountController::class, 'dingconnect_record'])->name('dingconnect_record');
Route::get('direct_carrier_bill', [AdminDashboardController::class, 'direct_carrier_bill'])->name('direct_carrier_bill');
Route::get('flutterwave_record', [AdminDashboardController::class, 'flutterwave_record'])->name('flutterwave_record');



// <<<<<<<<<<<<<<<<<<<<<<< OPERATIONS ON ADMIN SIDE <<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>
Route::post('admin_register', [AdminRegister::class, 'register']);
Route::post('admin_login', [AdminAuth::class, 'adminAuth']);
Route::get('signout', [AdminDashboardController::class, 'signout'])->name('signout');

Route::post('manage_country_page', [AdminDashboardController::class, 'manage_country_script'])->name('manage_country_page');
Route::post('manage_networks_page', [AdminDashboardController::class, 'manage_networks_script'])->name('manage_networks_page');
Route::post('set_pricing_page', [AdminDashboardController::class, 'set_pricing_script']);
Route::post('loan_payment_method_page', [AdminDashboardController::class, 'payment_method_script']);
Route::post('manage_faq', [AdminDashboardController::class, 'faq_script']);
Route::post('sms_debtors_page', [AdminDashboardController::class, 'sms_debtors_script']);
Route::post('support_page', [AdminDashboardController::class, 'support_script']);
Route::post('term_conditions', [AdminDashboardController::class, 'term__of_conditions']); 
Route::post('submitads', [AdminDashboardController::class, 'submitads']);
Route::post('submit_pricing', [AdminDashboardController::class, 'submit_pricing']); 
Route::post('auth', [AdminDashboardController::class, 'auth']); 
Route::post('importExcel', [AdminDashboardController::class, 'importExcel']);
Route::post('setdataPricing', [AdminDashboardController::class, 'setdataPricing']);




// ------------------------------- UPDATE IN ADMIN SIDE ---------------------------
Route::get('update_ads/{id}', [AdminDashboardController::class, 'update_ads']);
Route::get('update_data/{id}', [AdminDashboardController::class, 'update_data']);


// ------------------------------- DELETING IN ADMIN SIDE --------------------------
Route::get('manage_faq/{id}', [AdminDashboardController::class, 'delete_faq']); 
Route::get('sms_debtors_page/{id}', [AdminDashboardController::class, 'delete_sms']);
Route::get('manage_pricing_page/{id}', [AdminDashboardController::class, 'delete_pricing']);
Route::get('loan_payment_method_page/{id}', [AdminDashboardController::class, 'delete_payment_method']);
Route::get('support_page/{id}', [AdminDashboardController::class, 'delete_support']);
Route::get('term_conditions/{id}', [AdminDashboardController::class, 'delete_term']);
Route::get('getCountries', [DataController::class, 'auth']);
Route::get('test', [TestApiController::class, 'test']);
Route::get('token', [TestApiController::class, 'getToken']);
Route::get('insertCountry', [TestApiController::class, 'insertCountry']);
Route::get('getCountry', [TestApiController::class, 'getCountry']);
Route::get('getProviders', [TestApiController::class, 'getProviders']);




// ------------------------------------- GETTING AJAX REQUEST FROM USER SID -----------------
Route::get('getOperatorByPhone/{id}', [UserDashboard::class, 'getOperatorByCountry']);
Route::get('getAirtimeOperatorByPhone/{id}', [UserDashboard::class, 'getAirtimeOperatorByCountry']); 
Route::get('getPhoneCodeIso/{id}', [UserDashboard::class, 'getPhoneCodeIso']);
Route::get('getLogoByProviderCode/{id}', [UserDashboard::class, 'getLogoByProviderCode']);

Route::get('getProductByPhone/{id}', [ApiRequestController::class, 'getProductByPhone']);
Route::get('getAirtimeProductByPhone/{id}', [ApiRequestController::class, 'getAirtimeProductByPhone']);
Route::POST('sendDataTransfer', [ApiRequestController::class, 'sendDataTransfer']);
Route::POST('send_airtime', [ApiRequestAirtimeController::class, 'send_airtime']);

Route::get('loan_receipt/{id}', [UserDashboard::class, 'loan_receipt']);
Route::get('transactions', [UserDashboard::class, 'transactions']);
Route::get('user_fund_history', [UserDashboard::class, 'user_fund_history']);



// ------------------------------ CARD REQUESTING ACTIONS ----------------------------
Route::get('user_account_cardfund', [UserDashboard::class, 'user_account_cardfund']);
Route::get('automated_bank_transfer', [UserDashboard::class, 'automated_bank_transfer']);
Route::get('checkout_page', [UserDashboard::class, 'checkout_page']);
Route::get('verifyPayment/{id}', [StripeAccountController::class, 'verifyPayment']); 
Route::any('verifyPaymentFlutterWave', [StripeAccountController::class, 'verifyPaymentFlutterWave']); 
Route::POST('create_checkout_session', [StripeAccountController::class, 'create_checkout_session']);