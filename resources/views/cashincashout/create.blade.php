@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-7 form-single-input-section ">
        <div class="card">
            <div class="card-header  card-header-section">
            @lang("home.new") @lang("home.cashin")/@lang("home.cashout")
            </div>
            <div class="card-body">
                @include('cashincashout.partials.cashincashoutform')
            </div>
            <div class="card-footer  card-footer-section">
                <div class="pull-right">
                    <button type="submit" id="datasubmit" class="btn btn-success">@lang("home.submit")</button>
                    <button id="reset" class="btn btn-light clear_field">@lang("home.reset")</button>
                    <button id="deletedata" class="btn btn-danger">@lang("home.cancel")</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function PaymentCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('cashincashout.paymentno') }}",
            datatype: 'JSON',
            success: function(data) {
                $("#paymentno").val(data);
            },
            error: function(data) {}
        });
    }

    window.onload = PaymentCode();
    //Insert Data
    function DataInsert(paymentdescription, bankname, accno, bankdescrip) {
        $("#overlay").fadeIn();
        var paymentno = $("#paymentno").val();
        var inputdate = $("#dateinput").val();
        var type = $("#type_id").val();
        var paymenttype = $("#paymenttype").val();
        var amount = $("#amount").val();
        var remark = $("#remark").val();
        $.ajax({
            type: "POST",
            url: "{{ route('cashincashout.store') }}",
            data: {
                paymentno: paymentno,
                inputdate: inputdate,
                type: type,
                source: paymenttype,
                amount: amount,
                remark: remark,
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
                swal("Data Submit", "Data Insert Fail", "error");
            }
        });
    }

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
    $("#datasubmit").on('click', function() {

        var inputdate = $("#dateinput").val();
        var amount = $("#amount").val();
        var paymenttype = $("#paymenttype").val();

        if (inputdate == "" || amount == "" || amount == 0) {
            swal("Requirement Field", "Please Select Requirement fields to fillup", "error");
        } else {
            if (paymenttype == 1) {
                var type = $("#type_id").val();
                if (type == 1) {
                    var paymentdescription = "Cash Payment"
                    DataInsert(paymentdescription);
                } else {
                    BalanceCheck();
                }
            } else {
                var bankname = $("#banknamesearch").val();
                bankid = $('#banknames').find('option[value="' + bankname + '"]').attr('id');
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
        PaymentCode();
        $("#type_id").val("1");
        $("source_id").val("1")
        $("#amount").val("");
        $("#remark").val("");
        $("#banknamesearch").val("");
        $("#accno").val("");
        $("#bankdescrp").val("");
        $("#bankpanel").hide();
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
                        url = "{{ url('CashInCashOut/show')}}" + '/' + data,
                            window.location = url;
                        break;
                    case "catch":
                        url = "{{ url('Expenses/print')}}" + '/' + data,
                            window.location = url;
                        break;
                    case "datapdf":

                        url = "{{ url('CashInCashOut/pdf')}}" + '/' + data,
                            window.open(url, '_blank');
                        break;

                    default:
                        //swal("Thank You For Your Choice");
                }
            });
        ExecuteClear();
    }
</script>
@endsection