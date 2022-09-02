@extends('layouts.master')
@section('content')

<div class="card">
  <style .input-group-text{width:auto;}></style>
  <div class="card-header card-header-section">
    <div class="pull-left">
    @lang('home.purchase') @lang('home.management')
    </div>
    <div class="pull-right">
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
          <a type="button" class="btn btn-outline-danger" href="{{Route('purchase.create')}}">@lang('home.new') @lang('home.purchase')</i>
          </a>
       
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-8">
        @include('section.dateBetween')
      </div>
    </div>
    <div class="divider"></div>
   @include('purchase.partials.TableInfo')

  </div>


</div>

@include('purchase.partials.pindexscripts')
@endsection