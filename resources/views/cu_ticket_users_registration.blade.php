@extends('layouts.master')
	@section('title', 'Users Registration')
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
									<h3 class="panel-title text-center">Register</h3>
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
										<label for="password">Password</label>
										<input type="password" class="form-control" name="password" required>
										<br />
										<label for="location">Which are you?</label>
											<select name="type" class="form-control" id="type_select">
												<option value="student">Student</option>
												<option value="staff">Staff</option>
											</select>
                                        <br />
                                        <input type="text" class="form-control" placeholder="Matric Number" name="matric_no" id="studentInput" minlength="10" maxlength="10">
										<input type="text" class="form-control" style="display: none" placeholder="Staff ID" name="staff_id" id="staffInput" minlength="7" maxlength="7">
	                                        
										<br />
											<label for="location">Location</label>
											<input type="text" class="form-control" id="location" name="location" placeholder="e.g Daniel Hall Room 4" required>
										<br />
										<input type="submit" class="btn btn-primary btn-login" value="Register">
										<!-- <small class="text-right"><a href="#">Forgot Password</a></small> -->
									</form>
								</div>
						    </div>
						
					</div>
						<div class="col-md-4"></div>
				</div>
			</div>
		

        @endsection
        
        @section('js')
            <script>
                
                $(document).ready(function(){
                    $("#type_select").on('change', function(){
                        var select_type = $(this).val();
                        
                        if(select_type === 'student'){
                            $("#studentInput").show();
                            $("#staffInput").hide();
                            $("#location").attr("placeholder", "e.g Daniel Hall Room 4");
                        }else{
                            $("#studentInput").hide();
                            $("#staffInput").show();
                            $("#location").attr("placeholder", "e.g Block D2");
                        }
                    })
                });

            </script>
        @endsection

