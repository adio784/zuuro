@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">QoinCo Loan / </span> SMS DEBTORS</h4>
              <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link " href="/manage_debtors">
                      <i class="bx bx-user me-1"></i> Debtors</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="/loan_payment_method_page"
                    ><i class="bx bx-bell me-1"></i> Payment Method</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="/late_loan_payment"
                    ><i class="bx bx-link-alt me-1"></i> Late Payment</a
                  >
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/sms_debtors_page"
                      ><i class="bx bx-link-alt me-1"></i> SMS Debtor</a
                    >
                  </li>
              </ul>
              <div class="row">
                <div class="col-lg-5">
                  
                  <div class="card">
                    <div class="card mb-4">
                      <div class="card-header">
                          <div class="table-responsive">
                            <table class="table" id="table_id">
                              <thead>
                                <th>#</th>
                                <th>Sender</th>
                                <th>Messaged</th>
                                <th></th>
                              </thead>
                              <tbody>
                            @foreach($DebtorInfo as $debt)
                                <?php $dt++; ?>
                                <tr>
                                    <td>{{ $dt }}</td>
                                    <td>{{ $debt->sender }}</td>
                                    <td>{{ $debt->message }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                            
                                            <a class="dropdown-item" href="sms_debtors_page/{{ $debt->id }}" onclick="return confirm('Are you sure to delete ?')"
                                                ><i class="bx bx-trash me-2"></i> Delete</a
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
                </div>
                <div class="col-md-7">
                  <div class="card mb-4">
                    <h5 class="card-header">Bulk message to all debtor ...</h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" action="{{ route('sms_debtors_page') }}">
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
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="sender">Message Destination</label>
                            <select id="sender" class="select2 form-select" name="sender">
                              <option value="">Select</option>
                              <option> Email Message </option>
                              <option> Mobile Message </option>
                            </select>
                          </div>

                          <div class="mb-3 col-md-12">
                            <label class="form-label" for="message">Message</label>
                            <textarea class="form-control" name="message" id="message"> </textarea>
                          </div>
                         
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Submit</button>
                          <button type="reset" class="btn btn-outline-secondary">Clear all</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>
@endsection