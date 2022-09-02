@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-7 form-single-input-section">
        <div class="card">
            <div class="card-header card-header-section">
                <div class="pull-left">
                    @lang('home.dayclose')
                </div>
                <!--  <div class="pull-right">
                    <div class="input-group  mb-1">
                        <div class="input-group date" data-provide="datepicker" id="datetimepicker">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.date')</span>
                            </div>
                            <input type="text" name="date" id="dateinput" class="form-control">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
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
                    </div>
                </div> -->
            </div>
            <div class="card-body" align="center">
                <table class="table table-bordered table-sm table-responsive" height="450px" width="100%">
                    <thead>
                        <tr>
                            
                            <th width="70%">Description</th>
                            <th width="30%">Amount</th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            
                            <th>Date</th>
                            <td id="date"></td>
                        </tr>
                        <tr>
                           
                            <th>Type</th>
                            <td id="type"></td>
                        </tr>
                        <tr id="monthview">
                            
                            <th>Month</th>
                            <td id="month"></td>
                        </tr>
                        <tr id="yearview">
                           
                            <th>Year</th>
                            <td id="year"></td>
                        </tr>
                        <tr>
                           
                            <th>Cash Invoice</th>
                            <td id="cashinvoice"></td>
                        </tr>
                        <tr>
                            
                            <th>Credit Invoice</th>
                            <td id=creditinvoice></td>
                        </tr>
                        <tr>
                            
                            <th>Sale Return</th>
                            <td id="salereturn"></td>
                        </tr>
                        <tr>
                          
                            <th>Purchase</th>
                            <td id="purchase"></td>
                        </tr>
                        <tr>
                           
                            <th>GRN</th>
                            <td id="grn"></td>
                        </tr>
                        <tr>
                           
                            <th>Purchase Return</th>
                            <td id="purchasereturn"></td>
                        </tr>
                        <tr>
                           
                            <th>Supplier Payment</th>
                            <td id="supplierpayment"></td>
                        </tr>
                        <tr>
                           
                            <th>Customer Payment Recieve</th>
                            <td id="customerpayment"></td>
                        </tr>
                        <tr>
                            
                            <th>Expenses</th>
                            <td id="expenses"></td>
                        </tr>
                        <tr>
                            
                            <th>Cash In</th>
                            <td id="cashin"></td>
                        </tr>
                        <tr>
                           
                            <th>Cash Out</th>
                            <td id="cashout"></td>
                        </tr>
                        <tr>
                            
                            <th>Cash Drawer</th>
                            <td id="cashdrawer"></td>
                        </tr>
                        <tr>
                            
                            <th>Cash In Bank</th>
                            <td id="cashinbank"></td>
                        </tr>
                        <tr>
                            
                            <th>Stock Amount</th>
                            <td id="stockamount"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer card-footer-section">
                <div class="pull-right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button id="reopen" class="btn btn-dark">Re Open</button>
                        <button id="pdf" class="btn btn-dark">Pdf</button>
                        <button id="datadelete" class="btn btn-dark">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('dayclose.partials.daycloseviewscript')
@endsection