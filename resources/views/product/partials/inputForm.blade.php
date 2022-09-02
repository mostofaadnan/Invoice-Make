<div class="row">

<div class="input-group  col-sm-6 mb-1">
  <div class="input-group date" data-provide="datepicker" id="datetimepicker2">
    <div class="input-group-prepend">
      <span class="input-group-text" id="">@lang('home.opening') @lang('home.date')</span>
    </div>
    <input type="text" id="inputdate" class="form-control">
    <div class="input-group-addon">
      <span class="glyphicon glyphicon-th"></span>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="input-group  col-sm-6 mb-1">
    <div class="input-group-prepend">
      <span class="input-group-text">@lang('home.item') @lang('home.id')</span>
    </div>
    <input type="text" class="form-control" id="productid" placeholder="@lang('home.item') @lang('home.id')" readonly>
  </div>
  <div class="input-group col-sm-6 mb-1">
    <div class="input-group-prepend">
      <span class="input-group-text" id="">@lang('home.barcode')</span>
    </div>
    <input type="text" name="barcode" id="barcodes" class="form-control" placeholder="@lang('home.barcode')" readonly>
  </div>
</div>
<div class="input-group  mb-1">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">@lang('home.name')</span>
  </div>
  <input type="text" name="name" id="name" class="form-control" placeholder="@lang('home.name')">
</div>
<div class="row">
  <div class="input-group  mb-1 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.category')</label>
    </div>
    <select class="custom-select form-control" name="category" id="category">
      <option value="" selected>@lang('home.select')</option>
      @foreach($categories as $category)
      <option value="{{ $category->id }}">{{ $category->title }}</option>
      @endforeach
    </select>
  </div>
  <div class="input-group mb-1 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.subcategory')</label>
    </div>
    <select class="custom-select form-control" name="subcategory" id="subcategory">
    </select>
  </div>
</div>
<div class="row">
  <div class="input-group mb-1 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.brand')</label>
    </div>
    <select class="custom-select form-control" name="brand" id="brand">
    </select>
  </div>


  <div class="input-group  mb-1 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.unit')</label>
    </div>
    <select class="custom-select form-control" name="unit" id="unit">
      <option value="" selected>@lang('home.select')</option>
      @foreach($units as $unit)
      <option value="{{ $unit->id }}">{{ $unit->Shortcut }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="row">
  <div class="input-group mb-1 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.tp')(@lang('home.trade') @lang('home.price'))</label>
    </div>
    <input type="number" class="form-control" id="tp" name="tp" value="0" placeholder="@lang('home.tp')">
  </div>
  <div class="input-group mb-1 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.mrp')(@lang('home.market') @lang('home.price'))</label>
    </div>
    <input type="number" class="form-control" name="mrp" id="mrp" value="0" placeholder="@lang('home.mrp')">
  </div>
</div>
<div class="row">
  <div class="input-group mb-1 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.vat') @lang('home.type')</label>
    </div>
    <select id="vattype" class="form-control">
      <option value="">Select</option>
      @foreach($vats as $vat)
      <option value="{{ $vat->id }}">{{ $vat->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="input-group mb-1 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.vat') @lang('home.value')</label>
    </div>
    <input type="number" class="form-control" id="vatvalue" value="0" placeholder="@lang('home.vat') @lang('home.value')" readonly>
  </div>
</div>
<div class="input-group mb-1">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">@lang('home.remark')</label>
  </div>
  <textarea name="remark" class="form-control" id="remark" cols="30" rows="3" placeholder="@lang('home.remark')">
              </textarea>
</div>
<div class="row">
  <div class="input-group mb-2 col-sm-6">
    <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupSelect01">@lang('home.status')</label>
    </div>
    <select name="status" class="form-control" id="status">
      <option value="1">Active</option>
      <option value="0">inactive</option>

    </select>
  </div>
</div>
