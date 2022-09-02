<table  class="table table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>@lang('home.from')</th>
            <th>@lang('home.to')</th>
            <th>@lang('home.action')</th>
        </tr>
    <tbody>
        <td>
            <div class="input-group date" data-provide="datepicker" id="datepicker">
                <input type="text" name="min" id="min" class="form-control min">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </td>
        <td>
            <div class="input-group date" data-provide="datepicker" id="datepicker">
                
                <input type="text" name="max" id="max" class="form-control max">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>

        </td>
        <td>
        <button type="button" class="btn btn-info" id="submitdate" name="button" style="width:100%;height:100%;">@lang('home.submit')</button>
        </td>
    </tbody>
    </thead>
</table>


<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>