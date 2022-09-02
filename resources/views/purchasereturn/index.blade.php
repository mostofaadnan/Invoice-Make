@extends('layouts.master')
@section('content')

<div class="card">
  <style .input-group-text{width:auto;}></style>
  <div class="card-header card-header-section">
    <div class="pull-left">
      @lang('home.purchase') @lang('home.return') @lang('home.management')
    </div>
    <div class="pull-right">
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
          <a type="button" class="btn btn-outline-danger" href="{{Route('purchasereturn.create')}}">@lang('home.new') @lang('home.purchase') @lang('home.return')</i>
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
    <table id="mytable" class="table table-bordered " cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="text-center"> #@lang('home.sl') </th>
          <th class="text-center"> @lang('home.return') @lang('home.no') </th>
          <th class="text-center"> @lang('home.purchase') @lang('home.no') </th>
          <th class="text-center"> @lang('home.date') </th>
          <th class="text-center"> @lang('home.supplier') </th>
          <th class="text-center"> @lang('home.amount')</th>
          <th class="text-center"> @lang('home.discount') </th>
          <th class="text-center"> @lang('home.vat') </th>
          <th class="text-center"> @lang('home.nettotal')</th>
          <th class="text-center"> @lang('home.user')</th>
          <th class="text-center"> @lang('home.action')</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
      <tfoot>
        <tr>
          <th class="text-center"> #@lang('home.sl') </th>
          <th class="text-center"> @lang('home.return') @lang('home.no') </th>
          <th class="text-center"> @lang('home.purchase') @lang('home.no') </th>
          <th class="text-center"> @lang('home.date') </th>
          <th class="text-center"> @lang('home.supplier') </th>
          <th class="text-center"> @lang('home.amount')</th>
          <th class="text-center"> @lang('home.discount') </th>
          <th class="text-center"> @lang('home.vat') </th>
          <th class="text-center"> @lang('home.nettotal')</th>
          <th class="text-center"> @lang('home.user')</th>
          <th class="text-center"> @lang('home.action')</th>
        </tr>
      </tfoot>
    </table>
  </div>


</div>

@include('purchasereturn.partials.prindexscripts')
@endsection