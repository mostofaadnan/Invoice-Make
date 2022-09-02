<script type="text/javascript">
    var sl = 1;
    var mrp = 0;
    var unitid = 0;
    var wastageid = 0;

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
    window.onload=ItemDatalist();
  /*   $("#search").on('keyup', function() {
        var value = $(this).val();
        $.ajax({
            type: 'get',
            url: "{{ route('product.itemsearch') }}",
            data: {
                value: value
            },
            datatype: 'JSON',
            success: function(data) {
                if (data) {
                    $("#product").empty();
                    $('#product').html(data);
                } else {
                    $("#product").empty();
                    $("#mrp").val("");
                }
            },
            error: function(data) {

            }
        });

    }); */

    $("#search").on('input', function() {
        var val = this.value;
        if ($('#product option').filter(function() {
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            var mrp = $('#product').find('option[value="' + val + '"]').attr('data-tp');
            $("#mrp").val(mrp)
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
    $("#clear").on('click', function() {
        clear();
    })
    //Add rows
    $("#addrows").on('click', function(e) {
        var mrp = $("#mrp").val();
        var productname = $("#search").val();
        var itemcode = $('#product').find('option[value="' + productname + '"]').attr('id');
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

    });

    $('#qty').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            var mrp = $("#mrp").val();
            var productname = $("#search").val();
            var itemcode = $('#product').find('option[value="' + productname + '"]').attr('id');
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
        var name = $("#search").val();
        var item = $('#product').find('option[value="' + name + '"]').attr('id');
        var isvalid = true;
        $("#purchasetable tr").each(function() {
            var row = $(this);
            var tableitemcode = row.find("TD").eq(1).html();
            if (item == tableitemcode) {
                isvalid = false;
                //break;
                swal("Ops! This Data Already Exists", "input Data", "error");
                clear();
            }
        });
        if (isvalid == true) {
            addRowData();
        }
    }

    function addRowData() {

        var search = $("#search").val();
        var itemcode = $('#product').find('option[value="' + search + '"]').attr('id');
        mrp = $('#product').find('option[value="' + search + '"]').attr('data-mrp');
        unitid = $('#product').find('option[value="' + search + '"]').attr('data-unitid');
        productname = $('#product').find('option[value="' + search + '"]').attr('data-name');
        var qty = $("#qty").val();
        var unitprice = $("#mrp").val();
        var amount = parseFloat(qty * unitprice).toFixed(2);

        $(".data-table tbody").append("<tr id=" + sl + " data-unitid='" + unitid + "'>" +
            "<td>" + sl + "</td>" +
            "<td id='itemcode'>" + itemcode + "</td>" +
            "<td class='itemname'>" + productname + "</td>" +
            "<td class='qty' contenteditable='true' align='right'>" + qty + "</td>" +
            "<td align='right' id='unitprice'>" + unitprice + "</td>" +
            "<td class='amount' align='right'>" + amount + "</td>" +
            "<td>" +
            /* "<button class='btn btn-info btn-edit'><i class='fa fa-edit' style='color:#fff'></i></button>" + */
            "<button class='btn btn-danger btn-delete' style='width:100%' >X</button>" +
            "</td>" +
            "</tr>");
        sl++;
        TablelSummation();
        clear();


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
                    TablelSummation();
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
    });

    //qty update
    $("body").on("keyup", '.qty', function() {
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        var qty = $(this).parent("tr").find("td").eq(3).text();
        var unitprice= $(this).parent("tr").find("td").eq(4).text();
        if (qty == "" || !numberRegex.test(qty)) {
            qty = 0;
        }
        var amount = parseFloat(qty * unitprice).toFixed(2);
        $(this).parents("tr").find("td:eq(5)").text(amount);
        TablelSummation();

    });

    function clear() {
        $("#search").val("");
        $("#qty").val("");
        $("#mrp").val("");
        var amount = 0;
        $('#search').focus();
        mrp = 0;
        unitid = 0;
    }

    function TablelSummation() {
        netamount();
    }

    function netamount() {
        var sum = 0;
        $(".amount").each(function() {
            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        $("#amount").html(sum.toFixed(2));
    }



    //inset Data
    function DataInsert() {
        var openingdate = $("#dateinput").val();
        var nettotal = $("#amount").text();
        var remark = $("#remark").val();
        console.log(nettotal);
        var itemtables = new Array();
        $("#purchasetable TBODY TR").each(function() {
            var row = $(this);
            var item = {};
            item.mrp = row.attr('data-mrp');
            item.unitid = row.attr('data-unitid');
            item.code = row.find("TD").eq(1).html();
            item.Name = row.find("TD").eq(2).html();
            item.qty = row.find("TD").eq(3).html();
            item.unitprice = row.find("TD").eq(4).html();
            item.amount = row.find("TD").eq(5).html();
            itemtables.push(item);
        });

        $.ajax({
            type: "POST",
            url: "{{ route('wastage.store') }}",
            //data: JSON.stringify(itemtables),
            data: {
                itemtables: itemtables,
                openingdate: openingdate,
                nettotal: nettotal,
                remark: remark,
            },
            datatype: ("json"),
            success: function(data) {
                wastageid = data;
                Cinfirm()
            },
            error: function(data) {
                swal("Ops! Fail To submit", "Data Submit", "error");
                console.log(data);
            }
        });

    }
    $("#submittData").click(function() {

        if ($("#purchasetable tbody").is(':empty')) {
            swal("Please Select Requirment Fields", "Requirment Field Empty", "error");
        } else {
            DataInsert();
        }


    });

    function ExecuteClear() {
       
        $("#purchasetable tbody").empty();
        $("#amount").val("0");
        $("#remark").val("");
    }

    $("#resteBtn").click(function() {
        if ($("#datatablebody").is(':empty')) {
            ExecuteClear();
        } else {
            swal({
                    title: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        ExecuteClear();
                    } else {
                        //swal("Your imaginary file is safe!");
                    }
                });
        }

    });

    function Cinfirm() {
        swal("Successfully Data Save", "Data Submit", "success", {
                buttons: {
                    cancel: "Close",
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
                        url = "{{ url('Wastage/show')}}" + '/' + wastageid,
                            window.location = url;
                        break;
                    case "catch":
                        PurchasePrint();
                        break;
                    case "datapdf":
                        url = "{{ url('Wastage/wastagepdf')}}" + '/' + wastageid,
                            window.open(url, '_blank');
                        break;

                    default:
                        //swal("Thank You For Your Choice");
                }
            });
        ExecuteClear();
    }
</script>