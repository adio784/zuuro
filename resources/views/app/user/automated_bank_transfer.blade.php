@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Fund Wallet/</span> Automated Bank Transfer </h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Make Transfer From Your Bank </h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="automateBankTransfer" method="POST">
                      @csrf
                        <!-- Result  -->
                        <div id="error_result" class="d-none">
                            <div id="payment_success" class="alert alert-success alert-dismissible fade show text-dark" role="alert">
                                {{-- Thank you! Enjoy your awesome cruise.🚢 --}}
                              </div>
                              <div id="payment_pending" class="alert alert-warning alert-dismissible fade show text-dark" role="alert">
                                {{-- Verifying... Setting up your cruise🚢 --}}
                              </div>
                              <div id="payment_failed" class="alert alert-danger text-danger alert-dismissible fade show">
                                {{-- Uh-oh. Please try again, or contact support if you're encountering difficulties making payment. --}}
                              </div>
                        
                         </div>
                        <div class="row">
                          <div class="mb-3 col-md-12">
                            <label class="form-label" for="pay_amount">Enter Amount to Add</label>
                            
                            <div class="input-group input-group-merge">
                            <span id="phoneNumberIcon" class="input-group-text"><i class="bx bx-dollar"></i></span>
                            <input type="number" id="pay_amount" class="form-control phone-mask amount" 
                                  aria-describedby="basic-icon-default-phone2"
                                  name="pay_amount" required>
                            
                            
                            </div>
                           
                        </div>
                        
                        <input type="hidden" id="email_address" value="{{ session('LoggedUserEmail')}}" class="d-non"/>
                        <input type="hidden" id="username" value="{{ session('LoggedUserFullName')}}" class="d-non" />
                        <input type="hidden" id="phone_number" value="{{ session('LoggedUserTelephone')}}" class="d-non" />

                        <div class="mt-2">
                          <button type="submit" id="hideWindowButton" class="btn btn-primary me-2 " onclick="makePayment()">Pay Now </button>
                        </div>
                      </form>
                      
                      
                       
                    </div>
                    <!-- /Account -->
                  </div>

                  {{-- <div class="spinner-border spinner-border-sm text-secondary" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div> --}}

                </div>
              </div>
            </div>
@endsection
