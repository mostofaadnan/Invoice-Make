@extends('layouts.master')
@section('content')
<style>
    .btn {
        border: 1px #fff solid;
    }

    .paymentbox {
        display: none;

    }

    #amount {
        text-align: right;
        font-style: bold;
        color: #ff3547;
        font-size: 16px;
    }
</style>
<div class="row">
    <div class="col-sm-7 form-single-input-section ">
        <div class="card card-design">
            <div class="card-header card-header-section">
                <div class="pull-left">
                    @lang('home.new') @lang('home.salary') @lang('home.payment')
                </div>
                <div class="pull-right">
                    <button class="btn btn-outline-success">Salary Payment List</button>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-2"></div>
                <div class="container">
                    <div class="row">
                        <div class="input-group col-12 col-sm-6 col-md-6 mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text">@lang('home.payment') @lang('home.number')</label>
                            </div>
                            <input type="text" class="form-control" id="paymentcode" list="paymentno" placeholder="@lang('home.search')">
                            <datalist id="paymentno">
                            </datalist>
                        </div>
                        <div class="input-group col-12 col-sm-6 col-md-6 mb-1">
                            <div class="input-group date" data-provide="datepicker" id="datetimepicker2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">@lang('home.date')</span>
                                </div>
                                <input type="text" name="openingdate" id="inputdate" class="form-control" data-date="">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group mb-1 col-12 col-sm-6 col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> @lang('home.payment') @lang('home.type')</span>
                            </div>
                            <select id="paymenttype" class="form-control">
                                <option value="1">Cash</option>
                                <option value="2">Bank</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div id="cashpanel">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('home.amount')</span>
                                    </div>
                                    <input type="number" class="form-control" id="amount" placeholder="@lang('home.amount')" readonly>
                                </div>
                            </div>
                            <div class="paymentbox" id="bankpanel">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('home.bank')</span>
                                    </div>
                                    <input type="text" class="form-control" id="banknamesearch" placeholder="@lang('home.bank')" list="banknames" required>
                                    <datalist id="banknames">
                                    </datalist>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('home.account') @lang('home.number')</span>
                                    </div>
                                    <input type="text" class="form-control sumsection-input-text" id="accno" placeholder="@lang('home.account') @lang('home.number')">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@lang('home.description')</span>
                                    </div>
                                    <textarea name="" id="bankdescrp" cols="35" rows="2" class="form-control sumsection-input-text" placeholder="@lang('home.bank') @lang('home.description')"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">@lang('home.remark')</span>
                        </div>
                        <textarea name="" class="form-control" id="remark" cols="5" rows="5" placeholder="@lang('home.remark')"></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer card-footer-section">
                <div class="pull-right">
                    <div class="btn-group button-grp" role="group" aria-label="Basic example">
                        <button type="submit" id="datasubmit" class="btn btn-success btn-lg">@lang('home.submit')</button>
                        <button id="reset btn-lg" class="btn btn-light clear_field">@lang('home.reset')</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var paymentid = 0;

    function ViewPaymentCodeInactive() {
        $.ajax({
            type: 'get',
            url: "{{ route('salary.salarycodedatalistInactive') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#paymentno').html(data);
            },
            error: function(data) {}
        });
    }
    window.onload = ViewPaymentCodeInactive();
    $("#paymentcode").on('input', function() {
        var val = this.value;
        if (val) {
            if ($('#paymentno option').filter(function() {
                    return this.value.toUpperCase() === val.toUpperCase();
                }).length) {
                paymentid = $('#paymentno').find('option[value="' + val + '"]').attr('id');
                var amount = $('#paymentno').find('option[value="' + val + '"]').attr('data-netsalary');
                $("#amount").val(amount);
            }
        } else {
            $("#amount").val("");
        }
    });
    $(function() {
        var myDate = $("#inputdate").attr('data-date');
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var currentmonth = new Date(date.getFullYear(), date.getMonth());
        $('#inputdate').datepicker({
            dateFormat: 'yyyy/mm/dd',
            todayHighlight: true,
            startDate: today,
            endDate: end,
            autoclose: true
        });
        $('#inputdate').datepicker('setDate', myDate);
        $('#inputdate').datepicker('setDate', today);
    });


    function banknameDataList() {
        $.ajax({
            type: 'get',
            url: "{{ route('bankname.banknamedatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#banknames').html(data);
            },
            error: function(data) {}
        });
    }

    window.onload = banknameDataList();
    $('#paymenttype').change(function() {
        var type = $(this).val();
        console.log(type)
        if (type == 1) {

            $("#bankpanel").hide();

        } else {

            $("#bankpanel").show();

        }

    });

    //insert Section
    function BalanceCheck() {
        var payment = $("#amount").val();
        $.ajax({
            type: "get",
            url: "{{ route('cashdrawer.balancechek') }}",
            data: {
                payment: payment
            },
            datatype: ("json"),
            success: function(data) {
                if (data == 1) {
                    var paymentdescription = "Cash Payment"
                    DataInsert(paymentdescription);
                } else {
                    swal("Ops! Insuffisiant Cash Balance", "Data Submit", "error");
                }
            }
        });
    }
    //inset Data
    function DataInsert(paymentdescription, bankname, accno, bankdescrip) {
        $("#overlay").fadeIn();
        var inputdate = $("#inputdate").val();
        var paymenttype = $("#paymenttype").val();
        var remark = $("#remark").val();
        $.ajax({
            type: "POST",
            url: "{{ route('salary.salarypaymentstore') }}",
            data: {
                paymentid: paymentid,
                inputdate: inputdate,
                remark: remark,
                paymenttype: paymenttype,
                paymentdescription: paymentdescription,
                bankname: bankname,
                accno: accno,
                bankdescrip: bankdescrip,
            },
            datatype: ("json"),
            success: function(data) {
                $("#overlay").fadeOut();
                if (data > 0) {
                    Confirmation(data)
                } else {
                    swal("Ops! Fail To submit", "Data Submit", "error");
                }
            },
            error: function(data) {
                $("#overlay").fadeOut();
                console.log(data);
                swal("Ops! Fail To submit", "Data Submit", "error");

            }
        });
    }
    $("#datasubmit").on('click', function() {
        var inputdate = $("#inputdate").val();
        var amount = $("#amount").val();
        if (paymentid == 0 || inputdate == "" || amount == 0 || amount == "") {
            swal("Requirement Field", "Please Select Requirement fields to fillup", "error");
        } else {
            var type = $("#paymenttype").val();
            if (type == 1) {
                BalanceCheck();
            } else {
                var bankname = $("#banknamesearch").val();
                var bankid = $('#banknames').find('option[value="' + bankname + '"]').attr('id');
                var accno = $("#accno").val();
                var bankdescrip = $("#bankdescrp").val();
                var bankamount = $("#bankamount").val();
                var paymentdescription = "Bank:" + bankname + "\n" + "Acc No:" + accno;
                if (bankid == 0 || accno == "" || bankamount == 0 || bankamount == "") {
                    swal("Please Select Bank Requirment Fields", "Requirment Field Empty", "error");
                } else {
                    DataInsert(paymentdescription, bankname, accno, bankdescrip);
                }
            }

        }

    });

    function ExecuteClear() {
        paymentid = 0;
        $("#paymentcode").val("");
        $("#amount").val("");
        $("#remark").val("");
        $("#banknamesearch").val("");
        $("#accno").val("");
        $("#bankdescrp").val("");
        $("#bankpanel").hide();
        ViewPaymentCodeInactive();
    }

    function Confirmation(data) {
        swal("Successfully Data Save", "Data Submit", "success", {
                buttons: {
                    cancel: "Cancel",
                    Show: "Show",
                    catch: {
                        text: "Print",
                        value: "catch",
                    },
                    datapdf: {
                        text: "Pdf",
                        value: "datapdf",
                        background: "#endregion",
                    },
                    Cancel: false,
                },
            })
            .then((value) => {
                switch (value) {

                    case "Show":
                        url = "{{ url('Salary/salarypaymentshow')}}" + '/' + data,
                            window.location = url;
                        break;
                    case "catch":

                        url = "{{ url('Expenses/print')}}" + '/' + data,
                            window.location = url;
                        break;
                    case "datapdf":

                        url = "{{ url('Expenses/pdf')}}" + '/' + data,
                            window.location = url;
                        break;

                    default:
                        //swal("Thank You For Your Choice");
                }
            });
        ExecuteClear();
    }
</script>
@endsection