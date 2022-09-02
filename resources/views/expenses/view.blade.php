@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header card-header-section">
        <div class="row">
            <div class="col-8 col-sm-4 col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">@lang('home.expenses') @lang('home.no')</label>
                    </div>
                    <input type="text" class="form-control" id="expensescode" list="expensesno" placeholder="@lang('home.search')">
                    <datalist id="expensesno">
                    </datalist>
                </div>
            </div>
            <div class="col-4 col-sm-8">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang("home.action")
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('exepensess') }}" class="nav-link">@lang('home.expenses') @lang('home.list')</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('expenses.create') }}" class="nav-link">@lang("home.new")</a>
                        <div class="dropdown-divider"></div>
                        <a id="datadelete" class="nav-link">@lang('home.delete')</a>
                        <div class="dropdown-divider"></div>
                        <a id="print" class="nav-link">@lang('home.print')</a>
                        <div class="dropdown-divider"></div>
                        <a id="pdf" class="nav-link">@lang('home.pdf')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="inv-title">
            <h4 class="no-margin">@lang('home.expenses')</h4>
        </div>
        <div class="row">
            <div class="col-sm-8">
            </div>
            <div class="col-12 col-sm-4">
                <table class="table table-bordered table-striped">

                    <tr>
                        <th>@lang('home.expenses') @lang('home.number')</th>
                        <td id="expeenses_no"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.date')</th>
                        <td id="expensesdate"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.reference')/@lang('home.voucher') @lang('home.number')</th>
                        <td id="refno"></td>
                    </tr>
                    <tr>
                        <th>@lang('home.payment') @lang('home.type')</th>
                        <td id="paymenttype"></td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped table-responsive-sm table-sm  data-table mt-2" width="100%">
                    <thead>
                        <th width='5%'>#@lang('home.sl')</th>
                        <th>@lang('home.description')</th>
                        <th>@lang('home.expenses') @lang('home.type')</th>
                        <th>@lang('home.remark')</th>
                        <th>@lang('home.amount')</th>
                    </thead>
                    <tbody id="tablebody">
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>
@include('expenses.partials.expensesviewscript')
@endsection