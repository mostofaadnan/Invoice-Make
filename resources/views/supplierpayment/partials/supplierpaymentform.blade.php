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
    <div class="input-group  col-sm-6 mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text">@lang('home.payment') @lang('home.number')</span>
        </div>
        <input type="text" class="form-control" id="paymentno" placeholder="@lang('home.payment') @lang('home.number')" readonly>
    </div>

    <div class="input-group  col-sm-6 mb-1">
        <div class="input-group date" data-provide="datepicker" id="datetimepicker2">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">@lang('home.date')</span>
            </div>
            <input type="text" name="openingdate" id="inputdate" class="form-control" data-date="">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
</div>
<div class="input-group  mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">@lang('home.supplier')</span>
    </div>
    <input type="text" class="form-control" id="suppliersearch" placeholder="@lang('home.supplier')" list="supplier" autocomplete="off">
    <datalist id="supplier">
    </datalist>
</div>
<div class="row">
    <div class="input-group col-sm-6 mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">@lang('home.consignment')</span>
        </div>
        <input type="text" id="consignment" class="form-control" placeholder="@lang('home.consignment')" readonly>
    </div>
    <div class="input-group  col-sm-6 mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text">@lang('home.discount')</span>
        </div>
        <input type="text" class="form-control" id="totaldiscount" placeholder="@lang('home.discount')" readonly>
    </div>
</div>
<div class="row">
    <div class="input-group  col-sm-6 mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text">@lang('home.paid') @lang('home.amount')</span>
        </div>
        <input type="text" class="form-control" id="paidamount" placeholder="@lang('home.paid') @lang('home.amount')" readonly>
    </div>
    <div class="input-group col-sm-6 mb-1">
        <div class="input-group-prepend">
            <span class="input-group-text" id="">@lang('home.balancedue')</span>
        </div>
        <input type="text" id="balancedue" class="form-control" placeholder="@lang('home.balancedue')" readonly>
    </div>
</div>
<hr>
<div class="row">
    <div class="input-group mb-1 col-sm-6">
        <div class="input-group-prepend">
            <span class="input-group-text"> @lang('home.payment') @lang('home.type')</span>
        </div>
        <select id="paymenttype" class="form-control">
            <option value="1">Cash</option>
            <option value="2">Bank</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div id="cashpanel">
            <div class="row">
                <div class="input-group  col-sm-6 mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@lang('home.payment')</span>
                    </div>
                    <input type="number" class="form-control" id="payment" placeholder="@lang('home.payment')">
                </div>
                <div class="input-group col-sm-6 mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id=""> @lang('home.new') @lang('home.balancedue')</span>
                    </div>
                    <input type="text" name="barcode" id="newbalancedue" class="form-control" placeholder=" @lang('home.new') @lang('home.balancedue')" readonly>
                </div>
            </div>
        </div>
        <div class="paymentbox" id="bankpanel">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('home.bank')</span>
                </div>
                <input type="text" class="form-control" id="banknamesearch" placeholder="bank" list="banknames" required>
                <datalist id="banknames">
                </datalist>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('home.acc') @lang('home.number')</span>
                </div>
                <input type="text" class="form-control sumsection-input-text" id="accno" placeholder="Account No">
            </div>
            <div class="input-group">
                <textarea name="" id="bankdescrp" cols="35" rows="2" class="form-control sumsection-input-text" placeholder="@lang('home.bank') @lang('home.description')"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="input-group mb-1">
    <div class="input-group-prepend">
        <span class="input-group-text" id="">@lang('home.remark')</span>
    </div>
    <textarea name="" class="form-control" id="remark" cols="5" rows="5" placeholder="@lang('home.remark')"></textarea>
</div>

<script>
    $(function() {
        var myDate = $("#inputdate").attr('data-date');
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var currentmonth = new Date(date.getFullYear(), date.getMonth());
        $('#inputdate').datepicker({
            dateFormat: 'yyyy/mm/dd',
            todayHighlight: true,
            startDate: today,
            endDate: end,
            autoclose: true
        });
        $('#inputdate').datepicker('setDate', myDate);
        $('#inputdate').datepicker('setDate', today);
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