@extends('layouts.sidebar')
@section('content')
	<div class="row">
		<div class="col-md-9 offset-md-1">
			<div class="page-header">
				<h1>Add Product Details</h1>
			</div>
			<div>
            	@if (session('error'))
          			<div class="alert alert-danger">{!!session('error')!!}</div>
            	@endif
            	@if (session('success'))
          			<div class="alert alert-success">{!!session('success')!!}</div>
            	@endif
            </div>
			<form action="{{ route('storeProduct') }}" method="POST">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="inputName">Name</label>
					<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Which product you want to add ?" value="{{ old('inputName') }}">
					@if($errors->has('inputName'))
					<div class="text-danger">
						{!! $errors->first('inputName')!!}
					</div>	
					@endif
				</div>
				<div class="form-group">
					<label for="inputQuantity">Quantity</label>
					<input type="text" class="form-control" id="inputQuantity" name="inputQuantity" placeholder="How many ?" value="{{ old('inputQuantity') }}">
					@if($errors->has('inputQuantity'))
					<div class="text-danger">
						{!! $errors->first('inputQuantity')!!}
					</div>	
					@endif
				</div>
				<div class="form-group">
					<label for="inputCompany">Manufacturer</label>
					<input type="text" class="form-control" id="inputCompany" name="inputCompany" placeholder="Who is the manufacturer ?" value="{{ old('inputCompany') }}">
					@if($errors->has('inputCompany'))
					<div class="text-danger">
						{!! $errors->first('inputCompany')!!}
					</div>	
					@endif
				</div>
				<div class="form-group">
					<label for="inputType">Type</label>
					<select class="form-control" id="inputType" name="inputType">
						<option value="0" disabled selected>What type of product ?</option>
						<option value="1" @if(old('inputType') == "1") selected @endif>Returnable</option>
						<option value="2" @if(old('inputType') == "2") selected @endif>Non-Returnable</option>
					</select>
					@if($errors->has('inputType'))
					<div class="text-danger">
						{!! $errors->first('inputType')!!}
					</div>	
					@endif
				</div>
				<div class="form-group">
					<label for="inputPrice">Unit Price</label>
					<input type="text" class="form-control" id="inputPrice" name="inputPrice" placeholder="How much you paid for one unit?" value="{{ old('inputPrice') }}">
					@if($errors->has('inputPrice'))
					<div class="text-danger">
						{!! $errors->first('inputPrice')!!}
					</div>	
					@endif
				</div>
				<div class="form-group">
					<label for="inputLabel">Label</label>
					<input type="text" class="form-control" id="inputLabel" name="inputLabel" placeholder="BarCode/Serial Number/Label" value="{{ old('inputLabel') }}">
					@if($errors->has('inputLabel'))
					<div class="text-danger">
						{!! $errors->first('inputLabel')!!}
					</div>	
					@endif
				</div>
				<div class="form-group">
					<label for="inputPurchaseDate">Purchase Date</label>
					<input type="text" class="form-control" id="inputPurchaseDate" name="inputPurchaseDate" placeholder="When-yyyy/m/d??" value="{{ old('inputPurchaseDate') }}">
					@if($errors->has('inputPurchaseDate'))
					<div class="text-danger">
						{!! $errors->first('inputPurchaseDate')!!}
					</div>	
					@endif
				</div>
				<div class="form-group">
					<label for="inputDescription">Description</label>
					<textarea class="form-control" id="inputDescription" name="inputDescription" rows="3">{{ old('inputDescription') }}</textarea>
					@if($errors->has('inputDescription'))
					<div class="text-danger">
						{!! $errors->first('inputDescription')!!}
					</div>	
					@endif
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@stop