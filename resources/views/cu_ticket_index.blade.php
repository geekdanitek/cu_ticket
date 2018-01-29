@extends('layouts.master')
	@section('title', 'Login')
		@section('content')
		
			<div class="container">
				<div class="row">
					<div class="col-md-4"></div>
						<div class="login-content col-md-4">
							<div class="row">
								<div class="col-md-4"></div>
									<div class="col-md-4">
										<img src="{{ url('images/CU_LOGO.jpg') }}" class="img-responsive text-center">
									</div>
								<div class="col-md-4"></div>
							</div>

							<div class="row">
								<div class="col-md-12">
									@if(\Session::has('login_error'))
									<div class="alert alert-warning">
										{{ \Session::get("login_error") }}
									</div>
									@endif
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title text-center">Login</h3>
								</div>
								<div class="panel-body">
									<form action="" method="post" class="form-group">
										{{csrf_field()}}
										<input type="email" class="form-control" placeholder="email" name="email" required>
										<br />
										<input type="password" class="form-control" placeholder="password" name="password" required>
										<br />
										<input type="submit" class="btn btn-primary btn-login" value="Login">
										<small class="text-right"><a href="#">Forgot Password</a></small>
									</form>
								</div>
						    </div>
						  <a href="{{ route("admin_login") }}" class="text-center"><button class="btn-primary btn-login">admin log-in</button></a>
					</div>
						<div class="col-md-4"></div>
				</div>
			</div>
		
		@endsection
