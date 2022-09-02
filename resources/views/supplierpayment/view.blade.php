@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header card-header-section">
        <div class="row">
            <div class="col-8 col-sm-4 col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">@lang('home.payment') @lang('home.no')</label>
                    </div>
                    <input type="text" class="form-control" id="paymentcode" list="paymentno" placeholder="@lang('home.search')">
                    <datalist id="paymentno">
                    </datalist>
                </div>
            </div>
            <div class="col-4 col-sm-8">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('home.action')
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('supplierpayments') }}" class="nav-link">@lang('home.payment') @lang('home.list')</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('supplierpayment.create') }}" class="nav-link">New</a>
                        <div class="dropdown-divider"></div>
                        <a id="pdf" class="nav-link">@lang('home.export') @lang('home.pdf')</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link" id="datadelete">@lang('home.delete')</a>
                        <div class="dropdown-divider"></div>
                        <a id="mail" class="nav-link">@lang('home.send') @lang('home.mail')</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="inv-title">
            <h4 class="no-margin"><b>@lang('home.supplier') @lang('home.payment')</b></h4>
        </div>
        @include('partials.ErrorMessage')
        <div class="row">
            <div class="col-sm-4">
                <h4 id="suppliername"></h4>
                <address>
                    <i class="" id="supplieraddress"></i>
                    <i class="" id="suppliercountry"></i>
                    <i id="mobile" class="fa fa-mobile " aria-hidden="true"></i><br>
                    <i id="telno" class="fa fa-phone" aria-hidden="true"></i><br>
                    <i id="email" class="fa fa-envelope-o" aria-hidden="true"></i><br>
                    <i id="website" class="fa fa-address-book-o" aria-hidden="true"></i>
                </address>
            </div>
            <div class="col-sm-4 hidden-xs"></div>
            <div class="col-sm-4">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>@lang('home.payment') @lang('home.no')</th>
                        <td id="supplierpaymentno"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.date')</th>
                        <td id="paymentdate"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.payment') @lang('home.type')</th>
                        <td id="paymenttype"></td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped table-responsive-sm table-sm" width="100%">
                    <thead>
                        <th>@lang('home.description')</th>
                        <th>@lang('home.amount')</th>
                        <th>@lang('home.payment')</th>
                        <th>@lang('home.balance')</th>
                        <th>@lang('home.remark')</th>
                    </thead>
                    <tbody id="tablebody">
                        <tr>
                            <td>@lang('home.supplier') @lang('home.payment')</td>
                            <td id="amount" align="right"></td>
                            <td id="payment" align="right"></td>
                            <td id="balancedue" align="right"></td>
                            <td id="remark" align="right"></td>
                        </tr>
                        <tr>
                            <th id="inwordsht">@lang('home.inwords'):</th>
                            <td id="inwords" colspan="4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <table class="table table-bordered table-striped mt-2">
                    <tr>
                        <th colspan="2" class="text-center">@lang('home.supplier') @lang('home.balance')</th>
                    </tr>
                    <tr>
                        <th>@lang('home.total') @lang('home.consignment')</th>
                        <td id="consignment" align="right"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.total') @lang('home.discount')</th>
                        <td id="sdiscount" align="right"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.total') @lang('home.payment')</th>
                        <td id="spayment" align="right"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.balancedue')</th>
                        <td id="sbalancedue" align="right"></td>
                    </tr>
                </table>

            </div>
        </div>



    </div>
</div>
@include('supplierpayment.partials.supplierpviewscript')
@endsection