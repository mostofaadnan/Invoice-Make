@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.supplier') @lang('home.management')
        </div>
        <div class="pull-right">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a type="button" class="btn btn-outline-danger" href="{{Route('supplier.create')}}"><i class="fa fa-plus" aria-hidden="true">@lang('home.new') @lang('home.supplier')</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('partials.ErrorMessage')
        <table id="mytable" class="table table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.id') </th>
                    <th> @lang('home.name') </th>
                    <th> @lang('home.opening') <br>@lang('home.balance') </th>
                    <th> @lang('home.consignment') </th>
                    <th> @lang('home.discount') </th>
                    <th> @lang('home.payment')</th>
                    <th> @lang('home.balance')</th>
                    <th> @lang('home.status')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.id') </th>
                    <th> @lang('home.name') </th>
                    <th> @lang('home.opening') <br>@lang('home.balance') </th>
                    <th> @lang('home.consignment') </th>
                    <th> @lang('home.discount') </th>
                    <th> @lang('home.payment')</th>
                    <th> @lang('home.balance')</th>
                    <th> @lang('home.status')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

@include('supplier.partials.supplierindexscript')
@endsection