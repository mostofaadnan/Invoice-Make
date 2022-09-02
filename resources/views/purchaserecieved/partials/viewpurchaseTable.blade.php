<style>
    .my-custom-scrollbar{
        height:397px;
    }
</style>
<div class="my-custom-scrollbar my-custom-scrollbar-primary scrollbar-morpheus-den">
    <table class="data-table table table-striped table-bordered table-sm" cellspacing="0" id="purchasetable">
        <thead>
            <tr>
                <th> #@lang('home.sl') </th>
                <th> @lang('home.item') @lang('home.code') </th>
                <th> @lang('home.name')</th>
                <th> @lang('home.quantity') </th>
                <th> @lang('home.unit')  @lang('home.price')</th>
                <th> @lang('home.amount') </th>
                <th> @lang('home.discount') </th>
                <th> @lang('home.vat') </th>
                <th> @lang('home.nettotal') </th>

            </tr>
        </thead>
        <tbody id="datatablebody">

        </tbody>
    </table>
</div>