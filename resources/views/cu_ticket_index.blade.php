@extends('layouts.master')
	@section('title', 'Login')
		@section('content')
		
			<div class="container">
				<div class="row">
					<div class="col-md-4"></div>
						<div class="login-content col-md-4">
							<div class="row">
								<div class="col-md-4 col-xs-4"></div>
									<div class="col-md-4 col-xs-4">
										<img src="{{ url('images/CU_LOGO.jpg') }}" class="img-responsive text-center">
									</div>
								<div class="col-md-4 col-xs-4"></div>
							</div>

							<div class="row">
								<div class="col-md-12">
									@if(\Session::has('login_error'))
									<div class="alert alert-warning alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										{{ \Session::get("login_error") }}
									</div>
									@endif

									@if(\Session::has('not_logged_in'))
									<div class="alert alert-warning alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										{{ \Session::get("not_logged_in") }}
									</div>
									@endif


									@if(\Session::has('logout_success'))
									<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										{{ \Session::get('logout_success') }}
									</div>
									@endif

									@if(\Session::has('reg_success'))
									<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										{{ \Session::get('reg_success') }}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h3 class="text-center">CU Ticket Registration System</h3>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title text-center">Login</h3>
								</div>
								<div class="panel-body">
									<form action="{{route('login')}}" method="post" class="form-group">
										{{csrf_field()}}
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email" required>
										<br />
										<label for="password">Password</label>
										<input type="password" class="form-control" name="password" required>
										<br />
										<input type="submit" class="btn btn-primary btn-login" value="Login">
										<small class="text-right"><a href="#">Forgot Password</a></small>
									</form>
								</div>
						    </div>
						    <div class="row">
						    	<div class="col-md-12">
						    		<div class="text-center">
							  			<a href="{{ route('register') }}" class="text-center"><button class="btn btn-link">Don't have an account? Register here</button></a>
							  		</div>
								</div>
							</div>
					</div>
						<div class="col-md-4"></div>
				</div>
			</div>
		
		@endsection
