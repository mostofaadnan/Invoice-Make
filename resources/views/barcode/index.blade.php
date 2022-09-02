@extends('layouts.master')
@section('content')
<div class="col-lg-12">
	<div class="card card-design">
		<div class="card-header card-header-section">
			@include('section.barcodesection')
		</div>
		<div class="card-body">
			@include('section.barcodeitemsection')
			<div class="my-custom-scrollbar my-custom-scrollbar-primary scrollbar-morpheus-den">
				@include('barcode.partials.barcodeTable')
			</div>
		</div>
		<div class="card-footer  card-header-section">
			<div class="pull-right">
				<button type="button" id="submittData" class="btn btn-lg btn-submit btn-rounded btn-danger" name="button">@lang('home.save')</button>
				<button type="button" id="resteBtn" class="btn btn-lg btn-light btn-submit btn-rounded" name="button">@lang('home.reset')</button>
			</div>
		</div>
	</div>
	@include('barcode.partials.barcodescript')
	@endsection