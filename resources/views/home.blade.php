@extends('layouts.app')


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- Notifications --}}
    @if (Auth::user()->isVerified != true)
        <div class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
            <a href="{{ route('mobile') }}">
                <strong class="text-danger">Attention !!! </strong> Kindly Verify Your Number to Continue Using this Service ...
            </a>
        </div>
    @endif
    @if (Auth::user()->create_pin ==0)
        <div class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
            <a href="{{ route('transaction_pin') }}">
                <strong class="text-danger">Transaction PIN !!! </strong> Get your account more secure with a 4 digit PIN ...
            </a>
        </div>
    @endif

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
    <div class="col-lg-8 mb-4">
        <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
            <div class="card-body">
                <h5 class="card-title text-primary">Hey! {{ Auth::user()->name }}! 🎉</h5>
                <p class="mb-4">
                You are welcome to <span class="fw-bold">Zuuro Telecommunications</span> where we provide you 
                best and easy services that makes life easier.
                </p>

                <a href="javascript:;" class="btn btn-sm btn-outline-primary">{{ session('LoggedUserReferralLink') }}</a>
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
    <div class="col-lg-4 col-md-4">
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
                </div>
                <span class="fw-semibold d-block mb-1">Wallet Bal</span>
                <h4 class="card-title mb-2">{{ number_format($Account->user_balance) }} USD</h4>
            </div>
        </div>

    </div>
    <!-- Total Revenue -->
    <div class="col-12 col-lg-12 mb-4">
        <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-8">
            <h5 class="card-header m-0 me-2 pb-3">Card</h5>
            <div  class="px-2">
                <table class="p-3 table"> 

                    @foreach ($Card as $item)
                        <tr class="bg-info text-white">
                            <th>{{ $item->account_name }} |</th>
                            <th> {{ $item->bank }} |</th>
                            <th> {{ $item->brand }} </th>
                            <th> <label> </label></th>
                        </tr>
                        {{-- <tr>
                            <th> <span class="btn btn-sm btn-outline-primary">
                                {{ $item->account_name }} | {{ $item->bank }} | {{ $item->brand }} ({{ $item->exp_month }}/{{ $item->exp_year }})</span> <th>
                        </tr> --}}
                    @endforeach
                </table>
            </div>
            </div>
            <div class="col-md-4">
            <div class="card-body">
                <div class="text-center">
                <div class="dropdown">
                    <button
                    class="btn btn-sm btn-outline-primary dropdown-toggle"
                    type="button"
                    id="growthReportId"
                    aria-haspopup="true"
                    aria-expanded="false"
                    data-bs-toggle="modal"
                          data-bs-target="#modalCenter"
                    >
                    Add Credit Card
                    </button>
                </div>
                </div>
            </div>
            <div id="growthChart"></div>
            <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
               
                <div class="d-flex">
                <div class="me-2">
                    <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                </div>
                <div class="d-flex flex-column">
                    <small>Total Card</small>
                    <h6 class="mb-0">{{ $CardCount }} </h6>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!--/ Total Revenue -->

    <div class="row">

    <!-- Transactions -->
    <div class="col-md-12 col-lg-12 order-2 mb-4">
        <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2"> Transactions Summary</h5>
            <div class="dropdown">
            
            </div>
        </div>
        <div class="card-body">
            <ul class="p-0 m-0">
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('img/icons/unicons/wallet.png') }}" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <small class="text-muted d-block mb-1">Wallet Balance</small>
                    <h6 class="mb-0">Current State of Account</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">{{ number_format($Account->user_balance) }}</h6>
                    <span class="text-muted">USD</span>
                </div>
                </div>
            </li>
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('img/icons/unicons/chart.png') }}" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <small class="text-muted d-block mb-1">Total Spending</small>
                    <h6 class="mb-0">Outbox</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0"><?php 
                        $sum = $TotalSpend->sum('Price');
                        echo  number_format($sum);
                ?></h6>
                    <span class="text-muted">USD</span>
                </div>
                </div>
            </li>
            <li class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                <img src="{{ asset('img/icons/unicons/cc-warning.png') }}" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <small class="text-muted d-block mb-1">Total Funding</small>
                    <h6 class="mb-0">Income</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0"><?php 
                            $sum = $TotalFund->sum('amount');
                            echo  number_format($sum);
                    ?></h6>
                    <span class="text-muted">USD</span>
                </div>
                </div>
            </li>
            </ul>
        </div>
        </div>
    </div>
    <!--/ Transactions -->
    </div>
</div>


{{-- Add Card Modal Goes Here ------------------------ --}}
<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Add Credit Card Details</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
    <form method="POST" action="/addcard">
          <div class="row">
            <div class="col-6 mb-3">
                <label for="bankName" class="form-label">Bank Name</label>
                <input
                  type="text"
                  id="bankName"
                  class="form-control"
                  placeholder="Enter Bank Name"
                  name="bankName"
                />
              </div>
            <div class="col-6 mb-3">
              <label for="nameWithTitle" class="form-label">Last 4 Digit </label>
              <input
                type="text"
                id="nameWithTitle"
                class="form-control"
                placeholder="Enter Card digit"
                name="cardNumber"
              />
            </div>
          </div>
    
        @csrf
          <div class="row">
            <div class="col-6 mb-0">
                <label for="expYear" class="form-label"> Expiration Year</label>
                <select id="gyu" class="form-control" name="expYear">
                    <option value="" selected>-- --</option>
                    
                    @for($y = date('Y'); $y <= date('Y')+10 ; $y++)
                        <option> {{ $y }} </option>
                    @endfor
                </select>
            </div>

            <div class="col-6 mb-0">
              <label for="expMonth" class="form-label"> Expiration Month </label>
              <select id="expMonth" class="form-control" name="expMonth">
                <option value="" selected>-- --</option>
                @for($i = 1; $i <=12 ; $i++)
                    <option> @if($i <= 9) {{ '0'.$i }} @else {{ $i }} @endif</option>
                @endfor
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-0">
              <label for="dobWithTitle" class="form-label">CVV</label>
              <input
                type="hidden"
                class="form-control"
                placeholder="000"
                name="cvv"
                
              />
            </div>

            <div class="col-12 mb-0">
                <label for="cardType" class="form-label"> Card Type </label>
                <select id="cardType" class="form-control" name="cardType">
                  <option value="" selected>-- --</option>
                  <option> Master </option>
                  <option> Verve</option>
                </select>
              </div>
              
          </div>
          <button type="submit" class="btn btn-primary mt-4">Save changes</button>
        </div>
    </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          
        </div>
      </div>
    </div>
    
  </div>
</div>
</div>
@endsection
