@extends('layouts.master')
@section('content')

<div class="card">

    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.Expenses') @lang('home.chart')
        </div>
        <div class="pull-right">
            <div class="form-row">
            <div class="form-group col-md-3">
                    <select class="form-control" id="viewchart">
                        <option value="1">Monthly</option>
                        <option value="2">Yearly</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control charttype">
                        <option value="1">Bar</option>
                        <option value="2">Line</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                <?php
                $month = strtotime(date('Y') . '-' . date('m') . '-' . date('j') . ' - 12 months');
                $end = strtotime(date('Y') . '-' . date('m') . '-' . date('j') . ' + 0 months');
                echo '<select class="form-control monthchart">';
                while ($month < $end) {
                    $selected = (date('F', $month) == date('F')) ? ' selected' : '';
                    echo '<option' . $selected . ' value="' . date('n', $month) . '">' . date('F', $month) . '</option>' . "\n";
                    $month = strtotime("+1 month", $month);
                }
                echo '</select>';
                ?>
                </div>
                <div class="form-group col-md-3">
                <select class="form-control invoiceyear">
                    <?php
                    $currently_selected = date('Y');
                    for ($i = 2020; $i <= 2050; $i++) {
                        echo '<option value=' . $i . ' ' . ($i === $currently_selected ? ' selected="selected"' : '') . '>' . $i . '</option>';
                    }
                    ?>
                </select>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="col-sm-12 col-md-12">
            {!! $ExpensesMonthlyChart->container() !!}
        </div>
    </div>


</div>
{!! $ExpensesMonthlyChart->script() !!}
<script>
    $("#viewchart").change(function(){
var type=$(this).val();
if(type==2){
    url = "{{ route('chart.ExpensesYearlyChartView')}}",
      window.location = url;
}
    });
    var expenses_api_url = {{$ExpensesMonthlyChart->id}}_api_url;
    $(".invoiceyear").change(function() {
        ChartFileter();
    });
    $(".charttype").change(function() {
        ChartFileter();
    });
    $(".monthchart").change(function() {
        ChartFileter();
    });

    function ChartFileter() {
        var year = $(".invoiceyear").val();
        var type = $(".charttype").val();
        var month = $(".monthchart").val(); 
         {{$ExpensesMonthlyChart->id}}_refresh(expenses_api_url + "?year=" + year + "&type=" + type+"&month="+month);
    }
</script>
@endsection