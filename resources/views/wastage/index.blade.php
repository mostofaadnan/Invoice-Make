@extends('layouts.master')
@section('content')

<div class="card">
    <style .input-group-text{width:auto;}></style>
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.wastage') @lang('home.management')
        </div>
        <div class="pull-right">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a type="button" class="btn btn-outline-danger" href="{{Route('wastage.create')}}">@lang('home.new') @lang('home.wastage')</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                @include('section.dateBetween')
            </div>
        </div>
        <div class="divider"></div>
        <table id="mytable" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.remark') </th>
                    <th>@lang('home.nettotal')</th>
                    <th> @lang('home.user')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.remark') </th>
                    <th>@lang('home.nettotal')</th>
                    <th> @lang('home.user')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </tfoot>
        </table>

    </div>


</div>

@include('wastage.partials.wastageindexscript')
@endsection