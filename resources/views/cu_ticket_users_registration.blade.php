@extends('layouts.master')
	@section('title', 'Users Registration')
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
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title text-center">Registration Page</h3>
								</div>
								<div class="panel-body">
									<form action="{{ route('create_user') }}" method="POST" class="form-group">
										{{csrf_field()}}
										
										<input type="text" class="form-control" placeholder="Name" name="name" required>
										<br />

										<input type="email" class="form-control" placeholder="Email" name="email" required>
										<br />
									
										<input type="password" class="form-control" placeholder="Password" name="password" required>
										<br />
										<input type="text" class="form-control" placeholder="Location" name="location" required>
										<br />
										<select name="type" class="form-control">
											<option value="student">Student</option>
											<option value="staff">Staff</option>
										</select>
										<br />
										<input type="text" class="form-control" placeholder="Matric Number" name="matric_no">
										<br />
										<input type="text" class="form-control" placeholder="Staff Identity" name="staff_id">
										<br />
										<input type="submit" class="btn btn-primary btn-login" value="Register">
										<small class="text-right"><a href="#">Forgot Password</a></small>
									</form>
								</div>
						    </div>
						
					</div>
						<div class="col-md-4"></div>
				</div>
			</div>
		
		@endsection
