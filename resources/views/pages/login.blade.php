@extends('layouts.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 mt-2">
            	@if ($errors->any())
            	<div class="alert alert-danger">
            		<ul>
            			@foreach ($errors->all() as $error)
            			<li>{{ $error }}</li>
            			@endforeach
            		</ul>
            	</div>
            	@endif
            	@if (session('error'))
          			<div class="alert alert-danger">{!!session('error')!!}</div>
            	@endif
            	@if (session('success'))
          			<div class="alert alert-success">{!!session('success')!!}</div>
            	@endif
            </div>
            <div class="col-md-12 text-center">
            	<form action="{{route('loginUser')}}" method="POST">
            		<img class="mt-6" src="" alt="k-Yantra" width="100" height="72">
            		<h1 class="h3 mb-4 font-weight-normal">Please sign in</h1>
            		{{ csrf_field() }}
	            	<div class="col-md-4 offset-md-4">
	            		<label for="inputEmail" class="sr-only">Email address</label>
	            		<input id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address"  autofocus="" type="email" value="{{old('inputEmail')}}">
	            		@if($errors->has('inputEmail'))
	        			<div class="invalid-feedback">
					        {!! $errors->first('inputEmail') !!}
					    </div>
	            		@endif
	            	</div>
					<div class="col-md-4 offset-md-4">
	            		<label for="inputPassword" class="sr-only">Password</label>
	            		<input id="inputPassword" name="inputPassword" class="form-control" placeholder="Password"  type="password">
	            		@if($errors->has('inputPassword'))
		        			<div class="invalid-feedback">
						        {!! $errors->first('inputPassword') !!}
						    </div>
	            		@endif
	            		<div class="checkbox mb-3">
	            			<label>
	            				<input value="remember-me" type="checkbox"> Remember me
	            			</label>
	            		</div>
	            	</div>
	            	<div class="col-md-4 offset-md-4">
            			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            		</div>
            	</form>
            </div>
        </div>
    </div>
@stop