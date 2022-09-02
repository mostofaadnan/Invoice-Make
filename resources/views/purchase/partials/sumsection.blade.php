<div class="card">
    <div class="card-body">
        <form class="forms-sample">
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('home.amount')</span>
                </div>
                <input type="number" class="form-control" placeholder="0" id="amount" readonly>
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('home.discount')</span>
                </div>
                <input type="number" class="form-control" placeholder="0" id="discount" readonly>
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('home.vat')</span>
                </div>
                <input type="number" class="form-control" placeholder="0" id="vat" readonly>
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">@lang('home.nettotal')</span>
                </div>
                <input type="number" class="form-control" placeholder="0" id="nettotal" readonly>

            </div>

            <hr>

            <div class="pull-right">
                <button type="submit" class="btn btn-success mr-2">@lang('home.submit')</button>
                <button class="btn btn-light">@lang('home.reset')</button>
            </div>
        </form>
    </div>
</div>