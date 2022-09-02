@extends('layouts.master')
@section('content')
<style>
    .image-container {
        position: relative;
    }

    .image {
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .image-container:hover .image {
        opacity: 0.3;
    }

    .image-container:hover .middle {
        opacity: 1;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header profile-view">
                <div class="row">
                    <div class=" col-sm-8">
                        <h3 id="suppliername" style="color:red;"></h3>
                    </div>
                    <div class="form-group col-sm-4">
                        <input type="text" class="form-control" id="suppliersearch" placeholder="Supplier" list="supplier" autocomplete="off">
                        <datalist id="supplier">
                        </datalist>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('supplier.partials.supplierinfo')
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">@lang('home.account') @lang('home.summery')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="purcasehistory-tab" data-toggle="tab" href="#purcasehistory" role="tab" aria-controls="purcasehistory" aria-selected="false">@lang('home.purchase') @lang('home.history')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="paymenthistory-tab" data-toggle="tab" href="#paymenthistory" role="tab" aria-controls="paymenthistory" aria-selected="false">@lang('home.payment') @lang('home.history')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">@lang('home.document')</a>
                            </li>

                        </ul>
                        <div class="tab-content ml-1 " id="myTabContent">
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">


                                <table class="table-infodetails table table-hover">
                                    <thead>
                                        <tr>
                                            <th width='20%'>@lang('home.field')</th>
                                            <th>@lang('home.description')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="supplierinfodetails">
                                    </tbody>
                                </table>
                            </div>

                            <div style="padding:5px" class="tab-pane fade" id="purcasehistory" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                <div class="container">
                                    <h4 align="center" class="mt-1 mb-1" style="color:rebeccapurple; border-bottom:1px #ccc solid;"><b>Purchase History</b></h4>
                                    <table class="table table-bordered" cellspacing="0" id="purchasetable" width="100%">
                                        <thead>
                                            <tr>
                                                <th> #@lang('home.sl') </th>
                                                <th> @lang('home.purchase') @lang('home.no') </th>
                                                <th> @lang('home.date') </th>
                                                <th> @lang('home.amount')</th>
                                                <th> @lang('home.discount') </th>
                                                <th> @lang('home.vat') </th>
                                                <th> @lang('home.nettotal')</th>
                                                <th> @lang('home.status')</th>
                                                <th> @lang('home.user')</th>
                                                <th> @lang('home.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th> #@lang('home.sl') </th>
                                                <th> @lang('home.purchase') @lang('home.no') </th>
                                                <th> @lang('home.date') </th>
                                                <th> @lang('home.amount')</th>
                                                <th> @lang('home.discount') </th>
                                                <th> @lang('home.vat') </th>
                                                <th> @lang('home.nettotal')</th>
                                                <th> @lang('home.status')</th>
                                                <th> @lang('home.user')</th>
                                                <th> @lang('home.action')</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="paymenthistory" role="tabpanel" aria-labelledby="paymenthistory-tab">
                                <div class="container">
                                    <h4 align="center" class="mt-1 mb-1" style="color:rebeccapurple; border-bottom:1px #ccc solid;"><b>Payment History</b></h4>
                                    <table id="supplierpaymenttable" class="table table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th> #Sl </th>
                                                <th> Payment No </th>
                                                <th> Payment Date </th>
                                                <th> Amount</th>
                                                <th> Payment </th>
                                                <th> Balance Due </th>
                                                <th> Payment type </th>
                                                <th> User</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th> #Sl </th>
                                                <th> Payment No </th>
                                                <th> Payment Date </th>
                                                <th> Amount</th>
                                                <th> Payment </th>
                                                <th> Balance Due </th>
                                                <th> Payment type </th>
                                                <th> User</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                <div class="container">
                                    <table class="table data-table-document">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Type</th>
                                                <th>Remark</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabledocument">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-header">


            </div>
        </div>
    </div>
</div>


@include('supplier.partials.sviewscript')

@endsection