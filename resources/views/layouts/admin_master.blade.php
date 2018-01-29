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
						</ul>
				
			</div>
		</nav>
@endsection