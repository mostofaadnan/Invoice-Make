@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header card-header-section">
        <div class="row">
            <div class="col-8 col-sm-4 col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">@lang('home.grn') @lang('home.no')</label>
                    </div>
                    <input type="text" class="form-control" id="purchasecode" list="purchaseno" placeholder="@lang('home.search')">
                    <datalist id="purchaseno">
                    </datalist>
                </div>
            </div>
            <div class="col-4 col-sm-8">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('home.action')
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('precieves') }}" class="nav-link">@lang('home.grn') @lang('home.list')</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('precieve.recieve') }}" class="nav-link">@lang('home.new')</a>
                        <div class="dropdown-divider"></div>
                        <a id="print" class="nav-link">@lang('home.print')</a>
                        <div class="dropdown-divider"></div>
                        <a id="pdf" class="nav-link">@lang('home.pdf')</a>
                        <div class="dropdown-divider"></div>
                        <a id="mail" class="nav-link">@lang('home.mail') @lang('home.send')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('partials.ErrorMessage')
        <div class="inv-title">
            <h4 class="no-margin"><b>@lang('home.goods') @lang('home.recieved') @lang('home.note')(@lang('home.grn'))</b></h4>
        </div>
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
            <div class="col-12 col-sm-4">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>GRN No</th>
                        <td id="recieve_no">@lang('home.grn') @lang('home.no')</td>
                    </tr>
                    <tr>
                        <th>@lang('home.purchase') @lang('home.no')</th>
                        <td id="purchase_no"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.date')</th>
                        <td id="purchasedate"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.reference') @lang('home.no')</th>
                        <td id="refno"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.stock') @lang('home.recieved')</th>
                        <td id="status"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.remark')</th>
                        <td id="remark"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped table-responsive-sm table-sm  data-table mt-2" width="100%">
                    <thead>
                        <th width="5%">#@lang('home.sl')</th>
                        <th>@lang('home.description')</th>
                        <th width="10%">@lang('home.quantity')</th>
                        <th width="10%">@lang('home.unit')</th>
                        <th width="10%">@lang('home.unit') @lang('home.price')</th>
                        <th width="10%">@lang('home.total')</th>
                    </thead>
                    <tbody id="tablebody">
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
                        <th>@lang('home.discount')</th>
                        <td id="sdiscount" align="right"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.payment')</th>
                        <td id="spayment" align="right"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.balancedue')</th>
                        <td id="sbalancedue" align="right"></td>
                    </tr>
                </table>

            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <table class="table table-bordered table-striped mt-2">
                    <tr>
                        <td align="right"><b>@lang('home.subtotal')</b></td>
                        <td id="subtotal" align="right"></td>
                    </tr>
                    <tr>
                        <td align="right"><b>@lang('home.discount')</b></td>
                        <td id="discount" align="right"></td>
                    </tr>
                    <tr>
                        <td align="right"><b>@lang('home.sale') @lang('home.tax')</b></td>
                        <td id="vat" align="right"></td>
                    </tr>
                    <tr>
                        <td align="right"><b>@lang('home.shipment') @lang('home.cost')</b></td>
                        <td id="shipment" align="right"></td>
                    </tr>
                    <tr>
                        <td align="right"><b>@lang('home.nettotal')</b></td>
                        <td id="nettotal" align="right"></td>
                    </tr>
                </table>

            </div>
        </div>

    </div>

</div>





@include('purchaserecieved.partials.recieveviewscript')
@endsection