@extends('layouts.master')
@section('content')
<style>
    .custom {
        background-color: #12425a !important;
        color: #fff !important;
    }
</style>
<div class="row">
    <div class="col-sm-6 form-single-input-section ">
        <div class="card card-design box-shadow">
            <div class="card-header card-header-section">
                <div class="pull-left">@lang('home.expenses')</div>

            </div>
            <div class="card-body form-div">
                <div class="mb-2"></div>
                <div class="container">
                    @include('partials.ErrorMessage')

                    @include('expenses.partials.expensesform')
                </div>
            </div>
            <div class="card-footer  card-footer-section">

                <div class="pull-right">
                    <div class="btn-group button-grp" role="group" aria-label="Basic example">
                        <button type="submit" id="datasubmit" class="btn btn-success btn-lg">@lang('home.submit')</button>
                        <button id="reset" class="btn btn-light clear_field btn-lg">@lang('home.reset')</button>
                        <button id="deletedata" class="btn btn-danger btn-lg">@lang('home.delete')</button>
                    </div>
                   
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('expenses.partials.expcreatescript');
@endsection