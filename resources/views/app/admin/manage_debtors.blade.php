@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manage /</span> Debtors</h4>

        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);">
                      <i class="bx bx-user me-1"></i> Debtors</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/loan_payment_method_page"
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
                          <th>#</th>
                        <th>Name</th>
                        <th>Transaction</th>
                        <th>Amount</th>
                        <th>reference</th>
                        <th>Number</th>
                        <th>Send Value</th>
                        <th>Received Value</th>
                        <th>Number</th>
                        <th>Payment</th>
                        <th>Due Date</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach ($LoanInfo as $item)
                        <?php $dt++; ?>
                      <tr>
                          <td>{{ $dt }}</td>
                        <td>
                          <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>{{ $item->name }}</strong>
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
                            {{ $item->TransferRef }} 
                          </ul>
                        </td>
                        
                        <td><span class="badge bg-label-info me-1 text-dark">{{ $item->AccountNumber }}</span></td>
                        <td>  {{ $item->SendValue.' '. $item->SendCurrencyIso }}  </td>
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
                        <td>{{ $item->repayment }} </td>
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