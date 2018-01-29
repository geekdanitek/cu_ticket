@extends("layouts.admin_master")

@section('name', \Auth::user())

@section('title', 'User')
@section('content')
<div class="container">
	<ul id="myTab" class="nav nav-tabs">
		<li class="active">
			<a href="#home" data-toggle="tab">
				TICKETS {{dd(\Auth::user())}}
			</a>
		</li>
		<li><a href="#ios" data-toggle="tab">Create New Ticket</a></li>

	</ul>
	
	<div id="myTabContent" class="tab-content">
		
			<div class="tab-pane fade in active" id="home">
				<div class="table-responsive">
					<table class="table table-hover">
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
							<tr>
								<td>
								Broken Socket
								</td>
								<td>
									bla bla bla bla gijn........
								</td>
								<td>
									12/07/18
								</td>
								<td>
									Plumbing
								</td>
								<td>
									Daniel - Hall (Room : 321)
								</td>
								<td>
									img/queuepics.jpg
								</td>
								<td>
									Pending
								</td>
							</tr>
							<tr>
								<td>
								Broken Socket
								</td>
								<td>
									bla bla bla bla gijn........
								</td>
								<td>
									12/07/18
								</td>
								<td>
									Plumbing
								</td>
								<td>
									Daniel - Hall (Room : 321)
								</td>
								<td>
									img/queuepics.jpg
								</td>
								<td>
									Pending
								</td>
							</tr>
							<tr>
								<td>
								Broken Socket
								</td>
								<td>
									bla bla bla bla gijn........
								</td>
								<td>
									12/07/18
								</td>
								<td>
									Plumbing
								</td>
								<td>
									Daniel - Hall (Room : 321)
								</td>
								<td>
									img/queuepics.jpg
								</td>
								<td>
									Pending
								</td>
							</tr>
						</tbody>
					</table>
					
				</div>
				
			</div>
			<div class="tab-pane fade" id="ios">
				<div class="container">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12">
									<h3>Create a new ticket</h3>
								</div>
							</div>
							<form action="" method="post" class="form-group ticket_form" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-12">
										<input type="text" name="subject" class="form-control" placeholder="subject" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<textarea class="form-control" rows="3" name="description" placeholder="Description" required></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="date" name="time" class="form-control" placeholder="Time" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<select name="queue" class="form-control">
											<option value="Electrical_Fault">Electrical Fault</option>
											<option value="Plumbing_Issue">Plumbing Issue</option>
											<option value="Pest_Issue">Pest Issue</option>
											<option value="Bed">Bed</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="text" name="location" class="form-control" placeholder="Location" required>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="file" name="Picture" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" class="btn btn-default btn-user form-control" value="Submit">
									</div>
									
								</div>
							</form>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>
			</div>
	
	</div>
</div>
@endsection