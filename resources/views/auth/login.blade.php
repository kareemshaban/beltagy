<!doctype html>
<html lang="en">
  <head>
  	<title>Login To DEV-HR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('assets/auth/css/style.css')}}">

	</head>
	<body class="img js-fullheight" style="background-image: url('{{asset("assets/auth/images/bg.jpg")}}');">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">DEV-HR</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center"></h3>
		      	<form  method="POST" action="{{ route('login') }}">
				  @csrf
		      		<div class="form-group">
					  <input type="email" class="form-control" placeholder="Email"
                                                aria-label="Email" aria-describedby="email-addon" id="email"
                                                name="email" >
		      		</div>
	            <div class="form-group">
				<input type="password" class="form-control" placeholder="Password"
                                                aria-label="Password" aria-describedby="password-addon" id="password"
                                                name="password">
	              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
						<input class="form-check-input" type="checkbox" name="remember"
						id="remember" checked="">
									  <span class="checkmark"></span>
									</label>
								</div>
							
	            </div>
	          </form>
	      
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('assets/auth/js/jquery.min.js')}}"></script>
  <script  src="{{asset('assets/auth/js/js/popper.js')}}"></script>
  <script src="{{asset('assets/auth/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/auth/js/main.js')}}"></script>

	</body>
</html>

