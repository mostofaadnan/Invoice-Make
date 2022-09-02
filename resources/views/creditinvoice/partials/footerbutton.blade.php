<div class="form-row">
    <div class="col-md-12 col-xs-12 button-section">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" id="" data-toggle="modal" data-target="#modeldataview" class="btn btn-danger btn-lg" name="button">@lang('home.config')</button>
            <button type="button" id="vatshow" data-toggle="modal" data-target="#modeldataview" class="btn btn-success btn-lg" name="button">@lang('home.vatsetting')</button>
            <button type="button" id="customerinformation" onclick=CustomerClear() class="btn btn-info btn-lg" data-toggle="modal" data-target="#customerinfo" name="button">@lang('home.customer')</button>
            <button type="button" id="itemcheck" data-toggle="modal" data-target="#modelitemview" class="btn btn-warning btn-lg" name="button">@lang('home.item')</button>
            <button type="button" id="invoicecheck" data-toggle="modal" data-target="#invoiceprint" class="btn btn-success btn-lg" name="button">@lang('home.invoice') @lang('home.check')</button>
            <a type="button" class="btn btn-info btn-lg" name="button" href="{{ route('invoices') }}" target="_blank">@lang('home.sale') @lang('home.details')</a>
            <button type="button" id="" class="btn btn-light btn-lg" name="button">@lang('home.sale') @lang('home.return')</button>
            <a type="button" href="{{ route('invoice.create') }}" target="_blank" class="btn btn-warning btn-lg" name="button">@lang('home.new') @lang('home.window')(cntl+n)</a>
            <button type="button" id="resteBtn" class="btn btn-light btn-lg" name="button">@lang('home.reset')</button>
        </div>
    </div>
</div>