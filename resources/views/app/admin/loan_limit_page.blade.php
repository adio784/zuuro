@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">QoinCo Loan / </span> Limit
    </h4>

    <div class="row">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-6 col-12 mb-md-0 mb-4">
            <div class="card">
            <h5 class="card-header">Manage Limits</h5>
            <div class="card-body">
                <p>You can reach us through any of these platform </p>
                <!-- Connections -->
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img src="../assets/img/icons/brands/google.png" alt="google" class="me-3" height="30" />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-9 mb-sm-0 mb-2">
                    <h6 class="mb-0">Google</h6>
                    <small class="text-muted">Calendar and contacts</small>
                    </div>
                    <div class="col-3 text-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input float-end" type="checkbox" role="switch" />
                    </div>
                    </div>
                </div>
                </div>
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img src="../assets/img/icons/brands/slack.png" alt="slack" class="me-3" height="30" />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-9 mb-sm-0 mb-2">
                    <h6 class="mb-0">Slack</h6>
                    <small class="text-muted">Communication</small>
                    </div>
                    <div class="col-3 text-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input float-end" type="checkbox" role="switch" checked />
                    </div>
                    </div>
                </div>
                </div>
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img src="../assets/img/icons/brands/github.png" alt="github" class="me-3" height="30" />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-9 mb-sm-0 mb-2">
                    <h6 class="mb-0">Github</h6>
                    <small class="text-muted">Manage your Git repositories</small>
                    </div>
                    <div class="col-3 text-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input float-end" type="checkbox" role="switch" />
                    </div>
                    </div>
                </div>
                </div>
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img
                    src="../assets/img/icons/brands/mailchimp.png"
                    alt="mailchimp"
                    class="me-3"
                    height="30"
                    />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-9 mb-sm-0 mb-2">
                    <h6 class="mb-0">Mailchimp</h6>
                    <small class="text-muted">Email marketing service</small>
                    </div>
                    <div class="col-3 text-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input float-end" type="checkbox" role="switch" checked />
                    </div>
                    </div>
                </div>
                </div>
                <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="../assets/img/icons/brands/asana.png" alt="asana" class="me-3" height="30" />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-9 mb-sm-0 mb-2">
                    <h6 class="mb-0">Asana</h6>
                    <small class="text-muted">Communication</small>
                    </div>
                    <div class="col-3 text-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input float-end" type="checkbox" role="switch" checked />
                    </div>
                    </div>
                </div>
                </div>
                <!-- /Connections -->
            </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card">
            <h5 class="card-header">Add Payment Method</h5>
            <div class="card-body">
                <p>Connect with us on our social accounts</p>
                <!-- Social Accounts -->
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img
                    src="../assets/img/icons/brands/facebook.png"
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
                    src="../assets/img/icons/brands/twitter.png"
                    alt="twitter"
                    class="me-3"
                    height="30"
                    />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                    <h6 class="mb-0">Twitter</h6>
                    <a href="https://twitter.com/QoinCo" target="_blank">@CoQoin</a>
                    </div>
                    <div class="col-4 col-sm-5 text-end">
                    <button type="button" class="btn btn-icon btn-outline-danger">
                        <i class="bx bx-trash-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img
                    src="../assets/img/icons/brands/instagram.png"
                    alt="instagram"
                    class="me-3"
                    height="30"
                    />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                    <h6 class="mb-0">instagram</h6>
                    <a href="https://www.instagram.com/themeselection/" target="_blank">@ThemeSelection</a>
                    </div>
                    <div class="col-4 col-sm-5 text-end">
                    <button type="button" class="btn btn-icon btn-outline-danger">
                        <i class="bx bx-trash-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
                <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <img
                    src="../assets/img/icons/brands/dribbble.png"
                    alt="dribbble"
                    class="me-3"
                    height="30"
                    />
                </div>
                <div class="flex-grow-1 row">
                    <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                    <h6 class="mb-0">Dribbble</h6>
                    <small class="text-muted">Not Connected</small>
                    </div>
                    <div class="col-4 col-sm-5 text-end">
                    <button type="button" class="btn btn-icon btn-outline-secondary">
                        <i class="bx bx-link-alt"></i>
                    </button>
                    </div>
                </div>
                </div>
                <div class="d-flex">
                <div class="flex-shrink-0">
                    <img
                    src="../assets/img/icons/brands/behance.png"
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
                </div>
                <!-- /Social Accounts -->
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection