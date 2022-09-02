@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-header card-header-section">
        <div class="row">
            <div class="col-8 col-sm-4 col-md-4">
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
                    @lang("home.action")
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('cashincashouts') }}" class="nav-link">@lang('home.cashin')/@lang('home.cashout') @lang('home.list')</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('cashincashout.create') }}" class="nav-link">@lang("home.new")</a>
                        <div class="dropdown-divider"></div>
                        <a id="pdf" class="nav-link">@lang('home.pdf')</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link" id="datadelete">@lang('home.delete')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="inv-title">
            <h4 class="no-margin"><b>@lang("home.cashin")/@lang("home.cashout")</b></h4>
        </div>
        @include('partials.ErrorMessage')
        <div class="row">
            <div class="col-sm-8 hidden-xs"></div>

            <div class="col-sm-4">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>@lang('home.payment') @lang('home.no')</th>
                        <td id="reqpaymentno"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.type')</th>
                        <td id="type"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.date')</th>
                        <td id="paymentdate"></td>
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
                <table class="table table-bordered table-striped table-responsive-sm table-sm mt-2" width="100%">
                    <thead>
                        <th>@lang('home.description')</th>
                        <th>@lang('home.payment') @lang('home.description')</th>
                        <th>@lang('home.remark')</th>
                        <th>@lang('home.amount')</th>
                    </thead>
                    <tbody id="tablebody">
                        <tr>
                            <td>@lang("home.cashin")/@lang("home.cashout")</td>
                            <td id="description"></td>
                            <td id="remark"></td>
                            <td id="amount" align="right"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var urlid;

    function ViewPaymentCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('cashincashout.cicocodedatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#paymentno').html(data);
                console.log(data)
            },
            error: function(data) {}
        });
    }
    window.onload = ViewPaymentCode();

    function getUrl() {
        var url = $(location).attr('href')
        urlid = url.substring(url.lastIndexOf('/') + 1);
        PaymentInfortion(urlid);

    }
    window.onload = getUrl();
    $("#paymentcode").on('input', function() {
        var val = this.value;
        if ($('#paymentno option').filter(function() {
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            urlid = $('#paymentno').find('option[value="' + val + '"]').attr('id');
            PaymentInfortion(urlid);
        }
    });

    function PaymentInfortion(urlid) {
        $.ajax({
            type: "get",
            url: "{{ url('CashInCashOut/getView')}}" + '/' + urlid,
            datatype: ("json"),
            success: function(data) {

                $("#paymentcode").val(data.payment_no);
                loadData(data);
            },
            error: function() {
                console.log(data);

            }
        });
    }

    function loadData(data) {
        $("#reqpaymentno").html(data.payment_no);
        $("#paymentdate").html(data.inputdate);
        $("#type").html(data.type == 1 ? 'CashIn' : 'Cash Out');
        $("#paymenttype").html(data.source == 1 ? 'Cash' : 'Bank');
        $("#amount").html('<b>' + data.amount + '</b>');
        $("#description").html(data.payment_description);
        $("#remark").html(data.remark);
    }
    $(document).on('click', "#pdf", function() {
        var dataid = $(this).data("id");
        url = "{{ url('CashInCashOut/pdf')}}" + '/' + urlid,
            window.location = url;
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
                    var dataid = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "{{ url('CashInCashOut/delete')}}" + '/' + dataid,
                        success: function(data) {
                            url = "{{ route('cashincashouts')}}",
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