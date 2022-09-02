<style>
    .opening {
        border: 1px #ccc solid;
    }
</style>
<div class="col-sm-6 form-single-input-section">
    <div class="card opening">
        <div class="card-header card-header-custom">
            @lang('home.supplier')  @lang('home.opening')  @lang('home.balance')
        </div>
        <div class="card-body">
            @include('partials.ErrorMessage')
            <form action="{{ route('supplier.storeopening') }}" method="post">
                @csrf
                <input type="hidden" name="supplier_id" id="supplier_id">
                <div class="input-group  mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">@lang('home.supplier')</span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Customer Name" value="{{ $supplier->name }}" readonly>
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">@lang('home.consignment')</label>
                    </div>
                    <input type="number" class="form-control" name="consignment" id="consignment" placeholder="Consignment">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"> @lang('home.discount')</label>
                    </div>
                    <input type="number" class="form-control" name="totaldiscount" id="totaldiscount" placeholder="Total Discount">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">@lang('home.payment')</label>
                    </div>
                    <input type="number" class="form-control" name="payment" id="payment" placeholder="Payment">
                </div>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Op.@lang('home.balance') @lang('home.due')</label>
                    </div>
                    <input type="number" class="form-control" name="balancedue" id="balancedue" placeholder="Balance Due" readonly>
                </div>
                <hr>
                <div class="pull-right">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">@lang('home.submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>