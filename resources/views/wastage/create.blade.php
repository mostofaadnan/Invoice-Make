@extends('layouts.master')
@section('content')
<style>
    .full-height {
        height: 100%;
    }

    .footer {
        margin: auto;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #001f3f !important;
        color: white;
        /* text-align: center; */
        z-index: 9999;
    }

    .section-card-body {
        margin-top: 40px;
    }

    .sum-section {

        font-style: bold;
        color: #fff;

    }

    .btn-rounded {
        border-radius: 10em;
    }

    .btn-danger {
        background-color: #ff3547;
        color: #fff;
    }

    .btn-light {
        color: #000 !important;

    }

    .btn-submit {

        margin: .375rem;
        color: inherit;
        text-transform: uppercase;
        word-wrap: break-word;
        white-space: normal;
        cursor: pointer;
        border: 0;
        border-radius: .125rem;
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        -webkit-transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        padding: .84rem 2.14rem;
        font-size: .81rem;
    }
</style>
<div class="col-lg-12">
    <div class="card card-design">
        <div class="card-header card-header-section">
            <div class="card-title">
                <h5 style="color:#fff;">@lang('home.new') @lang('home.wastage')</h5>
            </div>
            <div class="form-row">

                <div class="col-md-3 mb-1">
                    <label for="validationDefault01">@lang('home.date')</label>
                    <div class="input-group date" data-provide="datepicker" id="datetimepicker2">
                        <input type="text" name="openingdate" id="dateinput" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            var date = new Date();
                            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                            var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                            $('#dateinput').datepicker({
                                format: "yyyy/mm/dd",
                                todayHighlight: true,
                                startDate: today,
                                endDate: end,
                                autoclose: true
                            });
                            $('#dateinput').datepicker('setDate', today);
                        });
                    </script>
                </div>
                <div class="col-md-8 mb-1">
                    <label for="validationDefault01">@lang('home.remark')</label>
                    <input type="text" class="form-control" placeholder="@lang('home.remark')" id="remark">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-row">
                                <div class="col-md-6 mb-1">
                                    <label for="validationDefault02">@lang('home.item')</label>
                                    <input type="text" class="form-control" id="search" placeholder="@lang('home.search')" list="product" required>
                                    <datalist id="product">
                                    </datalist>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <label for="validationDefault01">@lang('home.price')</label>
                                    <input type="number" class="form-control" id="mrp" placeholder="@lang('home.price')" readonly>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <label for="validationDefault01">@lang('home.quantity')</label>
                                    <input type="number" class="form-control" id="qty" placeholder="@lang('home.quantity')" required>
                                </div>

                                <div class="col-md-2 mt-4 button-section">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-info" id="addrows" name="button">@lang('home.add')</button>
                                        <button type="button" id="clear" class="btn btn-sm btn-success" name="button">@lang('home.reset')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="data-table table table-striped table-bordered table-sm" cellspacing="0" id="purchasetable">
                                <thead>
                                    <tr>
                                        <th align='center' width="5%"> #@lang('home.sl') </th>
                                        <th align='center' width="10%"> @lang('home.item') @lang('home.code') </th>
                                        <th align='center'> @lang('home.name')</th>
                                        <th align='center' width="10%"> @lang('home.quantity') </th>
                                        <th align='center' width="10%"> @lang('home.unit') @lang('home.price') </th>
                                        <th align='center' width="15%"> @lang('home.amount') </th>
                                        <th align='center' width="10%"> @lang('home.action')</th>
                                    </tr>
                                </thead>
                                <tbody id="datatablebody" class="my-custom-scrollbar my-custom-scrollbar-primary scrollbar-morpheus-den">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-right" colspan="5"> @lang('home.nettotal')</th>
                                        <th class="text-right" id="amount"> 0 </th>
                                        <th align='center'></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-3">
                                @include('purchase.partials.sumsection')
                        </div> -->
            </div>
        </div>
        <div class="card-footer sum-section">
            <div class="pull-right button-section">
                <button type="button" id="submittData" class="btn btn-lg btn-submit btn-rounded btn-danger" name="button">@lang('home.submit')</button>
                <button type="button" id="resteBtn" class="btn btn-lg btn-light btn-submit btn-rounded" name="button">@lang('home.reset')</button>
            </div>

        </div>
    </div>
</div>

<!-- @include('purchase.partials.sumfootersection') -->

@include('wastage.partials.wastagecreatescript')
@endsection