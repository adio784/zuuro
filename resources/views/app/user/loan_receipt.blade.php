@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Top-up/</span> Receipt</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header"><strong>  Transaction Receipt </strong></h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                        <div id="content">
                            <table id="loan_receipt" class="display table-bordered" style="width:70%">
                                <thead>
                                    <th colspan="2" class="center"> 
                                        <img width="80" viewbox="0 0 25 42" version="1.1" src="/assets/images/favicon.png">
                                        <p>QoinCo Telecommunications</p>
                                    </th>
                                </thead>
                                <tbody>
                                    <tr><th colspan="2" class="center"> Transaction Details </th></tr>
                                    <tr>
                                        <th>TransactionRef</th>
                                        <td> {{ $LoanInfo->TransferRef }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile Recharge</th>
                                        <td> {{ $LoanInfo->Topup }} </td>
                                    </tr>
                                    <tr>
                                        <th>Network</th>
                                        <td>{{ $LoanInfo->Name }}  </td>
                                    </tr>
                                    <tr>
                                        <th>Number</th>
                                        <td> {{ $LoanInfo->AccountNumber }} </td>
                                    </tr>
                                    @if($LoanInfo->DataPlan == '')
                                    <tr>
                                        <th>Received Value</th>
                                        <td> {{ $LoanInfo->ReceiveValue .' '. $LoanInfo->ReceiveCurrencyIso }} </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <th>Data Plan</th>
                                        <td> {{ $LoanInfo->DataPlan }} </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Processing State</th>
                                        <td> @if($LoanInfo->ProcessingState == 'Complete') 
                                            <span class="badge badge-success text-success">{{ $LoanInfo->ProcessingState }} </span>
                                            @else <span class="badge badge-danger text-danger">{{ $LoanInfo->ProcessingState }} </span>
                                            @endif </td>
                                    </tr>
                                    <tr>
                                        <th>Date Completed</th>
                                        <td> {{ $LoanInfo->CompletedUtc }} </td>
                                    </tr>
                                </tbody>
                            </table>    
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-3 mt-4 mb-4">
                                <div class="form-group">
                                    
                                    <a href="#" class="btn btn-success print-hidden" id="print_btn"> Print </a>
                                    <a href="javascript:generatePDF()" class="btn btn-warning text-dark print-hidden"  id="downloadReceipt_btn"> Download </a>
                                    
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