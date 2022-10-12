@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Account Settings / </span> Term of Use 
    </h4>

    <div class="row">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
            <h5 class="card-header">Zuuro Telecommunication terms and condition</h5>
            <div class="card-body" style="height: 700px">
                <p>T & C </p>
                <!-- Social Accounts -->
                <div class="d-flex mb-3">
                    <iframe src="{{ asset('uploads/'.$TermofUse->fileName)}}" frameborder="0" width="100%" height="600px"></iframe>
                        
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