@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Payment/</span> Checkout</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Fund Wallet /Card</h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="formAccountSettings" action="/create_checkout_session" method="POST">
                      @csrf
                        <!-- Result  -->
                        <div id="error_result">
                          @if(Session::get('success'))
                              <div class="alert alert-success alert-dismissible fade show text-dark" role="alert">
                                  <strong>Success!</strong> {{ Session::get('success') }}
                              </div>
                          @endif
                          @if(Session::get('fail'))
                          <div class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                              <strong>Oh Oops!</strong> {{ Session::get('fail') }}
                          </div>
                          @endif
                      </div>
                        <div class="row">
                          <div class="mb-3 col-md-12">
                            <label class="form-label" for="amount">Amount to Add</label>
                            <div class="input-group input-group-merge">
                            <span id="phoneNumberIcon" class="input-group-text"><i class="bx bx-dollar"></i></span>
                            <input type="number" id="amount" class="form-control phone-mask amount" 
                                  aria-describedby="basic-icon-default-phone2"
                                  min="1000"
                                  name="amount">
                            </div>
                            @error('amount') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Submit to continue </button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>
@endsection