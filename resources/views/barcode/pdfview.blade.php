<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode</title>
   
</head>

<body>
    <?php $row = 1;
    $numOfCols = 4 ?>
    <table align="center">
        <tr>
            @foreach($BarcodeDetails as $BarcodeDetail)
            <?php for ($i = 1; $i <= $BarcodeDetail->qty; $i++) { ?>
                <td>
                    <div class="barcode" style="text-align: center;border:1px #ccc solid;width:200px;padding:5px">
                        <?php if ($barcodeconfig->companyshow == 1) {
                            echo  '<label for="Companyname" id="barcodecompanyname">' . $BarcodeDetail->companyname . '</label><br>';
                        } ?>
                        <?php if ($barcodeconfig->itemnameshow == 1) {
                            echo '<label for="Companyname" id="barcodeitemname">' . $BarcodeDetail->itemname . '</label><br>';
                        } ?>
                        <img style="margin-left:5px;" src="data:image/png;base64,{{$BarcodeDetail->dimension::getBarcodePNG($BarcodeDetail->itemcode, $BarcodeDetail->type,1.50,50,array(0,0,0), true)}}" alt="barcode" /><br>
                        <?php if ($barcodeconfig->itempriceshow == 1) {
                            if ($BarcodeDetail->discount > 0) {
                                echo '<span align="center"><b class="mr-2">MRP:<del>' . $BarcodeDetail->mrp . '</del></b></span>';
                                echo '<span align="center"><b>' . $BarcodeDetail->discount . '<b></span>';
                            } else {
                                echo '<span align="center"><b class="mr-1">MRP:</b><label>' . $BarcodeDetail->mrp . '</label></span><br>';
                            }
                        } ?>
                    </div>
                </td>
            <?php
                // do we need a new row?
                if ($row % $numOfCols  === 0) {
                    echo "</tr><tr>";
                }

                // increase counter
                $row++;
            }
            ?>
            @endforeach
        </tr>
    </table>

</body>

</html>