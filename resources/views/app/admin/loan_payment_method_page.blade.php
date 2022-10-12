@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">QoinCo Loan/ </span> Payment Method
    </h4>

    <div class="row">
    <div class="col-md-12">
        <div class="row">
        
        <div class="col-md-7 col-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link " href="/manage_debtors">
                      <i class="bx bx-user me-1"></i> Debtors</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="javascript:void(0);"
                    ><i class="bx bx-bell me-1"></i> Payment Method</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/late_loan_payment"
                    ><i class="bx bx-link-alt me-1"></i> Late Payment</a
                  >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/sms_debtors_page"
                      ><i class="bx bx-link-alt me-1"></i> SMS Debtor</a
                    >
                  </li>
              </ul>
            <div class="card">
            <h5 class="card-header">Payment Methods</h5>
            <div class="card-body">
                <!-- Social Accounts -->
                <div class="table-responsive">  
                    <table class="table"  id="vertical-example"> 
                        <thead>
                            <th>#</th>
                            <th>Methods</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($PaymentInfo as $pay)
                                <?php $dt++; ?>
                                <tr>
                                    <td>{{ $dt }}</td>
                                    <td>{{ $pay->method }}</td>
                                    <td>{{ $pay->details }}</td>
                                    <td>
                                      @if($pay->status == 1)
                                        <span class="badge bg-success"> Active </span>
                                      @else
                                        <span class="badge bg-danger"> In-Active </span>
                                       
                                      @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                            
                                            <a class="dropdown-item" href="loan_payment_method_page/{{ $pay->id }}" onclick="return confirm('Are you sure to continue ?')"
                                                ><i class="bx bx-mouse-alt me-2"></i> @if($pay->status == 1) Disable @else Enable @endif</a
                                            >
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /Social Accounts -->
            </div>
            </div>
        </div>
        <div class="col-md-5 col-12 mb-md-0 mb-4">
            <div class="card">
            <h5 class="card-header">Add Payment Method</h5>
            <div class="card-body">
                <!-- Connections -->
                
                <div class="d-flex">
                    <form action="{{ route('loan_payment_method_page') }}"  method="post">
                        @csrf

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


                    <div class="row">
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Method</label>
                            <input
                              class="form-control"
                              type="text"
                              id="payment_method"
                              name="payment_method"
                              value="{{ old('payment_method') }}"
                            />
                          </div>@error('payment_method') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Details</label>
                            <input
                              class="form-control"
                              type="text"
                              id="details"
                              name="details"
                              value="{{ old('details') }}"
                            />
                          </div>@error('details') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                         
                          <div class="mb-3 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                          </div>

                        </div>
                    </form>
                </div>
                <!-- /Connections -->
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection