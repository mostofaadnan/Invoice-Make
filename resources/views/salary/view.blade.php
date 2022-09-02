@extends('layouts.master')
@section('content')

<div class="container">
    <div class="card invoice-section">
        <div class="card-header card-header-section">
            <div class="row">
                <div class="col-6 col-sm-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">@lang('home.payment') @lang('home.number')</label>
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
                            <a href="{{ route('salaries') }}" class="nav-link">@lang('home.salary') @lang('home.list')</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('salary.create') }}" class="nav-link">@lang('home.new')</a>
                            <div class="dropdown-divider"></div>
                            <a class="nav-link">@lang('home.edit')</a>
                            <div class="dropdown-divider"></div>
                            <a id="datadelete" class="nav-link delete">@lang('home.delete')</a>
                            <div class="dropdown-divider"></div>
                            <a id="pdf" class="nav-link">@lang('home.export') @lang('home.pdf')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('partials.ErrorMessage')
            <div class="inv-title">
                <h4 class="no-margin">@lang('home.salary') @lang('home.sheet')</h4>
            </div>
            <div class="row">
                <div class="col-12 col-sm-8"></div>
                <div class="col-12 col-sm-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('home.payment') @lang('home.number')</th>
                            <td id="payment_no"></td>
                        </tr>
                        <!--   <tr>
                            <th>@lang('home.date')</th>
                            <td id="inputdate"></td>
                        </tr> -->
                        <tr>
                            <th>@lang('home.from') @lang('home.date')</th>
                            <td id="fromdate"></td>
                        </tr>
                        <tr>
                            <th>@lang('home.to') @lang('home.date')</th>
                            <td id="todate"></td>
                        </tr>
                        <tr>
                            <th>@lang('home.payment') @lang('home.type')</th>
                            <td id="status"></td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-sm-12">
                    <table class="table table-bordered table-striped table-responsive table-sm  data-table" width="100%">
                        <thead>
                            <th width="5%">#@lang('home.sl')</th>
                            <th>@lang('home.name')</th>
                            <th>@lang('home.designation')</th>
                            <th>@lang('home.joining') @lang('home.date')</th>
                            <th width="5%">@lang('home.salary')</th>
                            <th width="8%">@lang('home.overtime')</th>
                            <th width="8%">@lang('home.bonus')</th>
                            <th width="9%">@lang('home.reduction')</th>
                            <th width="8%">@lang('home.netsalary')</th>
                        </thead>
                        <tbody id="tablebody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    urlid = 0;

    function ViewPaymentCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('salary.salarycodedatalist') }}",
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
                console.log(data)
                LoadAll(data);
                loadTableDetails(data.details);
                ActiveInactivePanel(data);
            },
            error: function(data) {
                console.log(data)
            }
        });
    }

    function ActiveInactivePanel(data) {
        if (data.status == 0) {
            $(".delete").show();
        } else {
            $(".delete").hide();
        }
    }


    function LoadAll(data) {
        $("#payment_no").html(data.payment_no);
        /*  $("#inputdate").html(data.inputdate); */
        $("#fromdate").html(data.from_date);
        $("#todate").html(data.to_date);
        $("#status").html(data.status == 1 ? 'Payment' : 'Not Payment');
    }

    function loadTableDetails(data) {
        $("#tablebody").empty();
        var sl = 1;

        data.forEach(function(value) {
            $(".data-table tbody").append("<tr>" +
                "<td>" + sl + "</td>" +
                "<td>" + value.employee_name['name'] + "</td>" +
                "<td>" + value.employee_name['designation'] + "</td>" +
                "<td>" + value.employee_name['joining_date'] + "</td>" +
                "<td align='right'>" + value.salary + "</td>" +
                "<td align='right'>" + value.over_time + "</td>" +
                "<td align='right'>" + value.bonus + "</td>" +
                "<td align='right'>" + value.reduction + "</td>" +
                "<td  align='right'>" + value.netsalary + "</td>" +
                "</tr>");
            sl++;
            "<tr>" +
            "<td colspan='4' align='right'><b>Net Total</b></td>" +
            "<td align='right'><b>" + data.total_salary + "</b></td>" +
                "<td align='right'><b>" + data.total_over_time + "</b></td>" +
                "<td align='right'><b>" + data.total_bonus + "</b></td>" +
                "<td align='right'><b>" + data.total_reduction + "</b></td>" +
                "<td align='right'><b>" + data.netsalary + "</b></td>" +
                "</tr>"
        })
    }
    $(document).on('click', "#pdf", function() {

        url = "{{ url('Salary/pdf')}}" + '/' + urlid,
            window.open(url, '_blank');
    });
</script>
@endsection