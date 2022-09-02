@extends('layouts.master')
@section('content')

<div class="card">
  <div class="card-header card-header-section">
    <div class="pull-left">
    @lang("home.cashin")/@lang("home.cashout") @lang("home.management")
    </div>
    <div class="pull-right">
      <div class="btn-group" role="group" aria-label="First group">
        <a type="button" class="btn btn-outline-danger" href="{{Route('cashincashout.create')}}">@lang('home.new')</i>
        </a>
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

    <table id="mytable" class="table table-bordered" style="width:100%" cellspacing="0">
      <thead>
        <tr>

          <th> #@lang('home.sl') </th>
          <th> @lang('home.payment') @lang('home.no')</th>
          <th> @lang('home.date')</th>
          <th> @lang('home.type') </th>
          <th> @lang('home.source') </th>
          <th> @lang('home.cashin')</th>
          <th> @lang('home.cashout')</th>
          <th> @lang('home.description') </th>
          <th> @lang('home.remark') </th>
          <th> @lang('home.user')</th>
          <th> @lang('home.action')</th>

        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th> #@lang('home.sl') </th>
          <th> @lang('home.payment') @lang('home.no')</th>
          <th> @lang('home.date')</th>
          <th> @lang('home.type') </th>
          <th> @lang('home.source') </th>
          <th> @lang('home.cashin')</th>
          <th> @lang('home.cashout')</th>
          <th> @lang('home.description') </th>
          <th> @lang('home.remark') </th>
          <th> @lang('home.user')</th>
          <th> @lang('home.action')</th>

        </tr>
      </tfoot>
    </table>
  </div>
</div>


@include('cashincashout.partials.cicoindexscript')
@endsection