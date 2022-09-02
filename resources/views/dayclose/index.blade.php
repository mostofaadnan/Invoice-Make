@extends('layouts.master')
@section('content')

<div class="card">
    <style .input-group-text{width:auto;}></style>
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.dayclose') @lang('home.management')
        </div>
        <div class="pull-right">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a type="button" class="btn btn-outline-danger" href="{{Route('dayclose.create')}}">@lang('home.new') @lang('home.dayclose')</i>
                    </a>
                    <!--            <a class="btn btn-outline-info" href="{{Route('purchase.profile')}}">Check</a>
                    <a class="btn btn-outline-success" href="{{Route('purchase.editcheck')}}">Edit</a>
                    <button type="button" id="loadall" class="btn btn-outline-light">Load All</button> -->
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
        @include('partials.ErrorMessage')
        <table id="mytable" class="table table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center"> #@lang('home.sl') </th>
                    <th class="text-center"> @lang('home.date') </th>
                    <th class="text-center"> @lang('home.cash') @lang('home.invoice') </th>
                    <th class="text-center"> @lang('home.credit') @lang('home.invoice') </th>
                    <th class="text-center"> @lang('home.sale') @lang('home.return')</th>
                    <th class="text-center"> @lang('home.purchase')</th>
                    <th class="text-center"> @lang('home.grn')</th>
                    <th class="text-center"> @lang('home.purchase') @lang('home.return')</th>
                    <th class="text-center"> @lang('home.supplier') @lang('home.payment') </th>
                    <th class="text-center"> @lang('home.customer') @lang('home.payment') </th>
                    <th class="text-center"> @lang('home.expenses')</th>
                    <th class="text-center"> @lang('home.stock') @lang('home.amount')</th>
                    <th class="text-center"> @lang('home.cashin')</th>
                    <th class="text-center"> @lang('home.cashout')</th>
                    <th class="text-center"> @lang('home.cash') @lang('home.drawer')</th>
                    <th class="text-center"> @lang('home.cashin') @lang('home.bank')</th>
                    <th class="text-center"> @lang('home.status')</th>
                    <th class="text-center"> @lang('home.status')</th>
                    <th class="text-center"> @lang('home.action')</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center"> #@lang('home.sl') </th>
                    <th class="text-center"> @lang('home.date') </th>
                    <th class="text-center"> @lang('home.cash') @lang('home.invoice') </th>
                    <th class="text-center"> @lang('home.credit') @lang('home.invoice') </th>
                    <th class="text-center"> @lang('home.sale') @lang('home.return')</th>
                    <th class="text-center"> @lang('home.purchase')</th>
                    <th class="text-center"> @lang('home.grn')</th>
                    <th class="text-center"> @lang('home.purchase') @lang('home.return')</th>
                    <th class="text-center"> @lang('home.supplier') @lang('home.payment') </th>
                    <th class="text-center"> @lang('home.customer') @lang('home.payment') </th>
                    <th class="text-center"> @lang('home.expenses')</th>
                    <th class="text-center"> @lang('home.stock') @lang('home.amount')</th>
                    <th class="text-center"> @lang('home.cashin')</th>
                    <th class="text-center"> @lang('home.cashout')</th>
                    <th class="text-center"> @lang('home.cash') @lang('home.drawer')</th>
                    <th class="text-center"> @lang('home.cashin') @lang('home.bank')</th>
                    <th class="text-center"> @lang('home.status')</th>
                    <th class="text-center"> @lang('home.status')</th>
                    <th class="text-center"> @lang('home.action')</th>
                </tr>
            </tfoot>
        </table>

    </div>


</div>

@include('dayclose.partials.daycloseindexscript')
@endsection