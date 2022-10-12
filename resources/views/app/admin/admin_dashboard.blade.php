@extends('app.admin.admin_layout')

@section('content')
@php 
  $totalUser = DB::table('users')->count('id');
  $actUser = DB::table('users')->where('email_verified_at', '!=', '')->count('id');
  $TCountry = DB::table('countries')->count('id');
  $TNetwork = DB::table('mobile_network_list')->count('id');
  $LoanInfo = DB::table('loan_record')->where('status', '=', 0)->SUM('loan_amount');
  $Transaction =  DB::table('transactions')
                          ->join('network_providers', 'transactions.ProviderCode', '=', 'network_providers.ProviderCode')
                          ->orderBy('transactions.id', 'DESC')->limit('5')->get();

 $Notif = DB::table('notifications')->count('id');
@endphp
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome back {{ session('LoggedAdminFullName') }} ! 🎉</h5>
                          <p class="mb-4">
                              
                             Zuuro Telecommunication is a leading mobile recharge company in <span class="fw-bold">Nigeria</span>
                             that provides microcredit as loans to the people who have a low balance on 
                             their Globe or TM sim card worldwide.
                          </p>

                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="{{ asset('img/illustrations/man-with-laptop-light.png') }}"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="{{ asset('img/icons/unicons/chart-success.png') }}"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Users</span>
                          <h3 class="card-title mb-2">{{ $totalUser }}</h3>
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ $actUser/$totalUser * 100 }}%</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="{{ asset('img/icons/unicons/wallet-info.png') }}"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                              </div>
                            </div>
                          </div>
                          <span>DingConnect</span>
                          <h3 class="card-title text-nowrap mb-1">${{ $DingAccount['Balance'] }}</h3>
                          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    
                    <div class="col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2">Countries Report</h5>
                                <span class="badge bg-label-warning rounded-pill">From Year 2021 till </span>
                              </div>
                              <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold"
                                  ><i class="bx bx-chevron-up"></i> 68.2%</small
                                >
                                <h3 class="mb-0">{{ $TCountry }}</h3>
                              </div>
                            </div>
                            <div id="profileReportChart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    
                    <!-- </div>
    <div class="row"> -->
                    <div class="col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2">Networks</h5>
                                <span class="badge bg-label-warning rounded-pill">Network providers</span>
                              </div>
                              <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold"
                                  ><i class="bx bx-chevron-up"></i> 68.2%</small
                                >
                                <h3 class="mb-0">{{ $TNetwork }}</h3>
                              </div>
                            </div>
                            <div id="profileReportChart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                    
                    <div class="col-12 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                              <div class="card-title">
                                <h5 class="text-nowrap mb-2">Loan Report</h5>
                                <span class="badge bg-label-warning rounded-pill">From Year 2021 till </span>
                              </div>
                              <div class="mt-sm-auto">
                                <small class="text-success text-nowrap fw-semibold"
                                  ><i class="bx bx-chevron-up"></i> 68.2%</small
                                >
                                <h3 class="mb-0">${{ $LoanInfo }}</h3>
                              </div>
                            </div>
                            <div id="profileReportChart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- Order Statistics -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                  <div class="card h-100">
                   
                    <div class="card-body">
                      <div class="container">
                        <div id="clock">
                        <div class="dial"></div>
                        <ul id="time-display" class="display-text">
                          <li id="hour-display"></li>
                          <li id="minute-display"></li>
                        </ul>
                        <ul id="calendar-display" class="display-text">
                          <li id="day-display"></li>
                          <li id="month-display"></li>
                          <li id="date-display"></li>
                        </ul>
                        <div id="second-hand" class="hand">
                          <div class="ring"></div>
                        </div>
                        <div id="minute-hand" class="hand"></div>
                        <div id="hour-hand" class="hand"></div>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <!--/ Order Statistics -->

                

                <!-- Transactions -->
                <div class="col-md-6 col-lg-8 order-2 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Transactions</h5>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="transactionID"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                          <a class="dropdown-item" href="/all_transaction_history">All</a>
                          <a class="dropdown-item" href="/data_transaction_history">Data</a>
                          <a class="dropdown-item" href="/airtime_transaction_history">Airtime</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        @foreach ($Transaction as $Transac)
                          <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                              <img src="@if($Transac->Topup == 'Data') {{ asset('img/icons/unicons/cc-success.png') }} @else {{ asset('img/icons/unicons/cc-warning.png') }} @endif" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <small class="text-muted d-block mb-1">{{ $Transac->TransferRef }}</small>
                                <h6 class="mb-0">
                                  @if($Transac->TransactionType ==2)
                                  {{ 'Loan' }}   
                                  @else
                                      {{ 'Topup' }}
                                  @endif
                                  | {{ $Transac->Topup }}
                                  | {{ $Transac->AccountNumber }}
                                  | @if($Transac->Topup == 'Data')
                                    {{ $Transac->DataPlan }}
                                    @else
                                        {{ number_format($Transac->ReceiveValue) . $Transac->ReceiveCurrencyIso }}
                                    @endif
                                </h6>
                              </div>
                              <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0">{{ number_format($Transac->ReceiveValue) }}</h6>
                                <span class="text-muted">USD</span>
                              </div>
                            </div>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->
              </div>
            </div>
            <!-- / Content -->

@endsection