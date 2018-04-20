@extends('layouts.sidebar')
@section('title', 'List Products')
@section('content')
	<div class="row">
		<div class="col-md-9 offset-md-1">
			<div class="page-header">
				<h1>List of Products Detail</h1>
			</div>
			<div>
            	@if (session('error'))
          			<div class="alert alert-danger">{!!session('error')!!}</div>
            	@endif
            	@if (session('success'))
          			<div class="alert alert-success">{!!session('success')!!}</div>
            	@endif
            </div>
			<list-products-page></list-products-page>
      	</div>
	</div>
@stop