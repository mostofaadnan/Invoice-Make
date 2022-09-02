<script>
    var companyshow = 0;
    var itemcodeshow = 0;
    var itemnameshow = 0;
    var itempriceshow = 0;
    var itemdiscountshow = 0;
    var itemothernoteshow = 0;
    var company = "";
    var sl = 1;
    itemids = 0;

    function CompanyInfromation() {
        $.ajax({
            type: 'get',
            url: "{{ route('company.information') }}",
            dataType: ("json"),
            success: function(data) {
                company = data.name;
                $("#companynames").val(company)
                $("#barcodecompanyname").html('<b>' + company + '</b>');
            },
        });

    }

    $('#barcodetype').change(function() {
        $("#dimensiontype").empty();
        if ($(this).val() !== "") {
            var dimensions = $(this).find(':selected').attr('data-dimension');
            $("#dimensiontype").append('<option value="' + dimensions + '">' + dimensions + '</option>');
        }
    });

    function barcodeconfig() {

        $.ajax({
            type: 'get',
            url: "{{ route('barcode.barcodeconfig') }}",
            dataType: ("json"),
            success: function(data) {
                setting(data);
            },
            error: function(data) {

            }
        });

    }

    function setting(data) {
        data.companyshow == 1 ? $("#companyname").prop("checked", true) : $("#companyname").prop("checked", false)
        data.itemcodeshow == 1 ? $("#showcode").prop("checked", true) : $("#showcode").prop("checked", false)
        data.itemnameshow == 1 ? $("#itemname").prop("checked", true) : $("#itemname").prop("checked", false)
        data.itempriceshow == 1 ? $("#price").prop("checked", true) : $("#price").prop("checked", false)
        data.itemothernoteshow == 1 ? $("#othernotes").prop("checked", true) : $("#othernotes").prop("checked", false)
        $("#width").val(data.width);
        $("#height").val(data.height);
    }

    function LabelshowSubmit() {
        $("#companyname").prop("checked") == true ? companyshow = 1 : companyshow = 0
        $("#showcode").prop("checked") == true ? itemcodeshow = 1 : itemcodeshow = 0
        $("#itemname").prop("checked") == true ? itemnameshow = 1 : itemnameshow = 0
        $("#price").prop("checked") == true ? itempriceshow = 1 : itempriceshow = 0
        $("#othernotes").prop("checked") == true ? itemothernoteshow = 1 : itemothernoteshow = 0
        var width = $("#widthdata").val();
        var height = $("#heightdata").val();
        console.log(width);
        $.ajax({
            type: "post",
            url: "{{ route('barcode.updateconfig') }}",
            data: {
                companyshow: companyshow,
                itemcodeshow: itemcodeshow,
                itemnameshow: itemnameshow,
                itempriceshow: itempriceshow,
                itemothernoteshow: itemothernoteshow,
            },
            datatype: ("json"),
            success: function(data) {
                $("#message").html(data);
                setTimeout(function() {
                    $("#message").hide();
                }, 3000);
                barcodeconfig();
            },
            error: function(data) {
                console.log(data);
                $("#message").html(data);
                setTimeout(function() {
                    $("#message").hide();
                }, 5000);
            }


        });
    }
    $("#barcodesettingsubmit").on("click", function() {
        LabelshowSubmit();
    });

    function ItemDatalist() {
        $.ajax({
            type: 'get',
            url: "{{ route('product.itemdatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#product').html(data);
            },
            error: function(data) {}
        });
    }
    window.onload = ItemDatalist();
    $(document).ready(function() {
        $("f1").keypress(function() {
            $('#qty').focus();
        });
        $("button").click(function() {
            $("f1").keypress();
        });
    });
    window.onload = CompanyInfromation();
    window.onload = barcodeconfig();
    window.onload = ItemDatalist();
    $("#search").on('input', function() {
        var val = this.value;
        if ($('#product option').filter(function() {
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            itemids = $('#product').find('option[value="' + val + '"]').attr('data-barcode');
            var mrp = $('#product').find('option[value="' + val + '"]').attr('data-mrp');
            var discountprice = $('#product').find('option[value="' + val + '"]').attr('data-discount');
            if (mrp) {
                $("#mrp").val(mrp);
                $("#discount").val(discountprice);
            } else {
                $("#mrp").val("");
            }

        }
    });
    $('#search').keypress(function(e) {
        var key = e.which;
        if (key == 13) {
            if ($("#mrp").val() !== "") {
                $('#qty').focus();
            }
        }
    });

    //Add rows
    $("#addrows").on('click', function(e) {
        var product = $("#search").val();
        var code = $('#product').find('option[value="' + product + '"]').attr('id');
        var qty = $("#qty").val();
        if (product == "" || qty == "" || code == 0) {
            swal("Please Select Requrie Field", "Require Field", "error");
        } else {
            var rowCount = $('.data-table tr').length;
            if (rowCount == 1) {
                addRowData();
            } else {
                CheckEntry();
            }
        }
    });
    $('#qty').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            var mrp = $("#mrp").val();
            var productname = $("#search").val();
            var itemcode = $('#product').find('option[value="' + productname + '"]').attr('data-barcode');
            var qty = $("#qty").val();
            if (productname == "" || qty == "" || itemcode == 0 || mrp == "" || mrp == 0 || qty == 0) {
                swal("Please Select Requrie Field", "Require Field", "error");
            } else {
                var rowCount = $('.data-table tr').length;
                if (rowCount == 1) {
                    addRowData();
                } else {
                    CheckEntry();
                }

            }

        }
    });

    function CheckEntry() {
        var qty = $("#qty").val();
        var isvalid = true;
        $("#invoicetable tr").each(function() {
            var row = $(this);
            var tableitemcode = row.find("TD").eq(1).html();
            if (itemids == tableitemcode) {
                isvalid = false;
                var findrow = $(this);
                AutoQuantityUpdate(findrow, qty)

            }
        });
        if (isvalid == true) {
            addRowData();
        }
    }

    function AutoQuantityUpdate(row, qty) {
        var discount = $("#discount").val();
        var rowqty = row.find("td").eq(5).text();
        var totalqty = parseInt(rowqty) + parseInt(qty);
        row.find("td:eq(4)").text(discount);
        row.find("td:eq(5)").text(totalqty);
        clear();
    }

    function addRowData() {
        var search = $("#search").val();
        /*  var itemcode = $('#product').find('option[value="' + search + '"]').attr('id'); */
        var barcode = $('#product').find('option[value="' + search + '"]').attr('data-barcode');
        var unitname = $('#product').find('option[value="' + search + '"]').attr('data-unitname');
        var productname = $('#product').find('option[value="' + search + '"]').attr('data-name');
        var qty = $("#qty").val();
        var unitprice = $("#mrp").val();
        var discount = $("#discount").val();
        $(".data-table tbody").append("<tr id=" + sl + " data-discount='" + discount + "'>" +
            "<td>" + sl + "</td>" +
            "<td >" + barcode + "</td>" +
            "<td >" + productname + "</td>" +
            "<td align='right'>" + unitprice + "</td>" +
            "<td contenteditable='true' align='right'>" + discount + "</td>" +
            "<td class='qty' contenteditable='true' align='right'>" + qty + "</td>" +
            "<td>" +
            /* "<button class='btn btn-info btn-edit'><i class='fa fa-edit' style='color:#fff'></i></button>" + */
            "<button class='btn btn-danger btn-delete'>X</button>" +
            "</td>" +
            "</tr>");
        sl++;
        clear();
    }

    function clear() {
        $("#search").val("");
        $("#qty").val("");
        $("#mrp").val("");
        $("#discount").val("");
        $('#search').focus();
        itemids = 0;
    }
    $("body").on("click", ".btn-delete", function() {
        swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parents("tr").remove();
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
    });


    //inset Data
    function DataInsert() {
        var barcodetype = $("#barcodetype").val();
        var dimension = $("#dimensiontype").val();
        var companyname = $("#companynames").val();
        var itemtables = new Array();
        $("#invoicetable TBODY TR").each(function() {
            var row = $(this);
            var item = {};
            item.code = row.find("TD").eq(1).html();
            item.Name = row.find("TD").eq(2).html();
            item.unitprice = row.find("TD").eq(3).html();
            item.discount = row.find("TD").eq(4).html();
            item.qty = row.find("TD").eq(5).html();
            itemtables.push(item);
        });
        $.ajax({
            type: "POST",
            url: "{{ route('barcode.store') }}",
            data: {
                itemtables: itemtables,
                barcodetype: barcodetype,
                dimension: dimension,
                companyname: companyname,
            },
            datatype: ("json"),
            success: function(data) {
                url = "{{ url('Label/pdfview')}}",
                    window.open(url, '_blank');
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    $("#submittData").click(function() {
        if ($("#barcodetype").val() == "" || $("#datatablebody").is(':empty')) {
            swal("Ops!Please Select Barcode Type Or Table Empty", "input Data", "error");
        } else {
            DataInsert();
        }
    });
    $(document).on('click', "#resteBtn", function() {
        $("#datatablebody").empty();
    });
</script>