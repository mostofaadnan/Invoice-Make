@extends('layouts.master')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header card-header-custom">
            <div class="pull-left">
                @lang('home.supplier') @lang('home.information')
            </div>
        </div>
        <div class="card-body">
            @include('partials.ErrorMessage')
            <form action="{{ route('supplier.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="supid" value="{{ $supplier->id }}">
                <div class="row">
                    <div class="col-sm-6 form-left-portion">


                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.id')</span>
                            </div>
                            <input type="text" class="form-control" id="exampleInputEmail2" placeholder="@lang('home.supplier') @lang('home.id')" disabled value="{{$supplier->id }}">

                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.name')</span>
                            </div>
                            <input type="text" name="sup_name" class="form-control" placeholder="@lang('home.name')" value="{{$supplier->name}}">

                        </div>


                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.country')</label>
                            </div>
                            <select class="custom-select form-control" name="country_id" id="country">
                                <option selected>Select</option>
                                @foreach($countrys as $country)
                                <option value="{{ $country->id }}" {{ $country->id==$supplier->country_id ? 'selected': '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.state')</label>
                            </div>

                            <select class="custom-select form-control" name="state_id" id="state">
                                <option value="{{$supplier->state_id}}">{{$supplier->StateName?$supplier->StateName->name:''}}</option>
                            </select>
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.city')</label>
                            </div>
                            <select class="custom-select form-control" name="city_id" id="city">
                                <option value="{{$supplier->city_id}}">{{$supplier->CityName? $supplier->CityName->name:''}}</option>
                            </select>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.address')</label>
                            </div>
                            <textarea name="address" class="form-control" id="" cols="30" rows="6">
                            {{$supplier->address}}
                            </textarea>
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.postal') @lang('home.code')</label>
                            </div>
                            <input type="text" name="postalcode" class="form-control" id="exampleInputPassword2" placeholder="@lang('home.postal') @lang('home.code')" value="{{$supplier->postalcode}}">
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.tin')</label>
                            </div>
                            <input type="text" name="TIN" class="form-control" id="exampleInputPassword2" placeholder="@lang('home.tin')" value="{{$supplier->TIN}}">
                        </div>


                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.status')</label>
                            </div>
                            <select name="status" class="form-control" id="">
                                <?php
                                if ($supplier->status == 1) { ?>
                                    <option value="1">Active</option>

                                <?php } else {  ?>
                                    <option value="0">inactive</option>

                                <?php } ?>
                            </select>
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.mobile') @lang('home.no')</label>
                            </div>
                            <input type="text" name="mobile_no" class="form-control" id="exampleInputPassword2" placeholder="@lang('home.mobile') @lang('home.no')" value="{{ $supplier->mobile_no}}">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.phone') @lang('home.no')</label>
                            </div>
                            <input type="text" name="tell_no" class="form-control" id="exampleInputPassword2" placeholder="@lang('home.phone') @lang('home.no')" value="{{ $supplier->tell_no}}">
                        </div>


                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.fax') @lang('home.no')</label>
                            </div>
                            <input type="text" name="fax_no" class="form-control" id="exampleInputPassword2" placeholder="@lang('home.fax') @lang('home.no')" value="{{ $supplier->fax_no}}">
                        </div>


                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.email')</label>
                            </div>
                            <input type="text" name="supemail" class="form-control" id="exampleInputPassword2" placeholder="@lang('home.email')" value="{{ $supplier->email }}">
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.website')</label>
                            </div>
                            <input type="website" name="website" class="form-control" id="exampleInputPassword2" placeholder="@lang('home.website')" value="{{ $supplier->website }}">
                        </div>


                    </div>
                    <div class="col-sm-6 form-right-portion">
                        <div class="form-group row">
                            @include('supplier.suppliereditprofile')
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">@lang('home.category') </span>
                            </div>
                            <select id="multi-select-category" class="multi-select" name="category[]" multiple="multiple">
                                @foreach($categoryis as $cat)
                                <option value="{{ $cat->id }}" @foreach($supplier->CategoryName as $sublist) {{$sublist->category_id == $cat->id ? 'selected': ''}} @endforeach>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $('#multi-select-category').multiselect();
                                });
                            </script>
                        </div>
                        <div class="input-group  mb-1">
                            <div class="input-group date" data-provide="datepicker" id="datetimepicker2">

                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">@lang('home.opening') @lang('home.date')</span>
                                </div>
                                <input type="text" name="openingdate" id="startDate" class="form-control" value="{{ $supplier->openingDate }}">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.opening') @lang('home.balance')</label>
                            </div>
                            <input id="ticketNum" type="number" class="form-control number-box" name="openingbalance" placeholder="@lang('home.opening') @lang('home.balance')" value="{{ $openingbalance }}">
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.total') @lang('home.consignment')</label>
                            </div>
                            <input type="number" class="form-control number-box" name="consignment" id="exampleInputPassword2" placeholder="@lang('home.total') @lang('home.consignment')" readonly value="{{ $consignment }}" readonly>
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.total') @lang('home.payment')</label>
                            </div>
                            <input type="number" class="form-control number-box" name="payment" id="exampleInputPassword2" placeholder="@lang('home.total') @lang('home.payment')" value="{{$payment }}" readonly>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.total') @lang('home.discount')</label>
                            </div>
                            <input type="number" class="form-control number-box" name="discount" id="exampleInputPassword2" placeholder="@lang('home.total') @lang('home.discount')" value="{{$discount }}" readonly>
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">@lang('home.balance') @lang('home.due')</label>
                            </div>
                            <input type="number" class="form-control number-box" name="balancedue" id="exampleInputPassword2" placeholder="@lang('home.balancedue')" value="{{$balancedue }}" readonly>
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

<script type="text/javascript">
    $('#country').change(function() {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('Supplier/get-state-list')}}?country_id=" + countryID,
                success: function(res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
            $("#city").empty();
        }
    });
    $('#state').on('change', function() {
        var stateID = $(this).val();
        if (stateID) {
            $.ajax({
                type: "GET",
                url: "{{url('Supplier/get-city-list')}}?state_id=" + stateID,
                success: function(res) {
                    if (res) {
                        $("#city").empty();
                        $.each(res, function(key, value) {
                            $("#city").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#city").empty();
                    }
                }
            });
        } else {
            $("#city").empty();
        }

    });
    $(function() {
        var myDate = $("#startDate").attr('data-date');
        var date = new Date();
        //  var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
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
        // $('#startDate').datepicker('setDate', today);
    });
    $("#datepicker").datepicker({
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months"
    });
</script>
@endsection