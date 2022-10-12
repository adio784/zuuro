@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Zuuro Loan/ </span> Support Page </h4>

    <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <h5 class="card-header">Zuuro Terms & Conditions of Use ...</h5>
            <div class="card-body">
                <p>Terms $ Condition</p>
                <!-- Social Accounts -->
                @foreach($PageInfo as $page)
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0"><a href="{{ '$page->page_link' }}" target="_blank">
                        <img src="{{ asset('images/pdf-download.jpg') }}" alt="t&C" class="me-3" height="30"></a>
                    </div>
                    <div class="flex-grow-1 row">
                        <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                        <h6 class="mb-0">Term of use</h6>
                        <small class="text-muted">{{ $page->file }}</small>
                        </div>
                        <div class="col-4 col-sm-5 text-end">
                        <a href="term_conditions/{{ $page->id }}" onclick="return confirm('Are you sure to delete ?')" class="btn btn-icon btn-outline-danger">
                            <i class="bx bx-trash-alt"></i>
                        </a>
                        </div>
                    </div>
                </div> 
                @endforeach
                <!-- /Social Accounts -->
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
              <h5 class="card-header">Upload Term of Use For User ...</h5>
                    <!-- Data -->
                    
                    <hr class="my-0" />
                    <div class="card-body">
                      <form method="post" enctype="multipart/form-data" action="{{ route('term_conditions') }}">
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
                            <label class="form-label" for="page">Upload File</label>
                            <input type="file" class="form-control" name="termOfUse" required>
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