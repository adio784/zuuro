@extends('layouts.app')
{{-- <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Success!</div>
          <small>{{ date('m') }}</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ Session::get('success') }}
        </div>
      </div> --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header">{{ __('Create your 4 digit PIN') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ ('create_pin') }}">
                        @csrf
<!-- Result  -->
<div id="result234">
    @if(Session::get('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>Suceess! </strong> {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    
    @endif
    @if(Session::get('fail'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>Oh Oops! </strong> {{ Session::get('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
</div>

                        <div class="row mb-3 mt-4">
                            <label for="pin" class="col-md-4 col-form-label text-md-end">{{ __('Create PIN') }}</label>

                            <div class="col-md-6">
                                <input id="pin" type="password" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{ old('pin') }}" required autocomplete="pin" autofocus>

                                @error('pin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pin-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm PIN') }}</label>

                            <div class="col-md-6">
                                <input id="pin-confirm" type="password" class="form-control" name="pin_confirmation" required autocomplete="new-pin">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
