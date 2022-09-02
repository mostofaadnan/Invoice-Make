@extends('layouts.master')
@section('content')
<style>
  .btn {
    border: 1px #fff solid;
  }
  
</style>
<div class="row">
  <div class="col-sm-7 form-single-input-section ">
    <div class="card card-design">
      <div class="card-header card-header-section">
        <div class="pull-left">
          @lang('home.new') @lang('home.supplier') @lang('home.payment')
        </div>
      </div>
      <div class="card-body form-div">
        <div class="mb-2"></div>
        <div class="container">

          @include('supplierpayment.partials.supplierpaymentform')
        </div>
      </div>
      <div class="card-footer  card-footer-section">

        <div class="pull-right">
          <div class="btn-group button-grp" role="group" aria-label="Basic example">
            <button type="submit" id="datasubmit" class="btn btn-success btn-lg">@lang('home.submit')</button>
            <button id="reset" class="btn btn-light clear_field">@lang('home.reset')</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@include('supplierpayment.partials.supplierpcreatescript');
@endsection