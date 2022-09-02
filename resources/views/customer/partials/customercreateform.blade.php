@include('partials.ErrorMessage')
<form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-6 form-left-portion">
            <div class="input-group  mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">@lang('home.customer') @lang('home.code')</span>
                </div>
                <input type="text" class="form-control" name="customerid" id="customerid" placeholder="@lang('home.customer') @lang('home.id')" readonly>
            </div>
            <div class="input-group  mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">@lang('home.name')</span>
                </div>
                <input type="text" name="customername" id="customername" class="form-control" placeholder="@lang('home.customer') @lang('home.name')">
            </div>
            <div class="input-group  mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.country')</label>
                </div>
                <select class="custom-select form-control" name="country_id" id="country">
                    <option selected>@lang('home.select')</option>
                    @foreach($countrys as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.state')</label>
                </div>
                <select class="custom-select form-control" name="state_id" id="state">
                </select>
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.city')</label>
                </div>
                <select class="custom-select form-control" name="city_id" id="city">

                </select>
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.address')</label>
                </div>
                <textarea name="address" id="addresstext" class="form-control" cols="30" rows="3" placeholder="@lang('home.address')">
              </textarea>
            </div>

            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.postal') @lang('home.code')</label>
                </div>
                <input type="text" name="postalcode" class="form-control" id="postalcode" placeholder="@lang('home.postal') @lang('home.code')">
            </div>

            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.tin')</label>
                </div>
                <input type="text" name="TIN" class="form-control" id="TIN" placeholder="@lang('home.tin')">
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
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.mobile') @lang('home.no')</label>
                </div>
                <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="@lang('home.mobile') @lang('home.no')">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.phone') @lang('home.no')</label>
                </div>
                <input type="text" name="tell_no" class="form-control" id="tell_no" placeholder="@lang('home.phone') @lang('home.no')">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.fax') @lang('home.no')</label>
                </div>
                <input type="text" name="fax_no" class="form-control" id="fax_no" placeholder="@lang('home.fax') @lang('home.no')">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.email') </label>
                </div>
                <input type="text" name="email" class="form-control" id="email" placeholder="@lang('home.email') ">
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.website') </label>
                </div>
                <input type="website" name="website" class="form-control" id="website" placeholder="@lang('home.website') ">
            </div>

        </div>

        <div class="col-sm-6 form-right-portion">
            <div class="form-group row">
                @include('section.profileupload')
            </div>
            <div class="input-group  mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">@lang('home.category') </span>
                </div>
                <select id="multi-select-category" class="multi-select" name="category[]" multiple="multiple">
                    @foreach($categoryis as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
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
                        <span class="input-group-text" id="">@lang('home.opening')  @lang('home.date') </span>
                    </div>
                    <input type="text" name="openingdate" id="dateinput" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">@lang('home.description') </label>
                </div>
                <textarea name="description" class="form-control" cols="30" rows="5" placeholder="@lang('home.description') ">
              </textarea>
            </div>

        </div>
    </div>

    <script>
    $(function() {
        var myDate = $("#dateinput").attr('data-date');
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var currentmonth = new Date(date.getFullYear(), date.getMonth());
        $('#dateinput').datepicker({
            dateFormat: 'yyyy/mm/dd',
            todayHighlight: true,
            startDate: today,
            endDate: end,
            autoclose: true
        });
        $('#dateinput').datepicker('setDate', myDate);
        $('#dateinput').datepicker('setDate', today);
    });
</script>