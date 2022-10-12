@extends('layouts.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-notifications.html"
                        ><i class="bx bx-bell me-1"></i> Notifications</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-connections.html"
                        ><i class="bx bx-link-alt me-1"></i> Connections</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="@if(Auth::user()->gender =='Male'){{ asset('img/avatars/boy.png') }} @else {{ asset('img/avatars/girl-1.png') }} @endif"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          {{-- <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpeg"
                            />
                          </label> --}}
                          {{-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset password</span>
                          </button> --}}

                          {{-- <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p> --}}
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Full Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="fullName"
                              value="{{ Auth::user()->name }}"
                              @if( Auth::user()->name !='') {{ 'readonly' }} @endif
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Username</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="{{ Auth::user()->username }}"
                              @if( Auth::user()->username !='') {{ 'readonly' }} @endif />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="{{ Auth::user()->email }}"
                              @if( Auth::user()->email !='') {{ 'readonly' }} @endif
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Gender</label>
                            <input
                              type="text"
                              class="form-control"
                              id="organization"
                              name="organization"
                              value="{{ Auth::user()->gender }}" readonly
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                              {{-- <span class="input-group-text">US (+1)</span> --}}
                              <input
                                type="text"
                                id="phoneNumber"
                                name="phoneNumber"
                                class="form-control"
                                value="{{ Auth::user()->phone_number }}"
                                @if( Auth::user()->phone_number !='') {{ 'readonly' }} @endif
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}"
                              @if( Auth::user()->address !='') {{ 'readonly' }} @endif/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Country</label>
                            <input class="form-control" type="text" id="state" name="state" value="{{ Auth::user()->country }}"
                              @if( Auth::user()->country !='') {{ 'readonly' }} @endif />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">Zip Code</label>
                            <input
                              type="text"
                              class="form-control"
                              id="zipCode"
                              name="zipCode"
                              value="{{ Auth::user()->zipcode }}"
                              @if( Auth::user()->zipcode !='') {{ 'readonly' }} @endif
                              maxlength="6"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Date of Birth</label>
                            <input
                              type="text"
                              class="form-control"
                              id="zipCode"
                              name="dob"
                              value="{{ date('F g, Y', strtotime(Auth::user()->dob))}}"
                              @if( Auth::user()->dob !='') {{ 'readonly' }} @endif
                              maxlength="6"
                            />
                          </div>
                        </div>
                        {{-- <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div> --}}
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>

@endsection