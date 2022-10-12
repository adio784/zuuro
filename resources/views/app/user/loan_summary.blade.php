@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Loan</span> Summary</h4>

        <div class="row">
          <div class="col-md-12">
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
                        <td>{{ $item->Topup }}</td>
                        <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            <span class="badge bg-primary"> {{ $item->SkuCode }} </span>
                          </ul>
                        </td>
                        <td><span class="badge bg-label-info me-1">{{ number_format($item->AccountNumber) }}</span></td>
                        <td>{{ $item->ReceiveValue . $item->ReceiveCurrencyIso }}</td>
                        <td>{{ $item->ProcessingState }}</td>
                        <td>{{ $item->RepaymentDay .' Days' }}</td>
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