@extends('layouts.master')
@section('content')

<div class="card">
    <style .input-group-text{width:auto;}></style>
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.supplier') @lang('home.payment')
        </div>
        <div class="pull-right">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a type="button" class="btn btn-outline-danger" href="{{Route('supplierpayment.create')}}">@lang('home.new') @lang('home.payment')</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row  mt-2">
            <div class="col-sm-3  mb-2">
            </div>
            <div class="col-sm-9 mb-2">
                @include('section.dateBetween')
            </div>
            <div class="divider"></div>
        </div>
        <table id="mytable" class="table table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.payment') @lang('home.no') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.supplier') </th>
                    <th> @lang('home.amount')</th>
                    <th> @lang('home.payment') </th>
                    <th> @lang('home.balancedue') </th>
                    <th> @lang('home.payment') @lang('home.type') </th>
                    <th> @lang('home.user')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.payment') @lang('home.no') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.supplier') </th>
                    <th> @lang('home.amount')</th>
                    <th> @lang('home.payment') </th>
                    <th> @lang('home.balancedue') </th>
                    <th> @lang('home.payment') @lang('home.type') </th>
                    <th> @lang('home.user')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@include('supplierpayment.partials.supplierpindexscript')
@endsection