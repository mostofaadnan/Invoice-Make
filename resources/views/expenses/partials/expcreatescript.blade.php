<script>
    function ViewInvoiceCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('expenses.expensescodedatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#expensesno').html(data);
            },
            error: function(data) {}
        });
    }
    window.onload = ViewInvoiceCode();

    function ExpensesCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('expenses.expensesno') }}",
            datatype: 'JSON',
            success: function(data) {
                $("#expensesno").val(data);
            },
            error: function(data) {}
        });
    }

    function ExpensesType() {
        $.ajax({
            type: 'get',
            url: "{{ route('expensestype.expensestypedatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#expensestype').html(data);
            },
            error: function(data) {}
        });
    }
    window.onload = ExpensesType();
    window.onload = ExpensesCode();

    $("#expensestypesearch").on('input', function() {
        var val = this.value;
        if (val == "") {
            //clear();
        } else {
            if ($('#expensestype option').filter(function() {
                    return this.value.toUpperCase() === val.toUpperCase();
                }).length) {
                expenses_type = $('#expensestype').find('option[value="' + val + '"]').attr('id');
                $("#exptypeid").val(expenses_type);
            }
        }

    });

    /*     function loadData(data) {
            $("#openingbalance").val(data.openingBalance);
            $("#consignment").val(data.consignment);
            $("#paidamount").val(data.payment);
            oldpayment = data.payment;
            $("#balancedue").val(data.balancedue);
            balancedue = data.balancedue;
        } 
        $("#payment").on('keyup', function() {
            if (balancedue == 0) {} else {
                payment = $(this).val();
                if (payment <= balancedue) {
                    newbalancedue = balancedue - payment;
                    $("#newbalancedue").val(newbalancedue);
                } else {
                    $("#newbalancedue").val("");
                }
            }

        }); */


    function ExecuteClear() {
        $("#expensestypesearch").val("");
        $("#expensesno").val("");
        $("#title").val("");
        $("#exptypeid").val("");
        $("#amount").val("");
        $("#remark").val("");
        $("#voucher_no").val("");
        $("#banknamesearch").val("");
        $("#accno").val("");
        $("#bankdescrp").val("");
        $("#bankpanel").hide();
        ExpensesCode();

    }
    $("#reset").on('click', function() {
        ExecuteClear();

    });

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
        var expnsesno = $("#expensesno").val();
        var title = $("#title").val();
        var inputdate = $("#dateinput").val();
        var exptypeid = $("#exptypeid").val();
        var amount = $("#amount").val();
        var paymenttype = $("#paymenttype").val();
        var voucherno = $("#voucher_no").val();
        var remark = $("#remark").val();
        var expensestype = $("#expensestypesearch").val();

        $.ajax({
            type: "POST",
            url: "{{ route('expenses.store') }}",
            data: {
                expensesno: expnsesno,
                title: title,
                expenses_type: exptypeid,
                dateinput: inputdate,
                amount: amount,
                remark: remark,
                paymenttype: paymenttype,
                voucher_no: voucherno,
                paymentdescription: paymentdescription,
                bankname: bankname,
                accno: accno,
                bankdescrip: bankdescrip,
                expensestype: expensestype

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
        /*  e.preventDefault(); */
        var title = $("#title").val();
        var inputdate = $("#dateinput").val();
        var exptypeid = $("#exptypeid").val();
        var amount = $("#amount").val();
        var paymenttype = $("#paymenttype").val();

        if (title == "" || inputdate == "" || exptypeid == "" || amount == "" || amount == 0) {
            swal("Requirement Field", "Please Select Requirement fields to fillup", "error");
        } else {
            var type = $("#paymenttype").val();
            if (type == 1) {
                BalanceCheck();
            } else {
                var bankname = $("#banknamesearch").val();
                bankid = $('#banknames').find('option[value="' + bankname + '"]').attr('id');
                var accno = $("#accno").val();
                var bankdescrip = $("#bankdescrp").val();
                var paymentype = 2;
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
                        url = "{{ url('Expenses/show')}}" + '/' + data,
                            window.location = url;
                        break;
                    case "catch":
                        url = "{{ url('Expenses/LoadPrintslip')}}" + '/' + data,
                            window.open(url, '_blank');
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