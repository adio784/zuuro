@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Record /</span> Direct Carrier</h4>

        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link " href="/paystack_record">
                      <i class="bx bx-user me-1"></i> Paystack</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/dingconnect_record"
                    ><i class="bx bx-bell me-1"></i> DingConnect</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="javascript:void(0);"
                    ><i class="bx bx-link-alt me-1"></i> Direct Carrier</a
                  >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/flutterwave_record"
                      ><i class="bx bx-link-alt me-1"></i> flutterwave_record </a
                    >
                  </li>
              </ul>
            <div class="card0 mb-4">
            <!-- <h5 class="card-header">Data</h5> -->
            <!-- Data -->
            
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row"> 

                      {{-- Record Starts here --}}

                      <div class="col-4 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img src="{{ asset('img/icons/unicons/paypal.png') }}" alt="Credit Card" class="rounded" />
                              </div>
                              <div class="dropdown">
                                <button
                                  class="btn p-0"
                                  type="button"
                                  id="cardOpt4"
                                  data-bs-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                  <a class="dropdown-item" href="/manage_debtors">View More</a>
                                  {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                                </div>
                              </div>
                            </div>
                            <span class="d-block mb-1">Total Outstanding (Loan)</span>
                            <h3 class="card-title text-nowrap mb-2">${{ $TotalLoan }}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -100%</small>
                          </div>
                        </div>
                      </div>
                      {{-- First Record  --}}

                      {{-- Due Loan Records  --}}
                      <div class="col-4 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img src="{{ asset('img/icons/unicons/paypal.png') }}" alt="Credit Card" class="rounded" />
                              </div>
                              <div class="dropdown">
                                <button
                                  class="btn p-0"
                                  type="button"
                                  id="cardOpt4"
                                  data-bs-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                  <a class="dropdown-item" href="/manage_debtors">View More</a>
                                  {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                                </div>
                              </div>
                            </div>
                            <span class="d-block mb-1">Total Due (Loan)</span>
                            <h3 class="card-title text-nowrap mb-2">${{ $DueLoan }}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> {{ round($DueLoan/$TotalLoan * 100 , 2) }}%</small>
                          </div>
                        </div>
                      </div>
                      {{-- Due Loan Ends Here --}}

                      {{-- Total Paid So far --}}
                      <div class="col-4 mb-4">
                        <div class="card">
                          <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                              <div class="avatar flex-shrink-0">
                                <img src="{{ asset('img/icons/unicons/paypal.png') }}" alt="Credit Card" class="rounded" />
                              </div>
                              <div class="dropdown">
                                <button
                                  class="btn p-0"
                                  type="button"
                                  id="cardOpt4"
                                  data-bs-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                  <a class="dropdown-item" href="/paid_loan">View More</a>
                                  {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                                </div>
                              </div>
                            </div>
                            <span class="d-block mb-1">Total Paid (Loan)</span>
                            <h3 class="card-title text-nowrap mb-2">${{ $TotalPaid }}</h3>
                            <small class="text-danger fw-semibold"><i class="bx bx-up-arrow-alt"></i> {{ round($TotalPaid/$TotalLoan * 100, 2) }}%</small>
                          </div>
                        </div>
                      </div>
                      {{-- Total Paid --}}

                    </div>
                </div>
            <!-- /Account -->
            </div>
            
          </div>
        </div>
</div>
@endsection