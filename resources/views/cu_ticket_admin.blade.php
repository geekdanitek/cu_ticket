@extends('layouts.admin_master')
	@section('name', $name)
	@section('title', 'Admin')
		@section('content')

		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-6">
					<div class="block">
							<div class="row">
								<div class="col-xs-4 admin-icon">
									<span class="glyphicon glyphicon-list-alt"></span>
								</div>
								<div class="col-xs-8 admin-num">
									<h1>{{$total_amount}}</h1>
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12 admin-text">
									<h3>Total Tickets</h3>
								</div>
							</div>
							
						
					</div>
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="block">
						<div class="row">
								<div class="col-xs-4 admin-icon">
									<span class="glyphicon glyphicon-ok"></span>
								</div>
								<div class="col-xs-8 admin-num">
									<h1>{{ $open_amount }}</h1>
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12 admin-text">
									<h3>Open Ticket</h3>
								</div>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="block">
						<div class="row">
								<div class="col-xs-4 admin-icon">
									<span class="glyphicon glyphicon-refresh"></span>
								</div>
								<div class="col-xs-8 admin-num">
									<h1>{{ $pending_amount }}</h1>
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12 admin-text">
									<h3>Pending Tickets</h3>
								</div>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="block">
						<div class="row">
								<div class="col-xs-4 admin-icon">
									<span class="glyphicon glyphicon-remove"></span>
								</div>
								<div class="col-xs-8 admin-num">
									<h1>{{ $rejected_amount }}</h1>
								</div>
							</div>
							<div class="row ">
								<div class="col-md-12 admin-text">
									<h3>Rejected Tickets</h3>
								</div>
							</div>
					</div>
				</div>
			</div>
			<hr  style="border: solid 1px #6f3f6f;" />
			<div class="row">
				<div class="col-md-12">
					<div class="queue-tab">
						<div class="row">
							<div class="col-md-2 col-xs-6 queue-nav">
								<div>
									<div class="list-group">
									  @foreach($queues as $queue)
									  <a href="#" class="list-group-item">
									   {{$queue->name}}  <span class="badge">2</span>
									  </a>
									  @endforeach
									</div>
								</div>
							</div>
							<div class="col-md-10 col-xs-6">
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>
									Subject
								</th>
								<th>
									Description
								</th>
								<th>
									Time
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
							@foreach($tickets_table as $tickets)
								<tr>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@endsection