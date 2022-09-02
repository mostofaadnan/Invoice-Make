@extends('layouts.master')
@section('content')
<style>
  .inside-card {
    box-shadow: none;
  }

  .label-chart {
    border: 1px #ccc solid;
  }
</style>
<div class="card">
  <div class="card-header">
    <div class="pull-right">
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" id="today" class="btn btn-dark active">@lang('home.today')</button>
        <button type="button" id="sevenday" class="btn btn-dark">@lang('home.last') @lang('home.7') @lang('home.days')</button>
        <button type="button" id="thismonth" class="btn btn-dark">@lang('home.this') @lang('home.month')</button>
        <button type="button" id="thisyear" class="btn btn-dark">@lang('home.this') @lang('home.year')</button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">

      <div class="col-sm-2  tile_stats_count">
        <div class="card">
          <div class="card-header card-header-section">
            <span class="count_top"> @lang('home.cash') @lang('home.invoice')</span>
          </div>
          <div class="card-body count-box">
            <div class="count red" id="invoice"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-2 tile_stats_count">
        <div class="card">
          <div class="card-header card-header-section">
            <span class="count_top">@lang('home.purchase')</span>
          </div>
          <div class="card-body count-box">
            <div class="count green" id="purchase"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-2  tile_stats_count">
        <div class="card">
          <div class="card-header card-header-section">
            <span class="count_top"> @lang('home.payment')</span>
          </div>
          <div class="card-body count-box">
            <div class="count green" id="ppayment"></div>
          </div>
        </div>
      </div>

      <div class=" col-sm-2  tile_stats_count">
        <div class="card">
          <div class="card-header card-header-section">
            <span class="count_top"> @lang('home.credit') @lang('home.payment')</span>
          </div>
          <div class="card-body count-box">
            <div class="count red" id="cpayment"></div>
          </div>
        </div>
      </div>

      <div class=" col-sm-2  tile_stats_count">
        <div class="card">
          <div class="card-header card-header-section">
            <span class="count_top"> @lang('home.cash') @lang('home.drawer')</span>
          </div>
          <div class="card-body count-box">
            <div class="count green" id="cdrawer"></div>
          </div>
        </div>
      </div>

      <div class=" col-sm-2  tile_stats_count">
        <div class="card">
          <div class="card-header card-header-section">
            <span class="count_top"> @lang('home.expenses')</span>
          </div>
          <div class="card-body count-box">
            <div class="count red" id="expencess"></div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-6 col-md-6">
        <div class="card label-chart">
          <div class="card-header">
            <div class="pull-left">
              @lang('home.invoice')
            </div>
            <div class="pull-right">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <select class="form-control charttype">
                    <option value="1">Bar</option>
                    <option value="2">Line</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <select class="form-control invoiceyear">
                    <?php
                    $currently_selected = date('Y');
                    for ($i = 2020; $i <= 2050; $i++) {
                      echo '<option value=' . $i . ' ' . ($i === $currently_selected ? ' selected="selected"' : '') . '>' . $i . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            {!! $invoicechart->container() !!}
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6">
        <div class="card label-chart">
          <div class="card-header">
            <div class="pull-left">
              @lang('home.purchase')
            </div>
            <div class="pull-right">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <select class="form-control charttype1">
                    <option value="1">Bar</option>
                    <option value="2">Line</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <select class="form-control purchaseyear">
                    <?php
                    $currently_selected = date('Y');
                    for ($i = 2020; $i <= 2050; $i++) {
                      echo '<option value=' . $i . ' ' . ($i === $currently_selected ? ' selected="selected"' : '') . '>' . $i . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            {!! $purchasechart->container() !!}
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 mt-1">
        <div class="card label-chart">
          <div class="card-header">
            <div class="pull-left">
              @lang('home.supplier') @lang('home.payment')
            </div>
            <div class="pull-right">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <select class="form-control charttype2">
                    <option value="1">Bar</option>
                    <option value="2">Line</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <select class="form-control suppyear">
                    <?php
                    $currently_selected = date('Y');
                    for ($i = 2020; $i <= 2050; $i++) {
                      echo '<option value=' . $i . ' ' . ($i === $currently_selected ? ' selected="selected"' : '') . '>' . $i . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">

            {!! $SupplierPaymentChart->container() !!}

          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 mt-1">
        <div class="card label-chart">
          <div class="card-header">
            <div class="pull-left">
              @lang('home.credit') @lang('home.payment')
            </div>
            <div class="pull-right">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <select class="form-control charttype3">
                    <option value="1">Bar</option>
                    <option value="2">Line</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <select class="form-control cuspyear">
                    <?php
                    $currently_selected = date('Y');
                    for ($i = 2020; $i <= 2050; $i++) {
                      echo '<option value=' . $i . ' ' . ($i === $currently_selected ? ' selected="selected"' : '') . '>' . $i . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">

            {!! $CustomerPaymentChart->container() !!}

          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 mt-1">
        <div class="card label-chart">
          <div class="card-header">
            <div class="pull-left">
              @lang('home.expenses')
            </div>
            <div class="pull-right">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <select class="form-control charttype4">
                    <option value="1">Bar</option>
                    <option value="2">Line</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <select class="form-control expyear">
                    <?php
                    $currently_selected = date('Y');
                    for ($i = 2020; $i <= 2050; $i++) {
                      echo '<option value=' . $i . ' ' . ($i === $currently_selected ? ' selected="selected"' : '') . '>' . $i . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">

            {!! $ExpensesChart->container() !!}

          </div>
        </div>
      </div>

    </div>

  </div>
</div>

{!! $invoicechart->script() !!}
{!! $purchasechart->script() !!}
{!! $SupplierPaymentChart->script() !!}
{!! $CustomerPaymentChart->script() !!}
{!! $ExpensesChart->script() !!}
@include('pages.partials.homescript')
@include('pages.partials.chartscript')
@endsection