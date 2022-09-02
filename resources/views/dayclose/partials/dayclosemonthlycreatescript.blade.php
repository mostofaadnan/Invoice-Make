<script>
    function accountSummerise() {
        /*  var d = new Date();
         var month = d.getMonth() + 1;
         var day = d.getDate();
         var submitdate = d.getFullYear() + '/' +
             (month < 10 ? '0' : '') + month + '/' +
             (day < 10 ? '0' : '') + day; */

        /*   var openingdate = $("#dateinput").val();
          console.log(openingdate); */
        //  LoadData(submitdate);
    }
    $('#datepicker').on('change', function(e) {
        var month = $("#month").val();
        LoadData(month);
    })

    function LoadData(month) {
        var openingdate = $("#dateinput").val();
        $.ajax({
            type: 'get',
            url: "{{ route('dayclose.getDataMonthly') }}",
            data: {
                date: month
            },
            datatype: 'JSON',
            success: function(data) {
              
                $("#cashinvoice").val(parseFloat(data.cashinvoice).toFixed(2))
                $("#creditinvoice").val(parseFloat(data.creditinvoice).toFixed(2))
                $("#purchase").val(parseFloat(data.purchase).toFixed(2))
                $("#ppayment").val(parseFloat(data.SupplierPayment).toFixed(2))
                $("#cpayment").val(parseFloat(data.CustomerRecieved).toFixed(2))
                $("#cdrawer").val(parseFloat(data.balance).toFixed(2))
                $("#expencess").val(parseFloat(data.Expenses).toFixed(2))
                $("#salereturn").val(parseFloat(data.salereturn).toFixed(2))
                $("#grn").val(parseFloat(data.grn).toFixed(2))
                $("#purchasereturn").val(parseFloat(data.purchasereturn).toFixed(2));
                $("#cashin").val(parseFloat(data.totalcashin).toFixed(2));
                $("#cashout").val(parseFloat(data.totalcashout).toFixed(2));
                $("#cashinbank").val(parseFloat(data.Bank).toFixed(2));
                $("#stockamount").val(parseFloat(data.stockamount).toFixed(2));
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    $("#reset").on('click', function(e) {
        e.preventDefault();
        $("#cashinvoice").val("0.00");
        $("#creditinvoice").val("0.00");
        $("#purchase").val("0.00");
        $("#ppayment").val("0.00");
        $("#cpayment").val("0.00");
        $("#expencess").val("0.00");
        $("#salereturn").val("0.00");
        $("#grn").val("0.00");
        $("#purchasereturn").val("0.00");
        $("#cashin").val("0.00");
        $("#cashout").val("0.00");
        $("#stockamount").val("0.00");

    });
</script>