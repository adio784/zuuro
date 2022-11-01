@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manage Advert /</span> Promo</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Manage /Ads - Promo</h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="/submitads" enctype="multipart/form-data">
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
                            <div class="mb-3 col-md-12" >
                              <label class="form-label" for="title">Title</label>
                              <input type="text" name="title" id="title" class="form-control">
                              @error('title') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                              <span class="text-danger d-none" id="topup_message"> </span>
                            </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="" class="form-control"></textarea>
                            @error('description') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="ads_file">Upload</label>
                            <div class="input-group input-group-merge">
                            <span id="ads_file" class="input-group-text"><i class="bx bx-file"></i></span>
                            <input type="file" id="ads_file" class="form-control phone-mask" 
                                  placeholder=""
                                  aria-describedby="basic-icon-default-phone2"
                                  name="ads_file">
                            </div>
                            @error('ads_file') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                        </div>
                        
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary m-2" >
                            Proceed
                          </button>
                          <button type="reset" class="btn btn-outline-secondary">Clear all</button>
                          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCenter">
                            View Ads
                          </button>
                        </div>

                        {{-- Modal Input PIN --}}
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Advert List</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="table-responsive text-wrap">
                                  <table class="table" id="example">
                                    <thead>
                                      <th> Title </th>
                                      <th> Description </th>
                                      <th> Image </th>
                                      <th> Status </th>
                                      <th> Date </th>
                                      <th> Action </th>
                                    </thead>
                                    
                                        <tbody class="table-border-bottom-0">
                                                @foreach ($AdsInfo as $item)
                                                  
                                                <tr>
                                                  <td>
                                                    <span class="badge bg-primary"> {{ $item->title }} </span>
                                                  </td>
                                                 
                                                  <td> {{ $item->description }}</td>

                                                  <td>
                                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                      <a href="{{ asset('uploads/'.$item->fileName) }}" class="nav_link">
                                                          <img src="{{ asset('uploads/'.$item->fileName) }}" alt="" class="w-100">
                                                       </a>
                                                    </ul>
                                                  </td>
                                                  @if( $item->active == 0 )
                                                  <td><span class="badge bg-label-info me-1 text-dark"> {{ ' In-active' }} </span></td> 
                                                  @else
                                                  <td><span class="badge bg-warning text-white"> {{ ' Active' }} </span></td> 
                                                  @endif

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

                        {{-- Input PIN Modal --}}
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
                </div>
              </div>
            </div>
@endsection