@extends('layouts.master')
@section('content')

<div class="card invoice-section">
    <div class="card-header card-header-section">
        <div class="row">
            <div class="col-6 col-sm-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">@lang('home.return') @lang('home.no')</label>
                    </div>
                    <input type="text" class="form-control" id="returncode" list="returnno" placeholder="@lang('home.search')">
                    <datalist id="returnno">
                    </datalist>
                </div>
            </div>
            <div class="col-4 col-sm-8">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('purchasereturn.create') }}" class="nav-link">@lang('home.new')</a>
                        <div class="dropdown-divider"></div>
                        <a id="dataedit" class="nav-link">@lang('home.edit')</a>
                        <div class="dropdown-divider"></div>
                        <a id="datadelete" class="nav-link">@lang('home.delete')</a>
                        <div class="dropdown-divider"></div>
                        <a id="pdf" class="nav-link">@lang('home.pdf')</a>
                        <div class="dropdown-divider"></div>
                        <a id="mail" class="nav-link">@lang('home.mail') @lang('home.send')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="inv-title">
        <h4 class="no-margin">@lang('home.purchase') @lang('home.return')</h4>
    </div>
    @include('partials.ErrorMessage')

    <div class="row">
        <div class="col-12 col-sm-4">
            <h4 id="customername"></h4>
            <address>
                <i class="" id="customeraddress"></i>
                <i class="" id="customercountry"></i>
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
                    <th>@lang('home.return') @lang('home.no')</th>
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
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12">
            <table class="table table-bordered table-striped table-responsive-sm table-sm  data-table" width="100%">
                <thead>
                    <th>#@lang('home.sl')</th>
                    <th>@lang('home.description')</th>
                    <th>@lang('home.quantity')</th>
                    <th>@lang('home.unit')</th>
                    <th>@lang('home.unit') @lang('home.price')</th>
                    <th>@lang('home.total')</th>
                </thead>
                <tbody id="tablebody">
                </tbody>
                </tbody>
            </table>
        </div>
        <div class="col-sm-8 "></div>
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
                    <td align="right"><b>@lang('home.tax')</b></td>
                    <td id="vat" align="right"></td>
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


@include('PurchaseReturn.partials.purchaserviewscript')
@endsection