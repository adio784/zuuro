@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Mobile Recharge /</span> Data</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Top-up /Loan - Data</h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="/sendDataTransfer">
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
                        <div class="row ">
                            <div class="mb-3 col-md-12" >
                              <label class="form-label" for="top_up">Topup option</label>
                              <select id="top_up" class="select2 form-select" name="top_up">
                                <option value="">-- --</option>
                                <option value="1">Topup</option>
                                <option value="2"> Loan </option>
                              </select>
                              @error('top_up') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                              <span class="text-danger d-none" id="topup_message"> </span>
                            </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Country</label>
                            <select id="country" class="select2 form-select country_select" name="country">
                              <option value="">Select</option>
                              @foreach($CountryInfo as $country)
                              <option value="{{ $country->iso3 }}">{{ $country->name .' ('. $country->phonecode. ' )'  }}</option>
                              @endforeach
                            </select>
                            @error('country') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone No.</label>
                            <div class="input-group input-group-merge">
                            <span id="phoneNumberIcon" class="input-group-text"><i class="bx bx-phone"></i></span>
                            <input type="text" id="phone_Number" class="form-control phone-mask phoneNumber" 
                                  placeholder="+ 11658 799 8941"
                                  aria-describedby="basic-icon-default-phone2"
                                  name="phoneNumber">
                            </div>
                            @error('phoneNumber') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="network" id="select_network">Network </label>
                            <select id="network" class="select2 form-select" name="network_operator">
                              <option value="">Select</option>
                              
                            </select>
                            @error('network_operator') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="data_plan" id="select_dataplan"></label>
                            <select id="data_plan" class="select2 form-select" name="data_plan"> 
                              <option value="">Select Data Plan</option>
                             
                            </select>
                            @error('data_plan') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-12 d-none" id="loan_term_box">
                            <label class="form-label" for="loan_term">Select Loan Term (days)</label>
                            <select id="loan_term" class="select2 form-select" name="loan_term">
                              <option value="">-- --</option>
                              <option value="7">7 days</option>
                              <option value="8"> 8 days </option>
                              <option value="9"> 9 days </option>
                              <option value="10"> 10 days </option>
                              <option value="11"> 11 days </option>
                              <option value="12"> 12 days </option>
                              <option value="13"> 13 days </option>
                              <option value="14"> 14 days </option>
                            </select>
                            @error('loan_term') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          @error('pin') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          
                        </div>
                        <div class="mb-3 col-md-6" id="modileNetworkDetaile"  style="display: nne">
                          <div class="row">
                            <div class="col-md-10">
                              <p>
                                Operator Name: <span id="operator_CName"> <strong>  </strong></span>
                                <div class="form-group">
                                <input type="text" id="SkuCode" name="SkuCode">
                                <input type="text" id="SendCurrencyIso" name="SendCurrencyIso">
                                <input type="text" id="DistributorRef" name="DistributorRef">
                                <input type="text" id="SName" name="SName">
                                <input type="text" id="SValue" name="SValue">
                                <input type="text" id="DefaultDisplayText" name="DefaultDisplayText">
                                <input type="text" id="BillRef"  name="BillRef">
                                <input type="text" id="sendValue"  name="sendValue">
                                <input type="text" id="ReceiveCurrencyIso"  name="ReceiveCurrencyIso">
                                <input type="text" id="CommissionRate"  name="CommissionRate">
                                <input type="text" id="data_price"  name="data_price">
                                </div>
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                            Proceed
                          </button>
                          <button type="reset" class="btn btn-outline-secondary">Clear all</button>
                        </div>

                        {{-- Modal Input PIN --}}
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Input PIN</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="pinfield" class="form-label">Input PIN to proceed</label>
                                    <input
                                      type="text"
                                      id="pinfield"
                                      class="form-control"
                                      placeholder="Enter PIN"
                                      name="pin"
                                    />
                                  </div>
                                  <p> By submitting, you agreed that all information provided are right </p>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        {{-- Input PIN Modal --}}
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>
@endsection