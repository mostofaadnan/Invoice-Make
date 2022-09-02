<style>
    .full-height {
  height: 100%;
}

    .footer {
        margin: auto;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #001f3f !important;
        color: white;
        /* text-align: center; */
        z-index: 9999;
    }

    .section-card-body {
        margin-top: 40px;
    }

    .sum-section {

        font-style: bold;
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
</style>
<div class="form-row mb-2 ">
    <div class="col-md-2 col-xl-2 col-xs-6">
        <label for="validationDefault01">@lang('home.amount')</label>
        <input type="text" class="form-control sum-section" id="amount" placeholder="Amount" value="0" readonly>
    </div>
    <div class="col-md-2 col-xl-2 col-xs-6">
        <label for="validationDefault01">@lang('home.discount')</label>
        <input type="text" class="form-control sum-section" id="totaldiscount" placeholder="discount" value="0" readonly>
    </div>
    <div class="col-md-2 col-xl-2 col-xs-6">
        <label for="validationDefault01">@lang('home.vat')</label>
        <input type="text" class="form-control sum-section" id="vat" placeholder="Vat" value="0" readonly>
    </div>
    <div class="col-md-2 col-xl-2 col-xs-6">
        <label for="validationDefault01">@lang('home.nettotal')</label>
        <input type="text" class="form-control sum-section" id="nettotal" placeholder="nettotal" value="0" readonly>
    </div>
    <div class="col-md-4 col-xs-6 mt-3 button-section">
        <button type="button" id="submittData" class="btn btn-lg btn-submit btn-rounded btn-danger" name="button">@lang('home.submit')</button>
        <button type="button" id="resteBtn" class="btn btn-lg btn-light btn-submit btn-rounded" name="button">@lang('home.reset')</button>
    </div>
</div>