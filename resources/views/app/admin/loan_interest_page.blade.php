@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">QoinCo Loan/ </span>Interest
    </h4>

    <div class="row">
    <div class="col-md-12">
        <div class="row">
        
        <div class="col-md-7 col-12">
            <div class="card">
            <h5 class="card-header">Manage Networks</h5>
            <div class="card-body">
                <p>Network operators we provide service to</p>
                <!-- Social Accounts -->
                <div class="table-responsive">  
                    <table class="table"> 
                        <thead>
                            <th>#</th>
                            <th>Country</th>
                            <th>Operators</th>
                            <th>Display Text</th>
                            <th></th>
                        </thead>
                        <tbody>
                                <?php //$dt++; ?>
                                <tr>
                                    <td>{{ '$dt' }}</td>
                                    <td>{{ '$Network->name' }}</td>
                                    <td>{{ '$Network->operator' }}</td>
                                    <td>{{ '$Network->display_text' }}</td>
                                    <td></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /Social Accounts -->
            </div>
            </div>
        </div>
        <div class="col-md-5 col-12 mb-md-0 mb-4">
            <div class="card">
            <h5 class="card-header">Add Networks</h5>
            <div class="card-body">
                <p>Add network operators to the list of networks ... </p>
                <!-- Connections -->
                
                <div class="d-flex">
                    <form action="{{ route('manage_networks_page') }}" id="country_form" method="post">
                        @csrf

                        {!! Toastr::message() !!}
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

                        <div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ Session::get('success') }}
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
                            <label for="firstName" class="form-label">Country Name</label>
                            <select name="countryName" id="countryName" class="form-control">
                                <option value=""> -- -- </option>
                            </select>
                          </div>@error('countryName') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Operator</label>
                            <input
                              class="form-control"
                              type="text"
                              id="operator"
                              name="operator"
                              value="{{ old('operator') }}"
                              placeholder="eg: MTN Group of Company"
                            />
                          </div>@error('phonecode') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Display Text</label>
                            <input
                              class="form-control"
                              type="text"
                              id="display_text"
                              name="display_text"
                              value="{{ old('display_text') }}"
                              placeholder="eg: MTN"
                            />
                          </div>@error('capital') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          
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