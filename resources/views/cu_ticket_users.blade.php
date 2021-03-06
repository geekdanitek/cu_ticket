@extends("layouts.admin_master")
@section('name', \Session::get('user')->name)
@section('title', 'User')
@section('content')
<script type="text/javascript">
		// $(document).ready( function () {
				// 	activeTab('home');
		// });
		// $(".ade").click(function(){
	//        activeTab('ios');
	//     });
		// function activeTab(tab) {
				// 	$('.nav-tabs a[href="#' + tab + '"]').tab('show');
		// };
</script>
<div class="container">

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
		<div class="col-md-2"></div>
			<div class="col-md-8">
			<div class="btn-group btn-group-justified btn-user-status">
				<a href="#" class="btn btn-default active status-select" data-link="all">All</a>
				<a href="#" class="btn btn-default status-select" data-link="new">New</a>
				<a href="#" class="btn btn-default status-select" data-link="inprogress">Inprogress</a>
				<a href="#" class="btn btn-default status-select" data-link="rejected">Rejected</a>
				<a href="#" class="btn btn-default status-select" data-link="finished">Accepted</a>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
		<hr style="border: solid 1px #6f3f6f;">
	<div class="row">
		<div class="col-md-6">
			<h3 class="pull-left">Your Tickets</h3>
		</div>
		<div class="col-md-6">
			<a href="" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" style="margin-top: 15px;">
				Create New Ticket
			</a>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title ade text-center" id="exampleModalLabel">Create a new ticket</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10 text-center">
							<div class="row">
								<div class="col-md-12">
									<!-- <h3 class="ade">Create a new ticket</h3> -->
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-md-12">
									@if(\Session::has("failure"))
									<div class="alert alert-danger">
										{{\Session::get("failure")}}
									</div>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									@if(\Session::has("success"))
									<div class="alert alert-success">
										{{\Session::get("success")}}
									</div>
									@endif
								</div>
							</div> -->
							<div class="row">
								
							</div>
							<form action="{{ route('create_ticket') }}" method="post" class="form-group ticket_form" enctype="multipart/form-data">
								{{csrf_field()}}
								
								<div class="row">
									<div class="col-md-12">
										<label for="subject" class="pull-left">Subject</label>
										<input type="text" name="subject" class="form-control" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="description" class="pull-left">Description</label>
										<textarea class="form-control" rows="3" name="description" required></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="date" class="pull-left">Date Available</label>
										<input type="date" name="time" class="form-control" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="queues" class="pull-left">Queues</label>
										<select name="queue" class="form-control">
											@foreach($queues as $queue)
												<option value="{{ $queue->id }}">{{ $queue->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="location" class="pull-left">Location</label>
										<input type="text" name="location" class="form-control" value="{{ \Session::get('user')->location }}" required>
									</div>
								</div>
								<!-- <div class="row">
									<div class="col-md-12">
										<label for="picture" class="pull-left">Picture</label>
										<input type="file" name="picture" class="form-control">
									</div>
								</div> -->
								<!-- <div class="row">
											<div class="col-md-12">
														<input type="submit" class="btn btn-default btn-user form-control" value="Submit">
											</div>
											
								</div> -->
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
	
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive myTableSelect" id="table_all">
				<table class="table table-hover myTable">
					<thead>
						<tr>
							<th class="col-md-2">
								Subject
							</th>
							<th>
								Description
							</th>
							<th class="col-md-2">
								Date Available
							</th>
							<th>
								Queue
							</th>
							<th>
								Location
							</th>
							<!-- <th>
								Picture
							</th> -->
							<th>
								Status
							</th>
							<th class="col-md-2">
								Created
							</th>
						</tr>
					</thead>
					<tbody>
						@if(count($users_ticket) < 1)
						<tr>
							<td colspan="7">
								<div class="alert alert-info text-center" role="alert">
									Table is empty
								</div>
							</td>
						</tr>
						@endif
						@foreach($users_ticket as $user_ticket)
						<tr class="
							@if($user_ticket->status == 'rejected')
								danger
							@endif
							@if($user_ticket->status == 'inprogress')
								warning
							@endif
							@if($user_ticket->status == 'finished')
								success
							@endif
						">
							<td>
								{{$user_ticket->subject}}
							</td>
							<td>
								{{$user_ticket->description}}
							</td>
							<td title="{{$user_ticket->date}}">
								{{$user_ticket->date->diffForHumans()}}
							</td>
							<td>
								{{$user_ticket->queue->name}}
							</td>
							<td>
								{{$user_ticket->location}}
							</td>
							<!-- <td>
								{{$user_ticket->picture}}
							</td> -->
							<td>
								{{$user_ticket->status}}
							</td>
							<td title="{{$user_ticket->created_at}}">
								{{$user_ticket->created_at->diffForHumans()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-md-12">
			
			<div class="table-responsive myTableSelect" id="table_new">
				<table class="table table-hover myTable">
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
							<!-- <th>
								Picture
							</th> -->
							<th>
								Status
							</th>
							<th>
								Created
							</th>
						</tr>
					</thead>
					<tbody>
						@if(count($users_ticket_new) < 1)
						<tr>
							<td colspan="7">
								<div class="alert alert-info text-center" role="alert">
									Table is empty
								</div>
							</td>
						</tr>
						@endif
						@foreach($users_ticket_new as $user_ticket)
						<tr>
							<td class="col-md-2">
								{{$user_ticket->subject}}
							</td>
							<td>
								{{$user_ticket->description}}
							</td>
							<td class="col-md-2">
								{{$user_ticket->date->diffForHumans()}}
							</td>
							<td>
								{{$user_ticket->queue->name}}
							</td>
							<td>
								{{$user_ticket->location}}
							</td>
							<!-- <td>
								{{$user_ticket->picture}}
							</td> -->
							<td>
								{{$user_ticket->status}}
							</td>
							<td class="col-md-2" title="{{$user_ticket->created_at}}">
								{{$user_ticket->created_at->diffForHumans()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
		</div>

		<div class="col-md-12">
			
			<div class="table-responsive myTableSelect" id="table_inprogress">
				<table class="table table-hover myTable">
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
							<!-- <th>
								Picture
							</th> -->
							<th>
								Status
							</th>
							<th>
								Created
							</th>
						</tr>
					</thead>
					<tbody>
						@if(count($users_ticket_inprogress) < 1)
						<tr>
							<td colspan="7">
								<div class="alert alert-info text-center" role="alert">
									Table is empty
								</div>
							</td>
						</tr>
						@endif
						@foreach($users_ticket_inprogress as $user_ticket)
						<tr>
							<td class="col-md-2">
								{{$user_ticket->subject}}
							</td>
							<td>
								{{$user_ticket->description}}
							</td>
							<td class="col-md-2">
								{{$user_ticket->date->diffForHumans()}}
							</td>
							<td>
								{{$user_ticket->queue->name}}
							</td>
							<td>
								{{$user_ticket->location}}
							</td>
							<!-- <td>
								{{$user_ticket->picture}}
							</td> -->
							<td>
								{{$user_ticket->status}}
							</td>
							<td class="col-md-2" title="{{$user_ticket->created_at}}">
								{{$user_ticket->created_at->diffForHumans()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
		</div>

		<div class="col-md-12">
			
			<div class="table-responsive myTableSelect" id="table_rejected">
				<table class="table table-hover myTable">
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
							<!-- <th>
								Picture
							</th> -->
							<th>
								Status
							</th>
							<th>
								Created
							</th>
						</tr>
					</thead>
					<tbody>
						@if(count($users_ticket_rejected) < 1)
						<tr>
							<td colspan="7">
								<div class="alert alert-info text-center" role="alert">
									Table is empty
								</div>
							</td>
						</tr>
						@endif
						@foreach($users_ticket_rejected as $user_ticket)
						<tr>
							<td class="col-md-2">
								{{$user_ticket->subject}}
							</td>
							<td>
								{{$user_ticket->description}}
							</td>
							<td class="col-md-2">
								{{$user_ticket->date->diffForHumans()}}
							</td>
							<td>
								{{$user_ticket->queue->name}}
							</td>
							<td>
								{{$user_ticket->location}}
							</td>
							<!-- <td>
								{{$user_ticket->picture}}
							</td> -->
							<td>
								{{$user_ticket->status}}
							</td>
							<td class="col-md-2" title="{{$user_ticket->created_at}}">
								{{$user_ticket->created_at->diffForHumans()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
		</div>

				<div class="col-md-12">
			
			<div class="table-responsive myTableSelect" id="table_finished">
				<table class="table table-hover myTable">
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
							<!-- <th>
								Picture
							</th> -->
							<th>
								Status
							</th>
							<th>
								Created
							</th>
						</tr>
					</thead>
					<tbody>
						@if(count($users_ticket_finished) < 1)
						<tr>
							<td colspan="7">
								<div class="alert alert-info text-center" role="alert">
									Table is empty
								</div>
							</td>
						</tr>
						@endif
						@foreach($users_ticket_finished as $user_ticket)
						<tr>
							<td class="col-md-2">
								{{$user_ticket->subject}}
							</td>
							<td>
								{{$user_ticket->description}}
							</td>
							<td class="col-md-2">
								{{$user_ticket->date->diffForHumans()}}
							</td>
							<td>
								{{$user_ticket->queue->name}}
							</td>
							<td>
								{{$user_ticket->location}}
							</td>
							<!-- <td>
								{{$user_ticket->picture}}
							</td> -->
							<td>
								{{$user_ticket->status}}
							</td>
							<td class="col-md-2" title="{{$user_ticket->created_at}}">
								{{$user_ticket->created_at->diffForHumans()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			
		</div>

	</div>
</div>
@endsection
@section('js')
	<script type="text/javascript">
		$(".myTableSelect").hide();
		 $("#table_all").show();             
        $(".status-select").click(function(event) {
		$(".status-select").removeClass('active');
		$(this).addClass('active');
		var name = $(this).attr('data-link');
		$(".myTableSelect").hide();
		$("#table_all").hide();
		$("#table_" + name).show();
		
	});
	</script>
@endsection