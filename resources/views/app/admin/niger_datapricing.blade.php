@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manage Data /</span> Price</h4>
              <p><small>This will only be available for Nigeria Networks ie MTN, GLO, 9MOBILE, AIRTEL ...</small></p>

              <div class="row">

                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Manage /Data - Price</h5>
                    
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                        
                    <form id="formAccountSettings" method="POST" action="/importExcel" enctype="multipart/form-data">
                      @csrf
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
                        <div class="row ">
                            
                          <div class="mb-3 col-md-12">
                            <label class="form-label" for="ads_file">Upload</label>
                            <small>Upload csv file of your custom price here ...</small>
                            <div class="input-group input-group-merge">
                            <span id="ads_file" class="input-group-text"><i class="bx bx-file"></i></span>
                            <input type="file" id="ads_file" class="form-control phone-mask" 
                                  aria-describedby="basic-icon-default-phone2"
                                  name="pricing_file">
                            </div>
                            @error('pricing_file') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary m-2" >
                            Proceed
                          </button>

                        </div>

                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Manage /Data - Price</h5>
                    
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                        
                    <form id="formAccountSettings" method="POST" action="/setdataPricing" >
                      @csrf
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
                        <div class="row ">
                            
                          <div class="mb-3 col-md-4">
                            <label class="form-label" for="ads_file">Price</label>
                            <small>Enter pricing detail gently ...</small>
                            <div class="input-group input-group-merge">
                            <span id="ads_file" class="input-group-text"><i class="bx bx-file"></i></span>
                            <select class="form-control" name="price_network">
                                <option> -- Choose Network -- </option>
                                <option> MTN </option>
                                <option> GLO </option>
                                <option> AIRTEL </option>
                                <option> 9MOBILE </option>
                            </select>
                            </div>
                            @error('price_network') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="ads_file">Data Plan</label>
                            <div class="input-group input-group-merge">
                            <span id="ads_file" class="input-group-text"><i class="bx bx-network"></i></span>
                            <input type="text" id="ads_file" class="form-control phone-mask" 
                                  aria-describedby="basic-icon-default-phone2"
                                  name="data_plan">
                            </div>
                            @error('data_plan') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="ads_file">Validity</label>
                            <small>()01 Days)</small>
                            <div class="input-group input-group-merge">
                            <span id="ads_file" class="input-group-text"><i class="bx bx-network"></i></span>
                            <input type="text" id="ads_file" class="form-control phone-mask" 
                                  aria-describedby="basic-icon-default-phone2"
                                  name="validity">
                            </div>
                            @error('validity') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="ads_file">Price</label>
                            <div class="input-group input-group-merge">
                            <span id="ads_file" class="input-group-text"><i class="bx bx-file"></i></span>
                            <input type="text" name="data_price" class="form-control">
                            </div>
                            @error('price_network') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="ads_file">Interest Rate</label>
                            <div class="input-group input-group-merge">
                            <span id="ads_file" class="input-group-text"><i class="bx bx-network"></i></span>
                            <input type="text" id="ads_file" class="form-control phone-mask" 
                                  aria-describedby="basic-icon-default-phone2"
                                  name="int_rate">
                            </div>
                            @error('int_rate') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="ads_file">Loan Amount</label>
                            <div class="input-group input-group-merge">
                            <span id="ads_file" class="input-group-text"><i class="bx bx-network"></i></span>
                            <input type="text" id="ads_file" class="form-control phone-mask" 
                                  aria-describedby="basic-icon-default-phone2"
                                  name="loan_amount">
                            </div>
                            @error('loan_amount') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary m-2" >
                            Proceed
                          </button>

                        </div>

                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive text-wrap">
                                <table class="table" id="example">
                                  <thead>
                                    <th> Network </th>
                                    <th> Plan </th>
                                    <th> Duration </th>
                                    <th> Price </th>
                                    <th> Interest Rate </th>
                                    <th> Loan Amount</th>
                                    <th> Created </th>
                                  </thead>
                                  
                                      <tbody class="table-border-bottom-0">
                                              @foreach ($DatInfo as $item)
                                                
                                              <tr>

                                                @if( $item->network_code == 1 )
                                                <td><span class="badge bg-warning me-1 text-dark"> {{ ' MTN' }} </span></td> 
                                                @elseif( $item->network_code == 2 )
                                                <td><span class="badge bg-label-info me-1 text-dark"> {{ ' GLO' }} </span></td> 
                                                @elseif( $item->network_code == 3 )
                                                <td><span class="badge bg-label-info me-1 text-dark"> {{ ' AIRTEL' }} </span></td>
                                                @else
                                                <td><span class="badge bg-warning text-white"> {{ ' 9MOBILE' }} </span></td> 
                                                @endif

                                                <td>
                                                  <span class="badge bg-primary"> {{ $item->data_quant }} </span>
                                                </td>
                                               
                                                <td> {{ $item->duration }}</td>

                                                <td>
                                                  <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                    {{  $item->data_price }}
                                                  </ul>
                                                </td>

                                                <td> {{ $item->interest }}</td>

                                                <td> {{ $item->loan_price }}</td>
                                               

                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                  <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                      <a class="dropdown-item" href="/update_ads/{{ $item->id }}"
                                                        ><i class="bx bx-edit-alt me-2"></i> Activate</a
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
            </div>
@endsection