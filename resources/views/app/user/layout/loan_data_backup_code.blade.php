@extends('app.user.layout.user-layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loan /</span> Data</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Data</h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" action="/sendDataTransfer">
                        @csrf
                            <div id="result">
                              @if(Session::get('success'))
                                  <div class="alert alert-success alert-dismissible" role="alert">
                                  <strong>Success!</strong> {{ Session::get('success') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                              @endif
                              @if(Session::get('fail'))
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                  <strong>Oh Oops! </strong> {{ Session::get('fail') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              @endif
                          </div>

                        <div class="row">
                          <div class="mb-3 col-md-12">
                              <label class="form-label" for="country">Topup option</label>
                              <select id="loan_repay_period" class="select2 form-select" name="loan_repay_period">
                                <option value="">-- --</option>
                                <option value="1">Topup</option>
                                <option value="2"> Loan </option>
                              </select>
                              @error('loan_repay_period') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                            </div>

                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Country</label>
                            <select id="country" class="select2 form-select" name="country">
                              <option value="">Select</option>
                              @foreach($CountryInfo as $country)
                                <option value="{{ $country->iso3 }}">{{ $country->name }} </option>
                                
                              @endforeach
                            </select>
                            @error('country') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>

                          <div class="mb-3 col-md-6">
                          <label class="form-label" for="phoneNumber">Phone No</label>
                          <div class="input-group input-group-merge">
                            <span id="phoneNumberIcon" class="input-group-text"><i class="bx bx-phone"></i></span>
                            <input type="text" id="phone_Number" class="form-control phone-mask phoneNumber" 
                                  placeholder="658 799 8941"
                                  aria-describedby="basic-icon-default-phone2"
                                  name="phoneNumber">
                          </div>
                          @error('phoneNumber') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>

                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="network">Network </label>
                            <select id="network" class="select2 form-select" name="network_operator">
                              <option value="">Select</option>
                              
                            </select>
                            @error('network_operator') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>

                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="data_plan">Select Data Plan</label>
                            <select id="data_plan" class="select2 form-select" name="data_plan"> 
                              <option value="">Select Data Plan</option>
                             
                            </select>
                            @error('data_plan') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          
                          <div class="mb-3 col-md-12">
                            <label class="form-label" for="country">Select Loan Term (days)</label>
                            <select id="country" class="select2 form-select" name="loan_repay_period">
                              <option value="">-- --</option>
                              <option value="7">7 days</option>
                              <option value="14"> 14 days </option>
                            </select>
                            @error('loan_repay_period') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="">
                            <!-- hidden values for processing -->
                            <input type="text" id="SkuCode" name="SkuCode">
                            <input type="text" id="SendCurrencyIso" name="SendCurrencyIso">
                            <input type="text" id="DistributorRef" name="DistributorRef">
                            <input type="text" id="SName" name="SName">
                            <input type="text" id="SValue" name="SValue">
                            <input type="text" id="BillRef"  name="BillRef">
                            <input type="text" id="ReceiveCurrencyIso"  name="ReceiveCurrencyIso">
                            <input type="text" id="CommissionRate"  name="CommissionRate">
                          </div>
                          <div class="mb-3 col-md-6 d-none" id="countryInfoContainer">
                              <label class="form-label" for="countryInfo"> Country Details</label>
                              <div class="row">
                                <div class="img col-3">
                                  <img src="/assets/img/elements/4.jpg" alt="" class="card-img" style="width:100%;height:100%">                             
                                </div>
                                <div class="col-6">
                                    <p> Operator Name: <span id="operatorName"> MTN </span> </p>
                                    <p> Operator Short Name: <span id="operatorShortName"> MTN-NG</span> </p>
                                    <p> Country Currency: <span id="countryCurrency"> NGN </span> </p> 
                              </div>
                              </div>
                          </div>
                          <div class="input-group d-none">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" placeholder="Amount" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">.00</span>
                         </div>
                          <p> By submitting, you agreed that all information provided are right </p>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2" id="submitBtn">Submit</button>
                          <button type="reset" class="btn btn-outline-secondary">Clear all</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>
@endsection