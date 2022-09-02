@extends('layouts.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <div class="pull-left">
                <h4>@lang('home.label') @lang('home.view')</h4>
            </div>
            <div class="pull-right">
                <button class="btn btn-info btn-print" onclick='printData();'>@lang('home.print')</button>
                <a href="{{ route('barcode.pdfview') }}" class="btn btn-danger">Export Pdf</a>
            </div>
        </div>
        <div class="card-body container" id="printTable" align="center">
            <?php
            //Columns must be a factor of 12 (1,2,3,4,6,12)
            $numOfCols = 6;
            $rowCount = 0;
            $bootstrapColWidth = 12 / $numOfCols;

            ?>

            <div class="row">
                @foreach($BarcodeDetails as $BarcodeDetail)
                <?php for ($i = 1; $i <= $BarcodeDetail->qty; $i++) { ?>
                    <div class=" mb-1 mr-2 col-sm-<?php echo $bootstrapColWidth; ?>" style="text-align: center;border:1px #ccc solid;width:<?php echo $barcodeconfig->width ?>;height:<?php echo $barcodeconfig->height ?>; padding:5px">
                        <?php if ($barcodeconfig->companyshow == 1) {
                            echo  '<label for="Companyname" id="barcodecompanyname">' . $BarcodeDetail->companyname . '</label><br>';
                        } ?>
                        <?php if ($barcodeconfig->itemnameshow == 1) {
                            echo '<label for="Companyname" id="barcodeitemname">' . $BarcodeDetail->itemname . '</label><br>';
                        } ?>
                        <img style="margin-left:5px;" src="data:image/png;base64,{{$BarcodeDetail->dimension::getBarcodePNG($BarcodeDetail->itemcode, $BarcodeDetail->type,1.50,50,array(0,0,0), true)}}" alt="barcode" /><br>
                        <?php if ($barcodeconfig->itempriceshow == 1) {

                            if ($BarcodeDetail->discount > 0) {
                                echo '<span align="center"><b class="mr-1">MRP:<del>' . $BarcodeDetail->mrp . '</del></b></span>';
                                echo '<span align="center"><b>' . $BarcodeDetail->discount . '<b></span>';
                            } else {
                                echo '<span align="center"><b class="mr-1">MRP:<label>' . $BarcodeDetail->mrp . '</label></b></span><br>';
                            }
                        } ?>

                    </div>
                <?php
                }
                $rowCount++;
                if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';

                ?>
                @endforeach
            </div>
            {{ $BarcodeDetails->links() }}
        </div>
    </div>
</div>
<script>
    function printData() {
        var divToPrint = document.getElementById("printTable");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    $('button').on('click', function() {
        printData();
    })
</script>

<!-- <script type="text/javascript">
$(function () {
    $("#btnPrint").click(function () {
        var contents = $("#printTable").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.{{asset('assets/css/custom/custom.css')}}
        frameDoc.document.write('<link href="{{asset("assets/css/custom/custom.css")}}" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
</script> -->
@endsection