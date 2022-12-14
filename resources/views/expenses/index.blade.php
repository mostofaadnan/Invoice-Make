@extends('layouts.master')
@section('content')

<div class="card">
    <style .input-group-text{width:auto;}></style>
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.expenses') @lang('home.management')
        </div>
        <div class="pull-right">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a type="button" class="btn btn-outline-danger" href="{{Route('expenses.create')}}">@lang('home.new') @lang('home.expenses')</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('partials.ErrorMessage')

        <table class="table table-bordered" id="mytable" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.expenses') @lang('home.no') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.description') </th>
                    <th> @lang('home.expenses') @lang('home.type') </th>
                    <th> @lang('home.amount') </th>
                    <th> @lang('home.source') </th>
                    <th> @lang('home.remark') </th>
                    <th> @lang('home.voucher') @lang('home.no') </th>
                    <th> @lang('home.payment') @lang('home.description') </th>
                    <th>@lang('home.user')</th>
                    <th>@lang('home.action')</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.expenses') @lang('home.no') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.description') </th>
                    <th> @lang('home.expenses') @lang('home.type') </th>
                    <th> @lang('home.amount') </th>
                    <th> @lang('home.source') </th>
                    <th> @lang('home.remark') </th>
                    <th> @lang('home.voucher') @lang('home.no') </th>
                    <th> @lang('home.payment') @lang('home.description') </th>
                    <th>@lang('home.user')</th>
                    <th>@lang('home.action')</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

@include('expenses.partials.expemsesindexscript')
@endsection