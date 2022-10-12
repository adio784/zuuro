
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.png" type="image/png" />

    <title>QoinCo ::| - We provide you
                        best and easy
                        services that
                        make life easier.</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-eduwell-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">

  </head>

<body>

  <section class="contact-us" style="margin-top:0px">
    <div class="container align-center">
      <div class="row" style="justify-content: center;align-content:center;text-align: center;">
        <div class="col-lg-4">
          <form id="contact" action="{{ route('register_user') }}" method="post">
              @csrf
            <div class="row">
              <div class="col-lg-12">
                <div class="section-heading">
                  <h6>Register with us</h6>
                  <h4>Sign <em>Up !</em></h4>
                  <p>To enjoy this service, register with us.</p>
                </div>

                <!-- Result  -->
                <div id="result">
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

              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="fullname" id="fullname" placeholder="Full Name" autocomplete="on" required>
                </fieldset>
                @error('fullname') <span class="text-danger text-sm"> {{ $message }}  </span>@enderror
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                </fieldset>
                @error('email') <span class="text-danger text-sm"> {{ $message }} </span>@enderror
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="tel" name="telephone" id="telephone" placeholder="Telephone" autocomplete="on" required>
                </fieldset>
                @error('telephone') <span class="text-danger text-sm"> {{ $message }} </span>@enderror
              </div>
              <div class="col-lg-6">
                <fieldset>
                <input type="date" name="dob" id="dob" placeholder="Date of birth" autocomplete="on" required>
                </fieldset>
                @error('dob') <span class="text-danger text-sm"> {{ $message }} </span> @enderror
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <select class="form-control" name="gender" id="gender" required>
                    <option selected value=""> Gender </option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                  </select>
                </fieldset>
                @error('gender') <span class="text-danger text-sm"> {{ $message }} </span> @enderror
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="username" id="username" placeholder="Username" autocomplete="on" required>
                </fieldset>
                @error('username') <span class="text-danger text-sm"> {{ $message }} </span> @enderror
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="password" name="password" id="password" placeholder="Create password" autocomplete="on" required>
                </fieldset>
                @error('password') <span class="text-danger text-sm"> {{ $message }} </span> @enderror
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="password" name="password_confirmation" id="c_password" placeholder="Confirm password" autocomplete="on" required>
                </fieldset>
                @error('password_confirmation') <span class="text-danger text-sm"> {{ $message }} </span> @enderror
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="text" name="zipcode" id="zipcode" placeholder=" Zip Ccode" autocomplete="on" required>
                  <input type="hidden" name="image" value="assets/img/avatars/usr-img.png">
                </fieldset>
                @error('telephone') <span class="text-danger text-sm"> {{ $message }} </span> @enderror
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <select class="form-control" name="country" id="country" required>
                    <option selected value=""> Country </option>
                    @foreach($CountryInfo as $country)
                              <option>{{ $country->name }}</option>
                              @endforeach
                  </select>
                </fieldset>
                @error('country') <span class="text-danger text-sm"> {{ $message }} </span> @enderror
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="tel" name="address" id="address" placeholder="your address" autocomplete="on" required>
                </fieldset>
                @error('address') <span class="text-danger text-sm"> {{ $message }} </span>@enderror
              </div>
              
              <div class="col-lg-12">
                <fieldset style="text-align:left;">
                    <input type="checkbox" name="agree" id="checkbox" value="1" required style="width:25px; height:15px"> 
                    <small for="checkbox" style="padding-buttom:0px"> Agree to Terms and Conditions</small> <br>
                    <small class="left"> Already have an account, <a href="{{ route('login_user') }}">sign in ... </a>	</small>
                </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="main-gradient-button">Register</button>
                  </fieldset>
                </div>
              
					              
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    
</body>

</html>