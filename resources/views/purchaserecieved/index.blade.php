@extends('layouts.master')
@section('content')

<div class="card">
  <style .input-group-text{width:auto;}></style>
  <div class="card-header card-header-section">
    <div class="pull-left">
      @lang('home.grn')(@lang('home.goods') @lang('home.recieved') @lang('home.note'))
    </div>
    <div class="pull-right">
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
          <a type="button" class="btn btn-outline-danger" href="{{Route('precieve.recieve')}}"><i class="fa fa-plus" aria-hidden="true">@lang('home.new') @lang('home.grn')</i>
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
    <table id="mytable" class="table table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th> #@lang('home.sl') </th>
          <th> @lang('home.grn') @lang('home.number') </th>
          <th> @lang('home.purchase') @lang('home.number') </th>
          <th> @lang('home.purchase') @lang('home.date') </th>
          <th> @lang('home.recieved') @lang('home.date') </th>
          <th> @lang('home.supplier') </th>
          <th> @lang('home.amount') </th>
          <th> @lang('home.user') </th>
          <th> @lang('home.action') </th>
        </tr>
      </thead>
      <tbody id="tablebody">
      </tbody>
      <tfoot>
        <tr>
          <th> #@lang('home.sl') </th>
          <th> @lang('home.grn') @lang('home.number') </th>
          <th> @lang('home.purchase') @lang('home.number') </th>
          <th> @lang('home.purchase') @lang('home.date') </th>
          <th> @lang('home.recieved') @lang('home.date') </th>
          <th> @lang('home.supplier') </th>
          <th> @lang('home.amount') </th>
          <th> @lang('home.user') </th>
          <th> @lang('home.action') </th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

@include('purchaserecieved.partials.prindexscript')
@endsection