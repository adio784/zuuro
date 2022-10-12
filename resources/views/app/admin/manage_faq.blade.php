@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">F.A.Q/ </span> Management
    </h4>

    <div class="row">
    <div class="col-md-12">
        <div class="row">
        
        <div class="col-md-7 col-12">
            <div class="card">
            <h5 class="card-header">Manage FAQ</h5>
            <div class="card-body">
                <!-- Social Accounts -->
                <div class="table-responsive">  
                    <table class="table"> 
                        <thead>
                            <th>#</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($PaymentInfo as $pay)
                                <?php $dt++; ?>
                                <tr>
                                    <td>{{ $dt }}</td>
                                    <td>{{ $pay->question }}</td>
                                    <td>{{ $pay->answer }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                            
                                            <a class="dropdown-item" href="manage_faq/{{ $pay->id }}" onclick="return confirm('Are you sure to delete ?')"
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
                <!-- /Social Accounts -->
            </div>
            </div>
        </div>
        <div class="col-md-5 col-12 mb-md-0 mb-4">
            <div class="card">
            <h5 class="card-header">Add FAQ</h5>
            <div class="card-body">
                <!-- Connections -->
                
                <div class="d-flex">
                    <form action="{{ route('manage_faq') }}"  method="post">
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
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Question</label>
                            <input
                              class="form-control"
                              type="text"
                              id="question"
                              name="question"
                              value="{{ old('question') }}"
                            />
                          </div>@error('question') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Answer</label>
                            <textarea name="answer" id="" cols="30" rows="10" class="form-control"></textarea>
                          </div>@error('details') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                         
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