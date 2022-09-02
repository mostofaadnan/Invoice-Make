<style>
    #vat {
        color: #fff;

    }

    #totaldiscount {
        color: #fff;
    }
</style>
<div class="form-row">
    <div class="col-md-2 col-xl-2 col-xs-6">
        <label for="validationDefault01" style="color:#fff">@lang('home.amount')</label>
        <input type="text" class="form-control sum-section" id="amount" placeholder="Amount" value="0" readonly>
    </div>
    <div class="col-md-2 col-xl-2 col-xs-6" style="color:#fff">
        <label for="validationDefault01">@lang('home.discount')</label>
        <input type="text" class="form-control sum-section" id="totaldiscount" placeholder="discount" value="0">
    </div>
    <div class="col-md-2 col-xl-2 col-xs-6" style="color:#fff">
        <label for="validationDefault01">@lang('home.vat')</label>
        <input type="text" class="form-control sum-section" id="vat" placeholder="Vat" value="0">
    </div>
    <div class="col-md-2 col-xl-2 col-xs-6" style="color:#fff">
        <label for="validationDefault01">@lang('home.nettotal')</label>
        <input type="text" class="form-control sum-section" id="nettotal" placeholder="nettotal" value="0" readonly>
    </div>
    <div class="col-md-4 col-xs-6 mt-3 button-section">
        <button type="button" id="submittData" class="btn btn-lg btn-submit btn-rounded btn-danger" name="button">@lang('home.submit')</button>
        <button type="button" id="resteBtn" class="btn btn-lg btn-light btn-submit btn-rounded" name="button">@lang('home.reset')</button>
    </div>
   
</div>