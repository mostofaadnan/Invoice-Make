<script>
    var urlid;

    function ViewPaymentCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('supplierpayment.paymentcodedatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#paymentno').html(data);
            },
            error: function(data) {}
        });
    }

    window.onload = ViewPaymentCode();

    $("#paymentcode").on('input', function() {
        var val = this.value;
        if ($('#paymentno option').filter(function() {
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            urlid = $('#paymentno').find('option[value="' + val + '"]').attr('id');
            $.ajax({
                type: 'post',
                url: "{{ url('Session-Id/spaymentid')}}" + '/' + urlid,
                success: function() {
                    PayMentInfo();
                }
            });
        }
    });

    function PayMentInfo() {
        $.ajax({
            type: "get",
            url: "{{ url('SupplierPayment/getView')}}",
            datatype: ("json"),
            success: function(data) {
                $("#paymentcode").val(data.payment_no);
                urlid = data.id;
                lodData(data);
                supplierinfo(data.supplier_id);

            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    window.onload = PayMentInfo();

    function lodData(data) {
        var paymenttype = "";
        switch (data.payment_id) {
            case 1:
                paymenttype = 'Cash';
                break;
            case 2:
                paymenttype = 'Card';
                break;
            default:
                paymenttype = 'Bank';
                break;

        }
        $("#supplierpaymentno").html(data.payment_no)
        $("#paymentdate").html(data.inputdate)
        $("#paymenttype").html(paymenttype)
        $("#amount").html(data.amount)
        $("#payment").html(data.payment)
        $("#balancedue").html(data.balancedue)
        $("#inwords").html(numberToWords(data.payment) + " Only")
    }

    function supplierinfo(supid) {
        $.ajax({
            type: 'get',
            url: "{{url('Supplier/supplierinfo')}}?supplierid=" + supid,
            success: function(data) {
                supplierInformation(data.supplier);
                SupplierinfoDetails(data);
            },
            error: function(data) {
                console.log(data);
            }
        });

    }

    function supplierInformation(data) {
        $("#suppliername").html(data.name);
        $("#supplieraddress").html("<p>" + data.address + "," + data.city_name['name'] + "," + data.state_name['name'] + ",</p>");
        $("#suppliercountry").html("<p>" + data.country_name['name'] + ".</p>");
        $("#mobile").html("&nbsp;&nbsp;" + data.mobile_no);
        $("#telno").html("&nbsp;&nbsp;" + data.tell_no);
        $("#email").html("&nbsp;&nbsp;" + data.email);
        $("#website").html("&nbsp;&nbsp;" + data.website);
    }

    function SupplierinfoDetails(data) {

        $("#consignment").html('<b>' + data.consignment + '</b>')
        $("#sdiscount").html('<b>' + data.discount + '</b>')
        $("#spayment").html('<b>' + data.payment + '</b>')
        $("#sbalancedue").html('<b>' + data.balancedue + '</b>')
    }

    function numberToWords(number) {
        var digit = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        var elevenSeries = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
        var countingByTens = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
        var shortScale = ['', 'thousand', 'million', 'billion', 'trillion'];
        number = number.toString();
        number = number.replace(/[\, ]/g, '');
        if (number != parseFloat(number)) return 'not a number';
        var x = number.indexOf('.');
        if (x == -1) x = number.length;
        if (x > 15) return 'too big';
        var n = number.split('');
        var str = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += elevenSeries[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += countingByTens[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += digit[n[i]] + ' ';
                if ((x - i) % 3 == 0) str += 'hundred ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk) str += shortScale[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != number.length) {
            var y = number.length;
            str += 'point ';
            for (var i = x + 1; i < y; i++) str += digit[n[i]] + ' ';
        }
        str = str.replace(/\number+/g, ' ');
        return str.trim() + ".";

    }
    $(document).on('click', "#pdf", function() {
        url = "{{ url('SupplierPayment/pdf')}}" + '/' + urlid,
            window.open(url, '_blank');
    })
    $("#mail").on('click', function() {
    if (urlid > 0) {
      url = "{{ url('SupplierPayment/sendmail')}}" + '/' + urlid,
        window.location = url;
    }
  });
    $(document).on('click', '#datadelete', function() {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this  data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: "{{ url('SupplierPayment/delete')}}" + '/' + urlid,
                        success: function(data) {
                            url = "{{ route('supplierpayments')}}",
                                window.location = url;
                        },
                        error: function() {
                            swal("Opps! Faild", "Form Submited Faild", "error");
                        }
                    });
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });


    });
</script>