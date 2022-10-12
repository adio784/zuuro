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
                        <div class="table">
                            <table id="example" class="display table-bordered" style="width:50%">
                                <thead>
                                    <th colspan="2" class="center"> 
                                        <img width="50" viewbox="0 0 25 42" version="1.1" src="{{ asset('images/favicon.png') }}">
                                        <p>Zuuro Telecommunications</p>
                                    </th>
                                </thead>
                                <tbody>
                                    <tr><th colspan="2" class="center"> Transaction Details </th></tr>
                                        
                                    <tr>
                                        <th>TransactionRef</th>
                                        <td> {{ $receiptRespose['TransferId']['TransferRef'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile Recharge</th>
                                        <td> {{ $nwkDetail['transTopup'] }} </td>
                                    </tr>
                                    <tr>
                                        <th>Network</th>
                                        <td> {{  $nwkDetail['nwkName'] }} </td>
                                    </tr>
                                    <tr>
                                        <th>Number</th>
                                        <td> {{  $receiptRespose['AccountNumber'] }} </td>
                                    </tr>
                                    @if($nwkDetail['transTopup'] == 'Airtime')
                                    <tr>
                                        <th>Received Value</th>
                                        <td> {{ number_format($receiptRespose['Price']['ReceiveValue']) }} </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <th>Data Plan</th>
                                        <td> {{ $nwkDetail['dataPlan']}} </td>
                                    </tr>
                                    <tr>
                                        <th>Amount</th>
                                        <td> {{ number_format($receiptRespose['Price']['ReceiveValue']) }} </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Processing State</th>
                                        <td> @if($receiptRespose['ProcessingState'] == 'Complete') 
                                            <span class="badge badge-success text-success">{{ 'Successful'}} </span>
                                            @else <span class="badge badge-danger text-danger">{{ $receiptRespose['ProcessingState'] }} </span>
                                            @endif </td>
                                    </tr>
                                    <tr>
                                        <th>Date Completed</th>
                                        <td> {{ $receiptRespose['CompletedUtc'] }} </td>
                                    </tr>
                                </tbody>
                            </table>    
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-3 mt-4 mb-4">
                                <div class="form-group">
                                    <a href="#" class="btn btn-success" id="print_btn"> Print </a>
                                    <a onclick="window.print()" class="btn btn-warning text-dark"> Download </a>
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

<!-- <th>TransferId</th>
                                <th>SkuCode</th>
                                <th>TransferRef</th>
                                <th>DistributorRef</th>
                                <th>ReceiveValue</th>
                                <th>ReceiveCurrencyIso</th>
                                <th>SendValue</th>
                                <th>SendCurrencyIso</th>
                                <th>CommissionApplied</th>
                                <th> StartedUtc</th>
                                <th> CompletedUtc</th>
                                <th> ProcessingState</th>
                                <th>ReceiptText</th>
                                <th> AccountNumber</th> -->