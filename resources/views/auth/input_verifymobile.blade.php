@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ 'Input OTP sent to your number: '. session('phone_number') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ ('verify_otp') }}">
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

                        <div class="row mb-3 mt-4">
                            <label for="verification_code" class="col-md-4 col-form-label text-md-end">{{ __('OTP') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="phone_number" value="{{session('phone_number')}}">
                                <input type="tel" name="verification_code" id="verification_code" class="form-control @error('verification_code') is-invalid @enderror" value="{{ old('verification_code') }}" required autocomplete="verification_code" autofocus>

                                @error('verification_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
