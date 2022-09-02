@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header card-header-section">
        <div class="row">
            <div class="col-8 col-sm-4 col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">@lang('home.payment') @lang('home.no')</label>
                    </div>
                    <input type="text" class="form-control" id="paymentcode" list="paymentno" placeholder="@lang('home.search')">
                    <datalist id="paymentno">
                    </datalist>
                </div>
            </div>
            <div class="col-4 col-sm-8">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('home.action')
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('salary.salarypaymentloadall') }}" class="nav-link">@lang('home.salary') @lang('home.payment') @lang('home.list')</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('salary.createsalarypayment') }}" class="nav-link">@lang('home.new')</a>
                        <div class="dropdown-divider"></div>
                        <a id="pdf" class="nav-link">@lang('home.salary') @lang('home.sheet') @lang('home.pdf')</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link" id="paymentpdf"> @lang('home.pdf')</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link" id="deletedata">@lang('home.delete')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="inv-title">
            <h4 class="no-margin"><b>@lang('home.salary') @lang('home.payment')</b></h4>
        </div>
        @include('partials.ErrorMessage')
        <div class="row">

            <div class="col-sm-8 hidden-xs"></div>
            <div class="col-sm-4">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>@lang('home.payment') @lang('home.no')</th>
                        <td id="supplierpaymentno"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.date')</th>
                        <td id="inputdate"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.from')</th>
                        <td id="fromdate"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.to')</th>
                        <td id="todate"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.payment') @lang('home.type')</th>
                        <td id="paymenttype"></td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped table-responsive-sm table-sm" width="100%">
                    <thead>
                        <th>@lang('home.description')</th>
                        <th>@lang('home.payment') @lang('home.description')</th>
                        <th>@lang('home.remark')</th>
                        <th>@lang('home.amount')</th>
                    </thead>
                    <tbody id="tablebody">
                        <tr>
                            <td>Salary Payment</td>
                            <td id="paymentdescription" align="right"></td>
                            <td id="remark" align="right"></td>
                            <td id="netsalary" align="right"></td>
                        </tr>
                        <tr>
                            <th id="inwordsht">@lang('home.inwords'):</th>
                            <td id="inwords" colspan="4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    urlid = 0;

    function ViewPaymentCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('salary.salarycodedatalistactive') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#paymentno').html(data);
            },
            error: function(data) {}
        });
    }
    window.onload = ViewPaymentCode();

    function getUrl() {
        var url = $(location).attr('href')
        urlid = url.substring(url.lastIndexOf('/') + 1);
        SalaryInformation();
    }
    window.onload = getUrl();
    $("#paymentcode").on('input', function() {
        var val = this.value;
        if ($('#paymentno option').filter(function() {
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            urlid = $('#paymentno').find('option[value="' + val + '"]').attr('id');
            $.ajax({
                type: 'post',
                url: "{{ url('Session-Id/purchaseId')}}" + '/' + urlid,
                success: function() {
                    SalaryInformation();
                }
            });
        }
    });

    function SalaryInformation() {
        $.ajax({
            type: "get",
            url: "{{ url('Salary/getView')}}/" + urlid,
            datatype: ("json"),
            success: function(data) {
                $("#paymentcode").val(data.payment_no);
                LoadAll(data);

            },
            error: function(data) {
                console.log(data)
            }
        });
    }


    function LoadAll(data) {
        $("#supplierpaymentno").html(data.payment_no);
        $("#paymentdescription").html(data.payment_description);
        $("#inputdate").html(data.inputdate);
        $("#netsalary").html(data.netsalary);
        $("#fromdate").html(data.from_date);
        $("#todate").html(data.to_date);
        $("#paymenttype").html(data.payment_type == 1 ? 'Cash' : 'Bank');
        $("#inwords").html(numberToWords(data.netsalary) + " Only")
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

        url = "{{ url('Salary/pdf')}}" + '/' + urlid,
            window.open(url, '_blank');
    });

    $(document).on('click', '#deletedata', function() {
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
                        url: "{{ url('Salary/salarypaymentdelete')}}" + '/' + urlid,
                        success: function(data) {
                            url = "{{ route('salary.salarypayment')}}"
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
@endsection