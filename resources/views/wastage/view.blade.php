@extends('layouts.master')
@section('content')
<style>
    @media print {
        @page {
            size: A3;
        }
    }

    ul {
        padding: 0;
        list-style: none;

    }

    .container {
        padding: 20px 40px;
    }

    .inv-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .inv-header :nth-child(2) {
        flex-basis: 30%;
    }

    .inv-title {
        padding: 10px;
        border: 1px solid silver;
        text-align: center;
        margin-bottom: 20px;
    }

    .no-margin {
        margin: 0;
    }

    .inv-logo {
        width: 150px;
    }

    .inv-header h2 {
        font-size: 20px;
        margin: 1rem 0 0 0;
    }

    .inv-header ul li {
        font-size: 15px;
        padding: 3px 0;
    }

    /* table in head */
    .inv-header table {
        width: 100%;
        border-collapse: collapse;
    }

    .inv-header table th,
    .inv-header table td,
    .inv-header table {
        border: 1px solid silver;
    }

    .inv-header table th,
    .inv-header table td {
        text-align: right;
        padding: 8px;
    }

    /* Body */
    .inv-body {
        margin-bottom: 5px;
    }

    .inv-body table {
        width: 100%;
        border: 1px solid silver;
        border-collapse: collapse;
    }

    .inv-body table th,
    .inv-body table td {
        padding: 10px;
        border: 1px solid silver;
    }

    .inv-body table td h5,
    .inv-body table td p {
        margin: 0 5px 0 0;
    }

    /* Footer */
    .inv-footer {
        clear: both;
        overflow: auto;
    }

    .inv-footer table {
        width: 30%;
        float: right;
        border: 1px solid silver;
        border-collapse: collapse;
    }

    .inv-footer table th,
    .inv-footer table td {
        padding: 8px;
        text-align: right;
        border: 1px solid silver;
    }

    .invoice-section {
        padding: 10px;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }
</style>
<div class="container">
    <div class="card invoice-section" id="invoice">
        <div class="card-header">
            <div class="pull-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('wastage.create') }}" class="btn btn-outline-danger">@lang('home.new')</a>
                    <button id="dataedit" class="btn btn-outline-success">@lang('home.edit')</button>
                    <button id="datadelete" class="btn btn-outline-warning">@lang('home.delete')</button>
                    <button id="print" class="btn btn-outline-info" id="invoicepdf">@lang('home.pdf')</button>

                </div>
            </div>
        </div>

        <div class="card-body" id="DivIdToPrint">
            <div class="inv-title">
                <h4 class="no-margin" style="color:blue"><b>@lang('home.wastage')</b></h4>
            </div>
            <div class="inv-header row">
                <div class="col-md-8 col-sm-4"></div>
                <div class="col-md-4 col-sm-4">
                    <table id="dtBasicExample" class="table">
                        <tr>
                            <th>@lang('home.date')</th>
                            <td id="date"></td>
                        </tr>
                        <tr>
                            <th>@lang('home.remark')</th>
                            <td id="remark"></td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="inv-body">
                <table class="table table-bordered table-sm data-table">
                    <thead>
                        <th align="center">#@lang('home.sl')</th>
                        <th align="center">@lang('home.description')</th>
                        <th align="center">@lang('home.quantity')</th>
                        <th align="center">@lang('home.unit')</th>
                        <th align="center">@lang('home.unit') @lang('home.price')</th>
                        <th align="center">@lang('home.total')</th>
                    </thead>
                    <tbody id="tablebody">
                    </tbody>
                    <tfoot>
                        <th align="center">#@lang('home.sl')</th>
                        <th align="center">@lang('home.description')</th>
                        <th align="center">@lang('home.quantity')</th>
                        <th align="center">@lang('home.unit')</th>
                        <th align="center">@lang('home.unit') @lang('home.price')</th>
                        <th align="center">@lang('home.total')</th>
                    </tfoot>
                </table>
            </div>

        </div>

    </div>

</div>
@include('wastage.partials.wastageviewscript')
@endsection