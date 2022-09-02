@extends('layouts.master')
@section('content')
<style>
    .mb-1 {

        margin: 2px !important;
    }

    .number {
        text-align: right;
        font-weight: bold;
        font-family: 'monospace', serif;
        color: #000;
        font-size: 15px;
    }
</style>
<div class="row">
    <div class="col-sm-7 form-single-input-section">
        <div class="card">
            <div class="card-header card-header-section">@lang('home.dayclose')(@lang('home.daily'))</div>
            <div class="card-body">
                @include('partials.ErrorMessage')
                <form action="{{ route('dayclose.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="1">
                    <div class="input-group  mb-1">
                        <div class="input-group date" data-provide="datepicker" id="datetimepicker">
                            <input type="text" name="date" id="dateinput" class="form-control inv-section">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.cash') @lang('home.invoice')</span>
                        </div>
                        <input type="text" name="cashinvoice" id="cashinvoice" class="form-control number red" placeholder="Cash Invoice" readonly>
                    </div>
                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.credit') @lang('home.invoice')</span>
                        </div>
                        <input type="text" name="creditinvoice" id="creditinvoice" class="form-control number" placeholder="Credit Invoice" readonly>
                    </div>
                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.sale') @lang('home.return')</span>
                        </div>
                        <input type="text" name="salereturn" id="salereturn" class="form-control number" placeholder="Credit Invoice" readonly>
                    </div>
                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.purchase') @lang('home.order')</span>
                        </div>
                        <input type="text" name="purchase" id="purchase" class="form-control number" placeholder="Purchase" readonly>
                    </div>
                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.grn')</span>
                        </div>
                        <input type="text" id="grn" name="grn" class="form-control number" placeholder="Goods Recived Note" readonly>
                    </div>
                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.purchase') @lang('home.return')</span>
                        </div>
                        <input type="text" id="purchasereturn" name="purchasereturn" class="form-control number" placeholder="Purchase Return" readonly>
                    </div>
                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.supplier') @lang('home.payment')</span>
                        </div>
                        <input type="text" name="supplierpayment" id="ppayment" class="form-control number" placeholder="Purchase Return" readonly>
                    </div>
                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.credit') @lang('home.payment')</span>
                        </div>
                        <input type="text" name="creditpayment" id="cpayment" class="form-control number" placeholder="Purchase Return" readonly>
                    </div>
                    <div class="input-group  mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.expenses')</span>
                        </div>
                        <input type="text" name="expenses" id="expencess" class="form-control number" placeholder="Expenses" readonly>
                    </div>
                    <div class="input-group  mb-1 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.cashin')</span>
                        </div>
                        <input type="text" id="cashin" name="cashin" class="form-control number" placeholder="cashin" readonly>
                    </div>
                    <div class="input-group  mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.cashout')</span>
                        </div>
                        <input type="text" name="cashout" id="cashout" class="form-control number" placeholder="Cash Out" readonly>
                    </div>
                    <div class="input-group  mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.cash') @lang('home.drawer')</span>
                        </div>
                        <input type="text" name="cashdrawer" id="cdrawer" class="form-control number" placeholder="Cash Drawer" readonly>
                    </div>
                    <div class="input-group  mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.cashin') @lang('home.bank')</span>
                        </div>
                        <input type="text" id="cashinbank" name="cashinbank" class="form-control number" placeholder="cashinbank" readonly>
                    </div>
                    <div class="input-group  mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.stock') @lang('home.amount')</span>
                        </div>
                        <input type="text" id="stockamount" name="stockamount" class="form-control number" placeholder="Stock Amount" readonly>
                    </div>
                    <div class="row">
                        <div class="input-group mb-1 col-sm-6">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.status')</label>
                            </div>
                            <select name="status" class="form-control" id="status">
                                <option value="1">Close</option>

                            </select>
                        </div>
                    </div>
            </div>
            <div class="card-footer card-footer-section">
                <div class="pull-right">
                    <div class="btn-group button-grp" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-primary btn-lg">@lang('home.submit')</button>
                        <button id="reset" class="btn btn-secondary btn-lg">@lang('home.reset')</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var myDate = $("#dateinput").attr('data-date');
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var currentmonth = new Date(date.getFullYear(), date.getMonth());
        $('#dateinput').datepicker({
            dateFormat: 'yyyy/mm/dd',
            todayHighlight: true,
            startDate: today,
            endDate: end,
            autoclose: true
        });
        $('#dateinput').datepicker('setDate', myDate);
        //  $('#dateinput').datepicker('setDate', today);
    });
</script>
@include('dayclose.partials.dayclosecreatescript')
@endsection