<div class="card card-design ">
    <div class="card-header card-header-section">
        @include('section.invoicesection')
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                @include('section.itemsection')
            </div>
            <div class="card-body">
                <div class="card" style="background-color: #001f3f;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="my-custom-scrollbar my-custom-scrollbar-primary scrollbar-morpheus-den table-section" style="height:380px;background-color:#fff;">
                                    @include('invoice.partials.invoiceTable')
                                </div>
                            </div>
                            <div class="col-sm-2">
                                @include('creditinvoice.partials.customersection')
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: #001f3f;">
                        @include('creditinvoice.partials.sumsidebarsection')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        @include('invoice.partials.footerbutton')
    </div>
</div>