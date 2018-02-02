@extends('layouts.master')

@section('nav')
	
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">
        				<img alt="Brand" src="{{ url('images/CU_LOGO_BRAND.jpg') }}" class="img-responsive">		
      				</a>
      					<span class="brand-text">CU Ticket System</span>
      
				</div>
				<div class="right-nav">
						<ul class="nav navbar-nav navbar-right">
								
					<li><a href="#"><span class="glyphicon glyphicon-user right-nav"></span>&nbsp; Welcome, @yield('name')</a></li>
						@if(session()->has('user') == true)
						<a class="btn btn-primary navbar-btn logout-btn" href="{{route('logout_user')}}">
							
								<span class="glyphicon glyphicon-log-out"></span> Logout
						
						</a>
						@endif
						</ul>
						
			</div>
		</nav>
@endsection