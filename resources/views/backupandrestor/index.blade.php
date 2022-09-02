@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-6 form-single-input-section">
        <div class="card card-design">
            <div class="card-header card-header-section">
                <div class="row mb-3 mt-2">
                    <div class="col-sm-6">
                        @lang('home.database') @lang('home.backup')
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-sm-3">
                        <b> Hostnme:</b>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $mysqlHostName }}" >
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-3">
                        <b> Database:</b>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $DbName }}" >
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-3">
                        <b>User:</b>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $mysqlUserName }}" >
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-3">
                        <b> Password:</b>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" value="{{ $mysqlPassword }}">
                    </div>
                </div>
            </div>

            <div class="card-footer  card-footer-section">
                <div class="pull-right">
                    <form action="{{ route('database.backup') }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary">Backup</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>




@endsection