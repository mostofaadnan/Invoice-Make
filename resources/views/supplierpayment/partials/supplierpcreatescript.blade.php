<script>
    var supplierid = 0;
    var balancedue = 0;
    var newbalancedue = 0;
    var oldpayment = 0;
    var payment = 0;


    function purchaseCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('supplierpayment.paymentno') }}",
            datatype: 'JSON',
            success: function(data) {
                $("#paymentno").val(data);
            },
            error: function(data) {}
        });
    }

    function PaymentCodeDataList() {
        $.ajax({
            type: 'get',
            url: "{{ route('supplierpayment.paymentcodedatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $("#spaymantno").html(data);
            },
            error: function(data) {}
        });
    }

    function SupplierDataList() {
        $.ajax({
            type: 'get',
            url: "{{ route('supplier.suplierdatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#supplier').html(data);
            },
            error: function(data) {}
        });
    }
    window.onload = SupplierDataList();
    window.onload = purchaseCode();
    window.onload = PaymentCodeDataList();

    function clear() {
        supplierid = 0;
        balancedue = 0;
        newbalancedue = 0;
        $("#openingbalance").val("");
        $("#consignment").val("");
        $("#paidamount").val("");
        $("#balancedue").val("");
        $("#payment").val("");
        $("#newbalancedue").val("");
        $("#banknamesearch").val("");
        $("#accno").val("");
        $("#bankdescrp").val("");
        $("#bankpanel").hide();
    }
    $("#suppliersearch").on('input', function() {
        var val = this.value;
        if (val == "") {
            clear();
        } else {
            if ($('#supplier option').filter(function() {
                    return this.value.toUpperCase() === val.toUpperCase();
                }).length) {
                supplierid = $('#supplier').find('option[value="' + val + '"]').attr('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('Supplier/getAmounthistory')}}" + '/' + supplierid,
                    datatype: ("json"),
                    success: function(data) {
                        loadData(data);
                    },
                    error: function() {}
                });
            }
        }

    });

    function loadData(data) {
        $("#consignment").val(data.consignment);
        $("#totaldiscount").val(data.openingBalance);
        $("#paidamount").val(data.payment);
        $("#totaldiscount").val(data.discount);
        oldpayment = data.payment;
        $("#balancedue").val(data.balancedue);
        balancedue = data.balancedue;
    }
    $("#payment").on('keyup', function() {
        if (balancedue == 0) {


        } else {
            payment = $(this).val();
            newbalancedue = (balancedue - payment).toFixed(2);
           if(newbalancedue > 0 || newbalancedue==0){
            $("#newbalancedue").val(newbalancedue);
           }else{
            $("#newbalancedue").val(""); 
           }
           
        }

    });

    function BalanceCheck() {
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

    function ExecuteClear() {
        $("#suppliersearch").val("");
        purchaseCode();
        PaymentCodeDataList();
        clear();
    }
    //inset Data
    function DataInsert(paymentdescription, bankname, accno, bankdescrip) {
        $("#overlay").fadeIn();
        var paymentno = $("#paymentno").val();
        var inputdate = $("#inputdate").val();
        var amount = $("#balancedue").val();
        var newbalancedue = $("#newbalancedue").val();
        var paymenttype = $("#paymenttype").val();
        var remark = $("#remark").val();
        console.log(paymenttype);
        $.ajax({
            type: "post",
            url: "{{ route('supplierpayment.store') }}",
            //data: JSON.stringify(itemtables),
            data: {
                paymentno: paymentno,
                inputdate: inputdate,
                supplier_id: supplierid,
                amount: amount,
                payment: payment,
                oldpayment: oldpayment,
                newbalancedue: newbalancedue,
                paymenttype: paymenttype,
                remark: remark,
                paymentdescription: paymentdescription,
                bankname: bankname,
                accno: accno,
                bankdescrip: bankdescrip,

            },
            datatype: ("json"),
            success: function(data) {
                $("#overlay").fadeOut();
                Confirmation(data);
            },
            error: function(data) {
                $("#overlay").fadeOut();
                swal("Ops! Fail To submit", "Data Submit", "error");
                console.log(data)
            }
        });
    }
    $("#datasubmit").on('click', function() {
        var nbalancedue = $("#newbalancedue").val();

        if (payment == 0 || supplierid == 0 || nbalancedue == "" || nbalancedue<0) {
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
                    cancel: "Close",
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
                        url = "{{ url('SupplierPayment/show')}}" + '/' + data,
                            window.location = url;
                        break;
                    case "catch":
                        //PurchasePrint();
                        break;
                    case "datapdf":
                        url = "{{ url('SupplierPayment/pdf')}}" + '/' + data,
                            window.open(url, '_blank');
                        break;

                    default:
                        //swal("Thank You For Your Choice");
                }
            });
        ExecuteClear();
    }

    //retrive
    /*  $("#search").on('input', function() {
         var val = this.value;
         if ($('#spaymantno option').filter(function() {
                 return this.value.toUpperCase() === val.toUpperCase();
             }).length) {
             var productid = $('#spaymantno').find('option[value="' + val + '"]').attr('id');

             $.ajax({
                 type: "get",
                 url: "{{ url('SupplierPayment/getView')}}" + '/' + productid,
                 datatype: ("json"),
                 success: function(data) {
                     console.log(data);
                     lodDataRetrive(data);
                 },
                 error: function() {


                 }
             });
         }
     });

     function lodDataRetrive(data) {
         $("#paymentno").val(data.payment_no);
         $("#dateinput").val(data.inputdate)
         $("#suppliersearch").val(data.supplier_name['name'])
         $("#openingbalance").val(data.supplier_name['openingBalance'])
         $("#consignment").val(data.supplier_name['consignment'])
         $("#balancedue").val(data.supplier_name['balancedue'])
         $("#paidamount").val(data.supplier_name['payment'])
         $("#payment").val(data.payment)
         $("#newbalancedue").val(data.balancedue);
     } */
</script>