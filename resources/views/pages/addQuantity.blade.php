@extends('layouts.sidebar')
@section('title', 'Issue Products')
@section('content')
	<div class="row">
		<div class="col-md-9 offset-md-1">
			<div class="page-header">
				<h1>Add Quantity Product:</h1>
			</div>
			<div>
            	@if (session('error'))
          			<div class="alert alert-danger">{!!session('error')!!}</div>
            	@endif
            	@if (session('success'))
          			<div class="alert alert-success">{!!session('success')!!}</div>
            	@endif
            </div>
			<add-product-quantity-form></add-product-quantity-form>
      	</div>
	</div>
@stop