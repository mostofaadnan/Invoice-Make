<script>
    var urlid;
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
    $("#expensescode").on('input', function() {
        var val = this.value;
        if ($('#expensesno option').filter(function() {
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            urlid = $('#expensesno').find('option[value="' + val + '"]').attr('id');
            $.ajax({
                type: 'post',
                url: "{{ url('Session-Id/expensesid')}}" + '/' + urlid,
                success: function() {
                    view();
                }
            });
        }
    });

    function view() {
        $.ajax({
            type: "get",
            url: "{{ url('Expenses/getView')}}",
            datatype: ("json"),
            success: function(data) {
                urlid = data.id;
                $("#expensescode").val(data.expenses_no);
                lodData(data);
            },
            error: function(data) {}
        });
    }
    window.onload = view();

    function lodData(data) {
        var paymenttype = data.payment_type;
        switch (paymenttype) {
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
        $("#expeenses_no").html(data.expenses_no)
        $("#expensesdate").html(data.inputdate)
        $("#refno").html(data.voucherno)
        $("#paymenttype").html(paymenttype)
        loadTableDetails(data);
    }

    function loadTableDetails(data) {
        $("#tablebody").empty();
        var sl = 1;
        $(".data-table tbody").append("<tr>" +
            "<td>" + sl + "</td>" +
            "<td>" + data.Exp_Title + "</td>" +
            "<td>" + data.expnenses_type['name'] + "</td>" +
            "<td>" + (data.description !== null ? data.description : '') + "</td>" +
            "<td align='right'>" + data.amount + "</td>" +
            "</tr>" +
            "<tr>" +
            "<td  align='right' colspan='4'><b>Total</b></td>" +
            "<td align='right'><b>" + data.amount + "</b></td>" +
            "</tr>" +
            "<tr>" +
            "<th>In Words</th>" +
            "<td colspan='4'>" + numberToWords(data.amount) + "</td>" +
            "</tr>"
        );
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
    $("#pdf").on('click', function() {
        url = "{{ url('Expenses/pdf')}}" + '/' + urlid,
            window.open(url, '_blank');
    });
    $(document).on('click', '#print', function() {
        url = "{{ url('Expenses/LoadPrintslip')}}" + '/' + urlid,
            window.open(url, '_blank');
    });
</script>