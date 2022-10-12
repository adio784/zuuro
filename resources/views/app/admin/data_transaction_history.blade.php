@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction History /</span> Data</h4>

        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                  <a class="nav-link" href="all_transaction_history"><i class="bx bx-user me-1"></i> All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="javascript:void(0);"
                    ><i class="bx bx-bell me-1"></i> Data</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="airtime_transaction_history"
                    ><i class="bx bx-link-alt me-1"></i> Airtime</a
                  >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="repayment_transaction_history"
                      ><i class="bx bx-link-alt me-1"></i> Repayment</a
                    >
                  </li>
              </ul>
            <div class="card mb-4">
            <!-- <h5 class="card-header">Data</h5> -->
            <!-- Data -->
            
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row"> 
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive text-wrap">
                            <table class="table" id="example">
                    <thead>
                      <tr>
                        <th>TransactionRef</th>
                        <th>Transaction Type</th>
                        <th>Mobile Recharge</th>
                        <th>Network</th>
                        <th>Number</th>
                        <th>Received Value</th>
                        <th>Processing State</th>
                        <th>Payment Time</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach ($LoanInfo as $item)
                        
                      <tr>
                        <td>
                          <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $item->TransferRef }}</strong>
                        </td>
                        <td>@if($item->TransactionType ==2)
                                {{ 'Loan' }}   
                            @else
                                {{ 'Topup' }}
                            @endif
                        </td>
                        <td><span class="badge bg-primary"> {{ $item->Topup }}</span></td>
                        <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            {{ $item->Name }} 
                          </ul>
                        </td>
                        <td><span class="badge bg-label-info me-1 text-dark">{{ $item->AccountNumber }}</span></td>
                        <td> @if($item->Topup == 'Data')
                                {{ $item->DataPlan }}
                            @else
                                {{ number_format($item->ReceiveValue) . $item->ReceiveCurrencyIso }}
                            @endif
                           </td>
                        <td>{{ $item->ProcessingState }}</td>
                        @if($item->RepaymentDay =='')
                        <td><span class="badge bg-label-info me-1 text-dark"> {{ ' NULL' }} </span></td> 
                        @else
                        <td><span class="badge bg-warning text-white"> {{ $item->RepaymentDay .' Days' }} </span></td> 
                        @endif

                        <td>{{ $item->created_at }}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="/loan_receipt/{{ $item->TransferRef }}"
                                ><i class="bx bx-edit-alt me-2"></i> Recipt</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /Account -->
            </div>
            
          </div>
        </div>
</div>
@endsection