<script type="text/javascript">
  var sl = 1;
  var mrp = 0;
  var unitid = 0;
  var netalltotal = 0;
  const $tableID = $('.data-table');
  var purchaseid = 0;
  var shipment = 0;

  function purchaseCode() {
    $.ajax({
      type: 'get',
      url: "{{ route('purchase.purchasecode') }}",
      datatype: 'JSON',
      success: function(data) {
        $("#purchasecode").val(data);
      },
      error: function(data) {
        console.log(data);
      }
    });
  }

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

  function SupplierDataList() {
    $.ajax({
      type: 'get',
      url: "{{ route('supplier.suplierdatalist') }}",
      datatype: 'JSON',
      success: function(data) {
        $('#supplier').html(data);

      },
      error: function(data) {

      }
    });
  }
  window.onload = ItemDatalist();
  window.onload = SupplierDataList();
  window.onload = purchaseCode();
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
    var discount = $("#discount").val();
    var totaldiscount = parseFloat(discount * qty).toFixed(2);
    var vat = 0.05;
    var productvat = parseFloat(unitprice * vat).toFixed(2);
    var totalvat = parseFloat(qty * productvat).toFixed(2);
    var total = parseFloat(amount - totaldiscount).toFixed(2);
    var nettotal = (parseFloat(totalvat) + parseFloat(total)).toFixed(2);

    $(".data-table tbody").append("<tr id=" + sl + " data-discount='" + discount + "' data-mrp='" + mrp + "' data-unitid='" + unitid + "'>" +
      "<td>" + sl + "</td>" +
      "<td id='itemcode'>" + itemcode + "</td>" +
      "<td class='itemname'>" + productname + "</td>" +
      "<td class='qty' contenteditable='true' align='right'>" + qty + "</td>" +
      "<td align='right'>" + unitprice + "</td>" +
      "<td class='amount' align='right'>" + amount + "</td>" +
      "<td class='discount' id='" + discount + "' align='right'>" + totaldiscount + "</td>" +
      "<td class='vat' align='right'>" + totalvat + "</td>" +
      "<td class='nettotal' align='right'>" + nettotal + "</td>" +
      "<td>" +
      " <div class='btn-group' role='group' aria-label='Basic example'>" +
      "<button class='btn btn-secondary btn-sm btn-iniview' id='invviewitem' data-id='" + itemcode + "' data-toggle='modal' data-target='#invmodelviewitems'><i class='fa fa-eye'></i></button>" +
      "<button class='btn btn-danger btn-delete'>X</button>" +
      "<div>" +
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
    if (qty == "" || !numberRegex.test(qty)) {
      qty = 0;
    }
    var getDiscount = $(this).parent("tr").find("td").eq(6).text();
    var unitprice = $(this).parent("tr").find("td").eq(4).text();
    var discount = $(this).parent("tr").attr('data-discount');
    var amount = parseFloat(qty * unitprice).toFixed(2);
    var totaldiscount = parseFloat(discount * qty).toFixed(2);
    var vat = 0.05;
    var productvat = parseFloat(unitprice * vat).toFixed(2);
    var totalvat = parseFloat(qty * productvat).toFixed(2);
    var total = parseFloat(amount - totaldiscount);
    var nettotal = (parseFloat(totalvat) + parseFloat(total)).toFixed(2);

    $(this).parents("tr").find("td:eq(5)").text(amount);
    $(this).parents("tr").find("td:eq(6)").text(totaldiscount);
    $(this).parents("tr").find("td:eq(7)").text(totalvat);
    $(this).parents("tr").find("td:eq(8)").text(nettotal);
    TablelSummation();

  });

  /*   $("body").on("keyup", '.discount', function() {
      var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
      var discount = $(this).parent("tr").find("td").eq(6).text();
      
      if (discount == "" || !numberRegex.test(discount)) {
        discount = 0;
      }
      var unitprice = $(this).parent("tr").find("td").eq(4).text();
      var qty = $(this).parent("tr").find("td").eq(3).text();
      var amount = parseFloat(qty * unitprice).toFixed(2);
      var totaldiscount = parseFloat(discount * qty).toFixed(2);
      var vat = 0.05;
      var productvat = parseFloat(unitprice * vat).toFixed(2);
      var totalvat = parseFloat(qty * productvat).toFixed(2);
      var total = parseFloat(amount - totaldiscount);
      var nettotal=(parseFloat(totalvat)+parseFloat(total)).toFixed(2);
      $(this).parents("tr").find("td:eq(5)").text(amount);
      $(this).parents("tr").find("td:eq(7)").text(totalvat);
      $(this).parents("tr").find("td:eq(8)").text(nettotal);
      TablelSummation();

    }); */
  function clear() {

    $("#search").val("");
    $("#qty").val("");
    $("#mrp").val("");
    $("#discount").val("");
    $('#search').focus();
    mrp = 0;
    unitid = 0;
  }

  function TablelSummation() {
    netamount();
    totaldiscount();
    totalvat();
    Nettotal();
  }

  function netamount() {
    var sum = 0;
    $(".amount").each(function() {
      var value = $(this).text();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    $("#amount").val(sum.toFixed(2));
  }

  function totaldiscount() {
    var sum = 0;
    $(".discount").each(function() {
      var value = $(this).text();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    $("#totaldiscount").val(sum.toFixed(2));
  }

  function totalvat() {
    var sum = 0;
    $(".vat").each(function() {
      var value = $(this).text();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    $("#vat").val(sum.toFixed(2));
  }

  function Nettotal() {
    var sum = 0;
    $(".nettotal").each(function() {
      var value = $(this).text();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    if ($("#shipment").val() == "") {
      shipment = 0;
    } else {
      shipment = parseFloat($("#shipment").val());
    }
    netalltotal = (sum + shipment).toFixed(2);
    // console.log(shipment);
    $("#nettotal").val(netalltotal);
  }

  $("#shipment").on('keyup', function() {
    if (netalltotal > 0) {
      Nettotal();
    }

  })
  //inset Data
  function DataInsert() {
    $("#overlay").fadeIn();
    var shipmens;
    var parchasecode = $("#purchasecode").val();
    var openingdate = $("#inputdate").val();
    var supliername = $("#suppliersearch").val();
    var suplierid = $('#supplier').find('option[value="' + supliername + '"]').attr('id');
    var refno = $("#refno").val();
    var amount = $("#amount").val();
    var discount = $("#totaldiscount").val();
    var vat = $("#vat").val();
    var nettotal = $("#nettotal").val();
    if ($("#shipment").val() == "") {
      shipmens = 0;
    } else {
      shipmens = $("#shipment").val();
    }
    var remark = $("#remark").val();
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
      item.discount = row.find("TD").eq(6).html();
      item.vat = row.find("TD").eq(7).html();
      item.nettotal = row.find("TD").eq(8).html();
      itemtables.push(item);
    });

    $.ajax({
      type: "POST",
      url: "{{ route('purchase.store') }}",
      //data: JSON.stringify(itemtables),
      data: {
        itemtables: itemtables,
        parchasecode: parchasecode,
        openingdate: openingdate,
        suplierid: suplierid,
        refno: refno,
        amount: amount,
        discount: discount,
        vat: vat,
        nettotal: nettotal,
        shipment: shipmens,
        remark: remark,
      },
      datatype: ("json"),
      success: function(data) {
        $("#overlay").fadeOut();
        purchaseid = data;
        Cinfirm()
      },
      error: function(data) {
        $("#overlay").fadeOut();
        swal("Ops! Fail To submit", "Data Submit", "error");
        console.log(data);
      }
    });

  }
  $("#submittData").click(function() {
    var supliername = $("#suppliersearch").val();
    var suplierid = $('#suppliersearch').find('option[value="' + supliername + '"]').attr('id');
    if ($("#datatablebody").is(':empty') || $("#suppliersearch").val() == "" || suplierid == 0) {
      swal("Please Select Requirment Fields", "Requirment Field Empty", "error");
    } else {
      DataInsert();
    }
  });

  function ExecuteClear() {
    purchaseCode();
    netalltotal = 0;
    shipment = 0;
    $("#datatablebody").empty();
    $("#amount").val("0");
    $("#totaldiscount").val("0");
    $("#vat").val("0");
    $("#nettotal").val("0");
    $("#suppliersearch").val("");
    $("#refno").val("");
    $("#shipment").val("");
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
          cancel: "Cancel",
          Show: "Show",
          precieve: {
            text: "Recieve",
            value: "precieve",
          },
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
            url = "{{ url('Purchase/show')}}" + '/' + purchaseid,
              window.location = url;
            break;
          case "precieve":
            url = "{{ url('PurchaseRecieved/RecievedById')}}" + '/' + purchaseid,
              window.location = url;
            break;
          case "catch":
            url = "{{ url('Purchase/LoadPrintslip')}}" + '/' + data,
              window.open(url, '_blank');
            break;
          case "datapdf":
            url = "{{ url('Purchase/purchasepdf')}}" + '/' + purchaseid,
              window.open(url, '_blank');
            break;

          default:
            //swal("Thank You For Your Choice");
        }
      });
    ExecuteClear();
  }
</script>