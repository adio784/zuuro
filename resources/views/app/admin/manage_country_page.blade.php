@extends('app.admin.admin_layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Account Settings / </span> Countries
    </h4>

    <div class="row">
    <div class="col-md-12">
        <div class="row">
        
        <div class="col-md-7 col-12">
            <div class="card">
            <h5 class="card-header">Add Country</h5>
            <div class="card-body">
                <p>Connect with us on our social accounts</p>
                <!-- Social Accounts -->
                <div class="table-responsive">  
                    <table class="table"> 
                        <thead>
                            <th>#</th>
                            <th>Country</th>
                            <th>ISO3</th>
                            <th>Phonecode</th>
                            {{-- <th>Capital</th> --}}
                            {{-- <th>Currency Name</th> --}}
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($CountryInfo as $country)
                            <?php $dt++; ?>
                                <tr>
                                    <td>{{ $dt }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->iso3 }}</td>
                                    <td>{{ $country->phonecode }}</td>
                                    {{-- <td>{{ /*$country->capital*/ }}</td> --}}
                                    {{-- <td>{{ $country->currency }}</td>
                                    <td>{{ $country->currency_name }}</td> --}}
                                    <td></td>
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
            <h5 class="card-header">Add Country</h5>
            <div class="card-body">
                <p>Add new country who can use this service </p>
                <!-- Connections -->
                
                <div class="d-flex">
                    <form action="{{ route('manage_country_page') }}" id="country_form" method="post">
                        @csrf
                    <!-- Result  -->
                <div id="result">
                    @if(Session::get('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}
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


                    <div class="row">
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Country Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="countryName"
                              name="countryName"
                              value="{{ old('countryName') }}"
                            />
                          </div>@error('countryName') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Short Code</label>
                            <input
                              class="form-control"
                              type="text"
                              id="shortcode"
                              name="shortcode"
                              value="{{ old('shortcode') }}"
                              placeholder="NGN"
                            />
                          </div>@error('shortcode') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Phone Code</label>
                            <input
                              class="form-control"
                              type="text"
                              id="phonecode"
                              name="phonecode"
                              value="{{ old('phonecode') }}"
                              placeholder="eg: +234"
                            />
                          </div>@error('phonecode') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          <div class="mb-3 col-md-12 col-lg-12">
                            <label for="firstName" class="form-label">Capital</label>
                            <input
                              class="form-control"
                              type="text"
                              id="capital"
                              name="capital"
                              value="{{ old('capital') }}"
                              placeholder="eg: Abuja"
                            />
                          </div>@error('capital') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          <div class="mb-3 col-md-6 col-lg-6">
                            <label for="firstName" class="form-label">Currency Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="currency"
                              name="currency"
                              value="{{ old('currency') }}"
                              placeholder="eg: N"
                            />
                            @error('currency') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
                          <div class="mb-3 col-md-6 col-lg-6">
                            <label for="firstName" class="form-label">Currency Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="currency_name"
                              name="currency_name"
                              value="{{ old('currency_name') }}"
                              placeholder="eg: Naira"
                            />
                            @error('currency_name') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
                          </div>
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