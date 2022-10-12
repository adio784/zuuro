
<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" type="text/css" href="assets/css/login-style.css">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
</head>
<body  style="">
	<section id="login" class="login-section">
		<div class="container">
			<div class="row" style="justify-content: center;align-content:center;">
				<div class="col-lg-4 col-sm-8">
					<div class="card" id="login">
						<div class="img-section">
							<img src="assets/images/login-icon.png">
						</div>
						<div class="card-body">
							<form action="{{ route('login_user') }}" method="post">
                                @csrf
					            <div class="row">
					              <div class="col-lg-12">
					                <div class="section-heading">
					                  <h4>Sign <em>In !</em></h4>
					                  <!-- <h5 class="mt-4">We back, enjoy cheaper service</h5> -->
					                </div>

                                    <!-- Error Message -->
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
					                  <input type="name" name="username" id="username" placeholder="Username" autocomplete="on" required>
					                </fieldset>
					              </div>
					              <div class="col-lg-12">
					                <fieldset>
					                  <input type="password" name="password" id="password" placeholder="Password" autocomplete="on" required>
					                </fieldset>
					              </div>
                                  <div class="col-lg-12">
                                    <fieldset style="text-align:left;">
                                        <input type="checkbox" name="remember" id="remember"  > 
                                        <label for="checkbox"> Remember Me</label>

                                    </fieldset>
                                    </div>
					              <p><a href="{{ route('forget-password') }}"> Forget password </a>	</p>
					            
					              <div class="col-lg-12">
					                <fieldset>
					                  <button type="submit" id="form-submit" class="main-gradient-button">Login</button>
					                </fieldset>
					              </div>
					            </div>
					          </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>