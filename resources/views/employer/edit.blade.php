@extends('layouts.master')
@section('content')



<style>
    .image-body {
        margin: auto;
    }

    .img-upload {
        margin: auto;
        align-items: center;
    }

    .card {
        margin: auto;
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
            <form action="{{ route('employees.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $Emplyer->id }}">
                <div class="row">
                    <div class="col-sm-6 form-left-portion">
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang("home.employee") @lang("home.id")</span>
                            </div>
                            <input type="text" name="employer_id" class="form-control" value="{{ $Emplyer->employer_id }}" placeholder="@lang('home.employee') @lang('home.id')">
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.name')</span>
                            </div>
                            <input type="text" name="name" class="form-control" value="{{ $Emplyer->name }}" placeholder="@lang('home.name')">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.address')</label>
                            </div>
                            <textarea name="address" class="form-control" cols="30" rows="4" placeholder="@lang('home.address')">{{$Emplyer->address }}</textarea>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.mobile')</label>
                            </div>
                            <input type="text" name="mobile_no" class="form-control" value="{{ $Emplyer->mobile_no }}" placeholder="@lang('home.mobile')">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.email')</label>
                            </div>
                            <input type="text" name="email" class="form-control" value="{{ $Emplyer->email }}" placeholder="@lang('home.email')">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.status')</label>
                            </div>
                            <select name="status" class="form-control" id="status">
                                <option value="1" {{ $Emplyer->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $Emplyer->status == 0 ? 'selected' : '' }}>inactive</option>
                            </select>
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group date" data-provide="datepicker" id="datetimepicker2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">@lang('home.joining') @lang('home.date')</span>
                                </div>
                                <input type="text" name="joining_date" id="startDate" value="{{ $Emplyer->joining_date }}" class="form-control" data-date="">
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
                                <option value="Full Time" {{ $Emplyer->job_type == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                <option value="Part Time" {{ $Emplyer->job_type == 'Part Time' ? 'selected' : '' }}>Part Time</option>
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
                                <option value="Daily" {{ $Emplyer->salary_basis == 'Daily' ? 'selected' : '' }}>Daily</option>
                                <option value="Weekly" {{ $Emplyer->salary_basis == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="Monthly" {{ $Emplyer->salary_basis == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                            </select>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.starting') @lang('home.salary')</label>
                            </div>
                            <input type="text" name="salary" class="form-control" value="{{  $Emplyer->salary }}" placeholder="@lang('home.starting') @lang('home.salary')">
                        </div>
                    </div>
                    <div class="col-sm-6 form-right-portion">
                        <div class="form-group row">
                            <div class="card col-sm-10">
                                <div class="card-header">
                                    @lang('home.profile')
                                </div>
                                <div class="card-body image-body">
                                    <div class="main-img-preview">
                                        <?php if ($Emplyer->image == NULL) {  ?>
                                            <img class="thumbnail img-preview" src="{{asset('assets/images/avater/avater.jpg')}}" style="width:200px; height: 200px" name="image" class="img-rounded " title="Preview Logo">
                                        <?php    } else { ?>
                                            <img class="thumbnail img-preview" src="{{asset('storage/app/public/Employee/'.$Emplyer->image)}}" style="width:200px; height: 200px" class="img-rounded" name="image" title="Preview Logo">
                                        <?php  }  ?>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class=" input-group">
                                        <input id="fakeUploadLogo" type="hidden" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                                        <div class="input-group-btn img-upload">
                                            <div class="fileUpload btn btn-danger ">
                                                <span><i class="glyphicon glyphicon-upload"></i> Upload</span>
                                                <input id="logo-id" name="supplier_image" type="file" class="attachment_upload">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.description') </label>
                            </div>
                            <textarea name="other_description" class="form-control" cols="30" rows="4" placeholder="@lang('home.description') ">{{ $Emplyer->other_description }}</textarea>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer">
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

    $(document).ready(function() {
        var brand = document.getElementById('logo-id');
        brand.className = 'attachment_upload';
        brand.onchange = function() {
            document.getElementById('fakeUploadLogo').value = this.value.substring(12);
        };

        // Source: http://stackoverflow.com/a/4459419/6396981
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#logo-id").change(function() {
            readURL(this);
        });
    });
</script>
@endsection