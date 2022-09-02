<style>
    .footer {
        margin: auto;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #001f3f !important;
        color: white;
        /*  z-index: 9999; */
        height: 400px;
        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    .section-card-body {
        margin-top: 40px;
    }

    .cus-section {
        text-align: right;
        font-style: bold;
        
       

    }

    .payment-type {
        background-color: #001f3f !important;
        color: white;
    }

    #payment-option {
        color: #fff;
    }

    .btn-rounded {
        border-radius: 10em;
    }

    .btn-danger {
        background-color: #ff3547;
        color: #fff;
    }

    .btn-light {
        color: #000 !important;

    }

    .btn-submit {

        margin: .375rem;
        color: inherit;
        text-transform: uppercase;
        word-wrap: break-word;
        white-space: normal;
        cursor: pointer;
        border: 0;
        border-radius: .125rem;
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        -webkit-transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        padding: .84rem 2.14rem;
        font-size: .81rem;
    }

  

    .sumsection-input {
        background-color: #001f3f !important;
        font-size: 20px;
        width: 60px;

    }

    .sumsection-input-text {
        background-color: #001f3f !important;
        color: #fff !important;
        font-style: bold;
    }
    .cuspanel{
        margin-top:0px !important;
        margin-bottom:0px !important;
    }
</style>

<h6 style="color:#fff" align="center">@lang('home.customer') @lang('home.panel')</h6>
<hr style="background-color:#fff">
<div class="form-group cuspanel">
    <div class="input-group-prepend sumsection-input ">
        <label class="input-group-text sumsection-input-text" for="inputGroupSelect01">@lang('home.previous') @lang('home.invoice')</label>
    </div>
    <input type="text" class="form-control cus-section" id="creditinv" placeholder="@lang('home.credit') @lang('home.invoice')" value="0" readonly>
</div>
<div class="form-group cuspanel">
    <div class="input-group-prepend sumsection-input ">
        <label class="input-group-text sumsection-input-text" for="inputGroupSelect01">@lang('home.today') @lang('home.sale')</label>
    </div>
    <input type="text" class="form-control cus-section" id="currentsale" placeholder="Vat" value="0" readonly>
</div>
<div class="form-group cuspanel">
    <div class="input-group-prepend sumsection-input ">
        <label class="input-group-text sumsection-input-text" for="inputGroupSelect01">@lang('home.nettotal')</label>
    </div>
    <input type="text" class="form-control cus-section" id="cusnettoal" placeholder="Vat" value="0" readonly>
</div>

<div class="form-group cuspanel">
    <div class="input-group-prepend sumsection-input ">
        <label class="input-group-text sumsection-input-text" for="inputGroupSelect01">@lang('home.payment')</label>
    </div>
    <input type="text" class="form-control cus-section" id="cuspayment" placeholder="Vat" value="0" readonly>
</div>
<div class="form-group cuspanel">
    <div class="input-group-prepend sumsection-input ">
        <label class="input-group-text sumsection-input-text" for="inputGroupSelect01">@lang('home.balancedue')</label>
    </div>
    <input type="text" class="form-control cus-section" id="balancedue" placeholder="nettotal" value="0" readonly>
</div>

