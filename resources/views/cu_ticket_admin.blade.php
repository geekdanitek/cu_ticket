@extends('layouts.admin_master')
@section('name', \Session::get('admin_user')->name)
@section('title', 'Admin')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-1">
			
		</div>
		<div class="col-md-2 col-xs-6">
			<div class="block">
				<a href='{{route("tickets")}}'>
					<div class="row">
						<div class="col-xs-6 admin-icon">
							<span class="glyphicon glyphicon-list-alt"></span>
						</div>
						<div class="col-xs-6 admin-num">
							<h1>{{$total_amount}}</h1>
						</div>
					</div>
					<div class="row ">
						<div class="col-md-12 admin-text">
							<h3>Total Tickets</h3>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-2 col-xs-6">
			<div class="block">
				<a href="{{route('tickets', ['status' => 'new'])}}">
					<div class="row">
						<div class="col-xs-6 admin-icon">
							<span class="glyphicon glyphicon-star"></span>
						</div>
						<div class="col-xs-6 admin-num">
							<h1>{{ $open_amount }}</h1>
						</div>
					</div>
					<div class="row ">
						<div class="col-md-12 admin-text">
							<h3>New Ticket</h3>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-2 col-xs-6">
			<div class="block">
				<a href="{{route('tickets', ['status' => 'inprogress'])}}">
					<div class="row">
						<div class="col-xs-6 admin-icon">
							<span class="glyphicon glyphicon-refresh"></span>
						</div>
						<div class="col-xs-6 admin-num">
							<h1>{{ $pending_amount }}</h1>
						</div>
					</div>
					<div class="row ">
						<div class="col-md-12 admin-text">
							<h3>Pending Tickets</h3>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-2 col-xs-6">
			<div class="block">
				<a href="{{route('tickets', ['status' => 'rejected'])}}">
					<div class="row">
						<div class="col-xs-6 admin-icon">
							<span class="glyphicon glyphicon-remove"></span>
						</div>
						<div class="col-xs-6 admin-num">
							<h1>{{ $rejected_amount }}</h1>
						</div>
					</div>
					<div class="row ">
						<div class="col-md-12 admin-text">
							<h3>Rejected Tickets</h3>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-2 col-xs-6">
			<div class="block">
				<a href="{{route('tickets', ['status' => 'finished'])}}">
					<div class="row">
						<div class="col-xs-6 admin-icon">
							<span class="glyphicon glyphicon-ok"></span>
						</div>
						<div class="col-xs-6 admin-num">
							<h1>{{ $finished_amount }}</h1>
						</div>
					</div>
					<div class="row ">
						<div class="col-md-12 admin-text">
							<h3>Accepted Tickets</h3>
						</div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-md-1">
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			@if(\Session::has("add_queues_success"))
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{\Session::get("add_queues_success")}}
				</div>
			@endif

			@if(\Session::has("add_queues_failure"))
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{\Session::get("add_queues_failure")}}
				</div>
			@endif
			
		</div>
	</div>
	<hr  style="border: solid 1px #6f3f6f;" />
	<div class="row">
		<div class="col-md-12">
			<div class="queue-tab">
				<div class="row">
					<div class="col-md-2 col-xs-6 queue-nav">
						<div class="left-tab-button">
						
							<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">Add Queues</button>
							<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal2">Add Users</button>
						</div>
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title ade text-center" id="exampleModalLabel">Add Queues</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-1"></div>
											<div class="col-md-10 text-center">
												
												<form action="{{ route('create_queues') }}" method="post" class="form-group ticket_form" enctype="multipart/form-data">
													{{csrf_field()}}
													
													<div class="row">
														<div class="col-md-12">
															<label for="subject" class="pull-left">Name</label>
															<input type="text" name="name" class="form-control" required>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<input type="submit" class="btn btn-default btn-user" value="submit">
													</div>
												</form>
											</div>
											<div class="col-md-1"></div>
										</div>
										
									</div>
									
								</div>
							</div>
						</div>


						<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h3 class="modal-title ade text-center" id="exampleModalLabel">Add Users</h3>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-1"></div>
											<div class="col-md-10 text-center">
												
												<form action="{{ route('create_admin') }}" method="post" class="form-group ticket_form" enctype="multipart/form-data">
													{{csrf_field()}}
													
													<div class="row">
														<div class="col-md-12">
															<label for="subject" class="pull-left">Name</label>
															<input type="text" name="name" class="form-control" required>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<label for="subject" class="pull-left">Email</label>
															<input type="email" name="eamil" class="form-control" required>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<label for="Admin_Type" class="pull-left">Admin Type</label>
															<select name="type" class="form-control">
												
																<option value="user" class="form-control">User</option>
																<option value="super" class="form-control">Super</option>
																
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<input type="submit" class="btn btn-default btn-user" value="submit">
													</div>
												</form>
											</div>
											<div class="col-md-1"></div>
										</div>
										
									</div>
									
								</div>
							</div>
						</div>

						<div>
							<div class="list-group">
								@foreach($queues as $queue)
								<a href="#" class="list-group-item left-tab" data-link="{{$queue->name}}">
									{{$queue->name}}  <span class="badge">{{$queue->tickets->count()}}</span>
								</a>
								@endforeach
							</div>
						</div>
						
					</div>
					<div class="col-md-10 col-xs-6">
						<div class="table-responsive default">
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th class="text-center">
											Please select a queue
										</th>
									</tr>
								</thead>
							</table>
						</div>
						@foreach($queues as $queue)
						<div class="table-responsive queue_tables" id="table_{{$queue->name}}">
							<table class="table table-hover table-bordered myTable">
								<thead>
									<tr>
										<th>
											Subject
										</th>
										<th>
											Description
										</th>
										<th>
											Date Available
										</th>
										<th>
											Queue
										</th>
										<th>
											Location
										</th>
										<th>
											Picture
										</th>
										<th>
											Status
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($queue->tickets as $tickets)
									<tr class="
										@if($tickets->status == 'rejected')
										danger
										@endif
										@if($tickets->status == 'inprogress')
										warning
										@endif
										@if($tickets->status == 'finished')
										success
										@endif
										">
										<td>
											{{$tickets->subject}}
										</td>
										<td>
											{{$tickets->description}}
										</td>
										<td>
											{{$tickets->date}}
										</td>
										<td>
											{{$tickets->queue_id}}
										</td>
										<td>
											{{$tickets->location}}
										</td>
										<td>
											{{$tickets->picture}}
										</td>
										<td>
											{{$tickets->status}}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- </div> -->
@endsection
@section('js')
<script type="text/javascript">
	$(".queue_tables").hide();
	$(".left-tab").click(function(event) {
		$(".left-tab").removeClass('active');
		$(this).addClass('active');
		var name = $(this).attr('data-link');
		$(".queue_tables").hide();
		$(".default").hide();
		$("#table_" + name).show();
		
	});
</script>
@endsection