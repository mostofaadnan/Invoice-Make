@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-6 form-single-input-section">
        <div class="card card-design">
            <div class="card-header card-header-section">
                <div class="row mb-3 mt-2">
                    <div class="col-sm-6">
                        @lang('home.database') @lang('home.restore')
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('partials.ErrorMessage')
                <form action="{{ route('database.backuprestore') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control" name="database_file">
            </div>

            <div class="card-footer  card-footer-section">
                <div class="pull-right"> <button type="submit" class="btn btn-primary">Backup</button></div>
                </form>
            </div>
        </div>

    </div>

</div>




@endsection