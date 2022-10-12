@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Account Settings / </span> Customer Support
    </h4>

    <div class="row">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-8 col-12">
            <div class="card">
            <h5 class="card-header">Social Accounts</h5>
            <div class="card-body">
                <p>Connect with us on our social accounts</p>
                <!-- Social Accounts -->
                @foreach($PageInfo as $page)
                
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0"><a href="{{ $page->page_link }}" target="_blank">
                        <img src="{{ $page->page_icon }}" alt="facebook" class="me-3" height="30"></a>
                    </div>
                    <div class="flex-grow-1 row">
                        <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                        <h6 class="mb-0">{{ $page->page_type }}</h6>
                        <small class="text-muted">{{ $page->page_name }}</small>
                        </div>
                        <div class="col-4 col-sm-5 text-end">
                        <a href="{{ $page->page_link }}" onclick="return confirm('Are you sure you want to leave this page ?')" class="btn btn-icon btn-outline-secondary">
                            <i class="bx bx-link-alt"></i>
                        </a>
                        </div>
                    </div>
                </div> 
                @endforeach
                {{-- <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img
                    src="{{ asset('img/icons/brands/facebook.png') }}"
                    alt="facebook"
                    class="me-3"
                    height="30"
                    />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                    <h6 class="mb-0">Facebook</h6>
                    <small class="text-muted">The largest social community</small>
                    </div>
                    <div class="col-4 col-sm-5 text-end">
                    <button type="button" class="btn btn-icon btn-outline-secondary">
                        <i class="bx bx-link-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img
                    src="{{ asset('img/icons/brands/twitter.png') }}"
                    alt="twitter"
                    class="me-3"
                    height="30"
                    />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                    <h6 class="mb-0">Twitter</h6>
                    <a href="https://twitter.com/Zuuro" target="_blank">@CoQoin</a>
                    </div>
                    <div class="col-4 col-sm-5 text-end">
                    <button type="button" class="btn btn-icon btn-outline-secondary">
                        <i class="bx bx-link-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img
                    src="{{ asset('img/icons/brands/instagram.png') }}"
                    alt="instagram"
                    class="me-3"
                    height="30"
                    />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                    <h6 class="mb-0">instagram</h6>
                    <a href="https://www.instagram.com/Zuuro/" target="_blank">@Zuuro</a>
                    </div>
                    <div class="col-4 col-sm-5 text-end">
                    <button type="button" class="btn btn-icon btn-outline-secondary">
                        <i class="bx bx-link-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img src="{{ asset('img/icons/brands/google.png') }}" alt="google" class="me-3" height="30" />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-9 mb-sm-0 mb-2">
                    <h6 class="mb-0">Google</h6>
                    <small class="text-muted">Mail us on google: support@Zuuro.com</small>
                    </div>
                    <div class="col-2 col-sm-3 text-end">
                    <button type="button" class="btn btn-icon btn-outline-secondary">
                        <i class="bx bx-link-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
                <div class="d-flex">
                <div class="flex-shrink-0">
                    <img
                    src="{{ asset('img/icons/brands/behance.png') }}"
                    alt="behance"
                    class="me-3"
                    height="30"
                    />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                    <h6 class="mb-0">Behance</h6>
                    <small class="text-muted">Not Connected</small>
                    </div>
                    <div class="col-4 col-sm-5 text-end">
                    <button type="button" class="btn btn-icon btn-outline-secondary">
                        <i class="bx bx-link-alt"></i>
                    </button>
                    </div>
                </div>
                </div> --}}
                <!-- /Social Accounts -->
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection