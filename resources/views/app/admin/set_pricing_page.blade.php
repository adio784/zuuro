@extends('app.admin.admin_layout')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">QoinCo Pricing / </span> SET</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> SET PRICE</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('manage_pricing_page') }}"><i class="bx bx-user me-1"></i> MANAGE PRICE</a>
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Pricing . . .</h5>
                    <!-- Account -->
                    <div class="card-body">
                      
                    <hr class="my-0" />
                     <!-- Result  -->
                <div id="result">
                    @if(Session::get('success'))
                    <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                          <i class="bx bx-bell me-2"></i>
                          <div class="me-auto fw-semibold">Success!</div>
                          <small>{{ date('m') }}</small>
                          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ Session::get('success') }}
                        </div>
                      </div>
                    @endif
                    @if(Session::get('fail'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Oh Oops! </strong> {{ Session::get('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                </div>
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" action="{{ route('set_pricing_page') }}">
                      @csrf
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Data Quantity</label>
                            <select id="data_quat" class="select2 form-select" name="data_quat" >
                              <option value="">--  -- </option>
                              <option> 500 MB</option>
                                <option> 1 GB</option>
                                <option> 1.5 GB</option>
                                <option> 2 GB</option>
                                <option> 3 GB</option>
                                <option> 3.5 GB</option>
                                <option> 5 GB</option>
                                <option> 7 GB</option>
                                <option> 10 GB</option>
                                <option> 15 GB</option>
                                <option> 25 GB</option>
                                <option> 30 GB</option>
                                <option> 50 GB</option>
                                <option> 70 GB</option>
                                <option> 100 GB</option>
                            </select>
                            @error('data_quat') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                            <!-- <input
                              class="form-control"
                              type="text"
                              id="data_quat"
                              name="data_quat"
                              value="{{ old('data_quat') }}"
                            /> -->
                          </div> 
                          
                          <div class="mb-3 col-md-6">
                            <label for="network" class="form-label">Network</label>
                            <select id="network" class="select2 form-select" name="network" >
                              <option value="">--  -- </option>
                              @foreach($NetworkInfo as $netw)
                                <option value="{{ $netw->id }}"> {{ $netw->operator }} </option>
                              @endforeach
                            </select>
                            @error('network') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="data_price" class="form-label">Data price</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                              name="data_price"
                              value="{{ old('data_price') }}"
                            />
                            @error('data_price') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="plan_valid">Plan Validity</label>
                            <select id="plan_valid" class="select2 form-select" name="plan_valid" >
                              <option value="">--  -- </option>
                                <option> 3 Days</option>
                                <option> 7 Days</option>
                                <option> 14 Days</option>
                                <option> 30 Days</option>
                                <option> 90 Days</option>
                            </select>
                            @error('plan_valid') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="interest" class="form-label">Interest</label>
                            <input type="text" class="form-control" id="interest" name="interest" value="{{ old('interest') }}"/>
                            @error('interest') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="plan_period" class="form-label">Payment period</label>
                            <select id="plan_period" class="select2 form-select" name="plan_period" >
                              <option value="">--  -- </option>
                                <option> 3 Days</option>
                                <option> 7 Days</option>
                                <option> 14 Days</option>
                                <option> 21 Days</option>
                                <option> 25 Days</option>
                                <option> 30 Days</option>
                                <option> 40 Days</option>
                                <option> 53 Days</option>
                                <option> 60 Days</option>
                            </select>
                            @error('plan_period') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>

@endsection