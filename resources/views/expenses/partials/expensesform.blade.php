<style>
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
    <div class="input-group col-sm-6  mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text"> @lang("home.expenses") @lang("home.number")</span>
        </div>
        <input type="text" class="form-control" id="expensesno" name="expensesno" placeholder="@lang('home.expenses') @lang('home.number')" readonly>
    </div>
    <div class="input-group  col-sm-6 mb-1">
        <div class="input-group date" data-provide="datepicker" id="datetimepicker2">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">@lang('home.opening') @lang('home.date') </span>
            </div>
            <input type="text" name="openingdate" id="dateinput" class="form-control">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
</div>
<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">@lang("home.title")</span>
    </div>
    <input type="text" class="form-control" name="title" id="title" placeholder="@lang('home.title')">
</div>
<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">@lang("home.expenses") @lang("home.type")</span>
    </div>
    <input type="text" class="form-control" id="expensestypesearch" placeholder="@lang('home.expenses') @lang('home.type')" list="expensestype">
    <datalist id="expensestype">
    </datalist>
    <input type="hidden" name="expenses_type" id="exptypeid">
</div>
<div class="input-group  mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text">@lang("home.voucher") @lang("home.number")</span>
    </div>
    <input type="text" class="form-control" name="vouchrno" id="voucher_no" placeholder="@lang('home.voucher') @lang('home.number')">
</div>
<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text">@lang("home.payment") @lang("home.type")</span>
    </div>
    <select name="paymenttype" id="paymenttype" class="form-control">
        <option value="1">Cash</option>
        <option value="2">Bank</option>
    </select>
</div>
<div class="row">
    <div class="col-sm-12">
        <div id="cashpanel">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('home.amount')</span>
                </div>
                <input type="number" class="form-control" id="amount" placeholder="@lang('home.amount')">
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
                <textarea name="" id="bankdescrp" cols="35" rows="2" class="form-control sumsection-input-text"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">@lang('home.remark')</span>
    </div>
    <textarea name="remark" class="form-control" id="remark" cols="5" rows="3" placeholder="@lang('home.remark')"></textarea>
</div>

<script>
    $(function() {
        var myDate = $("#dateinput").attr('data-date');
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var currentmonth = new Date(date.getFullYear(), date.getMonth());
        $('#dateinput').datepicker({
            dateFormat: 'yyyy/mm/dd',
            todayHighlight: true,
            startDate: today,
            endDate: end,
            autoclose: true
        });
        $('#dateinput').datepicker('setDate', myDate);
        $('#dateinput').datepicker('setDate', today);
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
</script>