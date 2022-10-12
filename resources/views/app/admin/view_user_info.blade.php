@extends('app.admin.admin_layout')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> <a href="{{ route('manage_users_page') }}"> User </a> </h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">{{ $getUserInfo->name }}</h5>
                    <!-- Account -->
                    <div class="card-body">
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                           <div class="card p-3">
                                <div class="form-group">
                                <h6 class="card-header p-1">FULLNAME: </h6>
                                <h5 class="card-header p-1">{{ $getUserInfo->name }}</h5>
                                </div>
                           </div>
                          </div>
                          <div class="mb-3 col-md-6">
                           <div class="card p-3">
                                <div class="form-group">
                                <h6 class="card-header p-1">USERNAME: </h6>
                                <h5 class="card-header p-1">{{ $getUserInfo->username }}</h5>
                                </div>
                           </div>
                          </div>
                          <div class="mb-3 col-md-6">
                           <div class="card p-3">
                                <div class="form-group">
                                <h6 class="card-header p-1">EMAIL: </h6>
                                <h5 class="card-header p-1">{{ $getUserInfo->email }}</h5>
                                </div>
                           </div>
                          </div>
                          <div class="mb-3 col-md-6">
                           <div class="card p-3">
                                <div class="form-group">
                                <h6 class="card-header p-1">GENDER: </h6>
                                <h5 class="card-header p-1">{{ $getUserInfo->gender }}</h5>
                                </div>
                           </div>
                          </div>
                          <div class="mb-3 col-md-6">
                           <div class="card p-3">
                                <div class="form-group">
                                <h6 class="card-header p-1">MOBILE NUMBER: </h6>
                                <h5 class="card-header p-1">{{ $getUserInfo->phone_number }}</h5>
                                </div>
                           </div>
                          </div>
                          <div class="mb-3 col-md-6">
                           <div class="card p-3">
                                <div class="form-group">
                                <h6 class="card-header p-1">ADDRESS: </h6>
                                <h5 class="card-header p-1">{{ $getUserInfo->address .', '. $getUserInfo->country }}</h5>
                                </div>
                           </div>
                          </div>
                          <div class="mb-3 col-md-6">
                           <div class="card p-3">
                                <div class="form-group">
                                <h6 class="card-header p-1">ZIPCODE: </h6>
                                <h5 class="card-header p-1">{{ $getUserInfo->zipcode }}</h5>
                                </div>
                           </div>
                          </div>
                          <div class="mb-3 col-md-6">
                           <div class="card p-3">
                                <div class="form-group">
                                <h6 class="card-header p-1">DATE OF BIRTH: </h6>
                                <h5 class="card-header p-1">{{ date('D, F g, Y', strtotime($getUserInfo->dob)) }}</h5>
                                </div>
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