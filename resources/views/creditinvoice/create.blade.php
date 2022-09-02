@extends('layouts.master')
@section('content')
<div class="col-lg-12">
    <ul class="nav nav-tabs mb-2" id="myTabs" role="tablist">
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">@lang('home.purchase')</a>
        </li>
        <li class="nav-item waves-effect waves-light ">
            <a class="nav-link" id="card-tab" data-toggle="tab" href="#card" role="tab" aria-controls="card" aria-selected="false">@lang('home.item') @lang('home.search')</a>
        </li>
    </ul>
    <div class="tab-content" id="searchTabcontent">
        <div class="tab-pane fade active show" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            @include('creditinvoice.partials.invoicefield')
        </div>
        <div class="tab-pane fade" id="card" role="tabpanel" aria-labelledby="card-tab">
            @include('section.itemsearch')
        </div>
    </div>
</div>


@include('section.modelsection')
@include('creditinvoice.partials.invcreatescript')
@include('invoice.partials.modelpreviewscript')
@endsection