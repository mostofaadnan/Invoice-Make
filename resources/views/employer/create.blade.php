@extends('layouts.master')
@section('content')
<style>
    .multi-select {
        height: 56px !important;
    }
</style>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header card-header-section">
            <div class="row">
                <div class="col-sm-8">
                    @lang('home.new') @lang('home.employee')
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('partials.ErrorMessage')
            <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="response" name="response">
                <div class="row">
                    <div class="col-sm-6 form-left-portion">
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.employee') @lang('home.id')</span>
                            </div>
                            <input type="text" name="employer_id" id="employer_id" class="form-control" placeholder="@lang('home.employee') @lang('home.id')">
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.name')</span>
                            </div>
                            <input type="text" name="name" class="form-control" placeholder="@lang('home.name')">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.address')</label>
                            </div>
                            <textarea name="address" class="form-control" cols="30" rows="4" placeholder="@lang('home.address')"> </textarea>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.mobile')</label>
                            </div>
                            <input type="text" name="mobile_no" class="form-control" placeholder="@lang('home.mobile')">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.email')</label>
                            </div>
                            <input type="text" name="email" class="form-control" placeholder="@lang('home.email')">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.status')</label>
                            </div>
                            <select name="status" class="form-control" id="status">
                                <option value="1">Active</option>
                                <option value="0">inactive</option>
                            </select>
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group date" data-provide="datepicker" id="datetimepicker2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">@lang('home.joining') @lang('home.date')</span>
                                </div>
                                <input type="text" name="joining_date" id="startDate" class="form-control" data-date="">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.job') @lang('home.type')</span>
                            </div>
                            <select id="multicategory" class="form-control" name="job_type">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">part Time</option>
                            </select>
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.designation')</span>
                            </div>
                            <select id="multicategory" class="form-control" name="designation">
                                @foreach($designations as $designation)
                                <option value="{{ $designation->name  }}">{{ $designation->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.salary') @lang('home.basis')</span>
                            </div>
                            <select id="multicategory" class="form-control" name="salary_basis">
                                <option value="Full Time">Daily</option>
                                <option value="Full Time">Weekly</option>
                                <option value="Full Time">Monthly</option>
                            </select>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.starting') @lang('home.salary')</label>
                            </div>
                            <input type="text" name="salary" class="form-control" placeholder="@lang('home.salary')">
                        </div>
                    </div>
                    <div class="col-sm-6 form-right-portion">
                        <div class="form-group row">
                            @include('section.profileupload')
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.description') </label>
                            </div>
                            <textarea name="other_description" class="form-control" cols="30" rows="4" placeholder="@lang('home.description') "></textarea>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer card-footer-section">
            <div class="pull-right">
                <button type="submit" class="btn btn-lg btn-primary btn-block">@lang('home.submit')</button>
            </div>
            <div class="pull-right">
                <button class="btn btn-lg btn-secondary btn-block">@lang('home.reset')</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function EmployeeId() {
        $.ajax({
            type: 'get',
            url: "{{ route('employees.employeeid') }}",
            success: function(data) {
                $("#employer_id").val(data);
            }
        });

    }
    window.onload = EmployeeId();
    $(function() {
        var myDate = $("#startDate").attr('data-date');
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var currentmonth = new Date(date.getFullYear(), date.getMonth());
        $('#startDate').datepicker({
            dateFormat: 'yyyy/mm/dd',
            todayHighlight: true,
            startDate: today,
            endDate: end,
            autoclose: true
        });
        $('#startDate').datepicker('setDate', myDate);
        $('#startDate').datepicker('setDate', today);
    });
    $("#datepicker").datepicker({
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months"
    });
</script>
@endsection