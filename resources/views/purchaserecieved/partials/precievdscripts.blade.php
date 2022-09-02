<script>
    var supplier_id = 0;
    var purchaseNo = 0;
    var recieveNo = 0;
    var nettotal = 0;
    var totaldiscount = 0;

    function getUrl() {
        var url = $(location).attr('href')
        var segment = url.split("/").length - 1 - (url.indexOf("http://") == -1 ? 0 : 2);
        if (segment == 3) {
            purchaseInformation();
        }
        purchaseNo = url.substring(url.lastIndexOf('/') + 1);


    }

    window.onload = getUrl();

    function purchaseCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('precieve.recieveno') }}",
            datatype: 'JSON',
            success: function(data) {
                recieveNo = data;
                $("#revieno").val(recieveNo);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function ViewPurchaseCode() {
        $.ajax({
            type: 'get',
            url: "{{ route('precieve.purchasecodedatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#purchaseno').html(data);
            },
            error: function(data) {}
        });
    }
    window.onload = ViewPurchaseCode();
    window.onload = purchaseCode();

    function clear() {
        $("#purchasecode").val("");
        $("#refno").val("")
        supplier_id = 0;
        $("#amount").val("");
        $("#totaldiscount").val("");
        $("#vat").val("");
        $("#nettotal").val("");
        $("#datatablebody").empty();
        purchaseCode();
        ViewPurchaseCode();

    }

    $("#purchasecode").on('input', function() {
        var val = this.value;
        if ($('#purchaseno option').filter(function() {
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            purchaseNo = $('#purchaseno').find('option[value="' + val + '"]').attr('id');
            $.ajax({
                type: 'post',
                url: "{{ url('Session-Id/purchaseId')}}" + '/' + purchaseNo,
                success: function() {
                    purchaseInformation();
                }
            });
        }
    });

    function purchaseInformation() {
        $.ajax({
            type: "get",
            url: "{{ url('Purchase/getView')}}",
            datatype: ("json"),
            success: function(data) {

                lodData(data);
                loadTableDetails(data.p_details);
            },
            error: function(data) {
                console.log(data)
            }
        });
    }

    function lodData(data) {

        $("#purchasecode").val(data.purchasecode);
        $("#refno").val(data.ref_no)
        $("#purchasedate").val(data.inputdate);
        supplier_id = data.supplier_id;
        $("#suppliersearch").val(data.supplier_name['name']);
        $("#amount").val(data.amount);
        $("#totaldiscount").val(data.discount);
        totaldiscount = data.discount;
        $("#vat").val(data.vat);
        $("#shipment").val(data.shipment);
        $("#nettotal").val(data.nettotal);
        nettotal = data.nettotal;
    }

    function loadTableDetails(data) {
        var sl = 1;
        $(".data-table tbody").empty();
        data.forEach(function(value) {
            $(".data-table tbody").append("<tr id=" + sl + " data-discount='" + value.discount + "' data-mrp='" + value.mrp + "' data-unitid='" + value.unit_id + "'>" +
                "<td>" + sl + "</td>" +
                "<td id='itemcode'>" + value.itemcode + "</td>" +
                "<td>" + value.product_name['name'] + "</td>" +
                "<td class='qty' align='right'>" + value.qty + "</td>" +
                "<td align='right'>" + value.tp + "</td>" +
                "<td class='amount' align='right'>" + value.amount + "</td>" +
                "<td class='totaldiscount' align='right'>" + value.discount + "</td>" +
                "<td class='vat'align='right'>" + value.vat + "</td>" +
                "<td class='nettotal' align='right'>" + value.nettotal + "</td>" +
                "</tr>");

            sl++;
        })

    }
    $("#recieved").on('click', function() {
        if (recieveNo == 0 || purchaseNo == 0) {
            swal("Please Select Purchase No", "Submit Requirement", "error");

        } else {
            DataInsert();
        }


    });

    function DataInsert() {
        $("#overlay").fadeIn();
        var inputdate = $("#dateinput").val();
        var remark = $("#remark").val();
        var itemtables = new Array();
        $("#purchasetable TBODY TR").each(function() {
            var row = $(this);
            var item = {};
            item.code = row.find("TD").eq(1).html();
            item.qtys = row.find("TD").eq(3).html();
            itemtables.push(item);
        });

        $.ajax({
            type: "POST",
            url: "{{ route('precieve.store') }}",
            //data: JSON.stringify(itemtables),
            data: {
                itemtables: itemtables,
                recieveno: recieveNo,
                parchasecode: purchaseNo,
                inputdate: inputdate,
                remark: remark,
                supplier_id: supplier_id,
                totaldiscount: totaldiscount,
                netotal: nettotal
            },
            datatype: ("json"),
            catch: false,
            success: function(data) {
                $("#overlay").fadeOut();
                Confirmation(data);
            },
            error: function(data) {
                $("#overlay").fadeOut();
                swal("Ops! Fail To submit", "Data Submit", "error");
                console.log(data);
            }
        });

    }

    function Confirmation(data) {
        swal("Successfully Data Save", "Data Submit", "success", {
                buttons: {
                    cancel: "Cancel",
                    Show: "Show",
                    catch: {
                        text: "Print",
                        value: "catch",
                    },
                    datapdf: {
                        text: "Pdf",
                        value: "datapdf",
                        background: "#endregion",
                    },
                    Cancel: false,
                },
            })
            .then((value) => {
                switch (value) {

                    case "Show":
                        url = "{{ url('PurchaseRecieved/show')}}" + '/' + data,
                            window.location = url;
                        break;
                    case "catch":
                        url = "{{ url('PurchaseRecieved/LoadPrintslip')}}" + '/' + data,
                            window.open(url, '_blank');
                        break;
                    case "datapdf":
                        url = "{{ url('PurchaseRecieved/pdf')}}" + '/' + data,
                            window.open(url, '_blank');
                        break;

                    default:
                        //swal("Thank You For Your Choice");
                }
            });
        clear();
    }
</script>