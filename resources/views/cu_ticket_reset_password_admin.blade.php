@extends('layouts.master')
	@section('title', 'Password Reset')
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
									@if(\Session::has('flash_msg'))
									<div class="alert alert-{{\Session::get('type', 'info')}} alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										{{ \Session::get("flash_msg") }}
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
									<h3 class="panel-title text-center">Reset Password</h3>
								</div>
								<div class="panel-body">
									<form action="{{route('reset_action_admin')}}" method="post" class="form-group">
										{{csrf_field()}}
										<input type="hidden" name="email" value="{{$email}}" />

										<label for="new_pin">New Pin</label>
										<input type="password" class="form-control" name="new_pin" required>
										<br />

										<label for="confirm_pin">Confirm Pin</label>
										<input type="password" class="form-control" name="confirm_pin" required>
										<br />

										<input type="submit" class="btn btn-primary btn-login" value="Reset">
									</form>
								</div>
						    </div>
						 
					</div>
						<div class="col-md-4"></div>
				</div>
			</div>
		
		@endsection
