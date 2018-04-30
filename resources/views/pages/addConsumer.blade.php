@extends('layouts.sidebar')
@section('title', 'Add Consumer')
@section('content')
	<div class="row">
		<div class="col-md-9 offset-md-1">
			<div class="page-header">
				<h1>Add Consumer Details</h1>
			</div>
			<div>
            	@if (session('error'))
          			<div class="alert alert-danger">{!!session('error')!!}</div>
            	@endif
            	@if (session('success'))
          			<div class="alert alert-success">{!!session('success')!!}</div>
            	@endif
            </div>
			<form action="{{ route('storeConsumer') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="inputName">Name</label>
					<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Whom you want to issue the product?" value="{{ old('inputName') }}">
					@if($errors->has('inputName'))
					<div class="text-danger">
						{!! $errors->first('inputName')!!}
					</div>
					@endif
				</div>
				<div class="form-group">
					<label for="inputQuantity">Contact</label>
					<input type="text" class="form-control" id="inputContact" name="inputContact" placeholder="Please ask for working contact number ?" value="{{ old('inputContact') }}">
					@if($errors->has('inputContact'))
					<div class="text-danger">
						{!! $errors->first('inputContact')!!}
					</div>
					@endif
				</div>
				<div class="form-group">
					<label for="inputCompany">email</label>
					<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Please ask for working email ?" value="{{ old('inputEmail') }}">
					@if($errors->has('inputEmail'))
					<div class="text-danger">
						{!! $errors->first('inputEmail')!!}
					</div>
					@endif
				</div>
				<!-- <div class="form-group">
					<label for="inputPrice">Unit Price</label>
					<input type="text" class="form-control" id="inputPrice" name="inputPrice" placeholder="How much you paid for one unit?" value="{{ old('inputPrice') }}">
					@if($errors->has('inputPrice'))
					<div class="text-danger">
						{!! $errors->first('inputPrice')!!}
					</div>
					@endif
				</div> -->
				<!-- <div class="form-group">
					<label for="inputLabel">Label</label>
					<input type="text" class="form-control" id="inputLabel" name="inputLabel" placeholder="BarCode/Serial Number/Label" value="{{ old('inputLabel') }}">
					@if($errors->has('inputLabel'))
					<div class="text-danger">
						{!! $errors->first('inputLabel')!!}
					</div>
					@endif
				</div> -->
				<!-- <div class="form-group">
					<label for="inputPurchaseDate">Purchase Date</label>
					<input type="text" class="form-control" id="inputPurchaseDate" name="inputPurchaseDate" placeholder="When-yyyy/m/d??" value="{{ old('inputPurchaseDate') }}">
					@if($errors->has('inputPurchaseDate'))
					<div class="text-danger">
						{!! $errors->first('inputPurchaseDate')!!}
					</div>
					@endif
				</div> -->
				<div class="form-group">
					<label for="inputDescription">Address/Description</label>
					<textarea class="form-control" id="inputAddress" name="inputAddress" rows="3">{{ old('inputAddress') }}</textarea>
					@if($errors->has('inputAddress'))
					<div class="text-danger">
						{!! $errors->first('inputAddress')!!}
					</div>
					@endif
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@stop