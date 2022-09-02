<div class="form-group">
    <label for="validationDefault01"> @lang('home.purchase')  @lang('home.number')</label>
    <input type="text" class="form-control" id="purchasecode" list="purchaseno" placeholder="@lang('home.purchase')  @lang('home.number')">
    <datalist id="purchaseno">
    </datalist>
</div>
<div class="form-group">
    <label for="validationDefault01"> @lang('home.grn')  @lang('home.number')</label>
    <input type="text" class="form-control" placeholder="@lang('home.recieved')  @lang('home.number')" id="revieno" readonly>
</div>
<div class="form-group">
    <label for="validationDefault02"> @lang('home.date')</label>
    @include('section.inputdatesection')
</div>
<div class="form-group">
    <label for="validationDefault02"> @lang('home.remark')</label>
    <textarea name="remark" id="remark" class="form-control" cols="30" rows="10" placeholder=" @lang('home.remark')"></textarea>
</div>