<!doctype html>
<html {{ app()->getLocale() }}>
<head>
    @include('includes.head')
</head>
<body>
	<div id="app"  class="container-fluid">
		<div class="row d-flex d-md-block flex-nowrap wrapper">
			<div class="col-md-3 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar">	
				@include('includes.sidebar')
			</div>

			<main class="col-md-9 float-left col px-5 pl-md-2 pt-2 main">
				<a href="#" data-target="#sidebar" data-toggle="collapse">
					<i class="fa fa-navicon fa-2x py-2 p-1"></i>
				</a>
				<hr>
				@yield('content')
			</main>
		</div>    
	</div>
	<script src="{{ url('js/app.js') }}"></script>
</body>
</html>

