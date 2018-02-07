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

							<div class="row">
								<div class="col-md-12">
									@if(\Session::has('email_in_db'))
									<div class="alert alert-warning alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										{{ \Session::get("email_in_db") }}
									</div>
									@endif
									@if(\Session::has('matric_in_db'))
									<div class="alert alert-warning alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										{{ \Session::get("matric_in_db") }}
									</div>
									@endif
									@if(\Session::has('staffID_in_db'))
									<div class="alert alert-warning alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										{{ \Session::get("staffID_in_db") }}
									</div>
									@endif
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title text-center">Registration Page</h3>
								</div>
								<div class="panel-body">
									<form action="{{ route('create_user') }}" method="POST" class="form-group">
										{{csrf_field()}}
										<label for="Name">Name</label>
										<input type="text" class="form-control" name="name" required>
										<br />
										<label for="Email">Email</label>
										<input type="email" class="form-control" name="email" required>
										<br />
										<LABEL for="password">Password</LABEL>
										<input type="password" class="form-control" name="password" required>
										<br />
										<label for="location">Location</label>
										<input type="text" class="form-control" name="location" required>
										<br />
										<select name="type" class="form-control" onchange="fun()" id="messagetype">
											<option disabled="">Select Type</option>
											<option value="student" class="clicked_stu">Student</option>
											<option value="staff" class="clicked_staff">Staff</option>
										</select>
										<br />
										<div id="mobileno_textbox">
										<input type="text" class="form-control" style="display: none;" id="mobileno" placeholder="Matric Number" name="matric_no">
										</div>
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
		@section('js')
		<script type="text/javascript">
		
		function fun() {
			var select_status = $("#messagetype").val();
			if(select_status == 'student') {
				$("#mobileno_textbox").show();
			}
			else {
				$("#mobileno_textbox").hide();
			}
		}
		</script>
		@endsection