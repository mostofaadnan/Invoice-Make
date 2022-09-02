<script type="text/javascript">
  var sl = 1;
  var mrp = 0;
  var unitid = 0;
  const $tableID = $('.data-table');
  var purchaseid = 0;


  function ReturnCode() {
    $.ajax({
      type: 'get',
      url: "{{ route('purchasereturn.purchasereturncode') }}",
      datatype: 'JSON',
      success: function(data) {
        $("#returncode").val(data);
      },
      error: function(data) {
        console.log(data);
      }
    });
  }
  function ViewPurchaseCode() {
    $.ajax({
      type: 'get',
      url: "{{ route('purchase.purchasecodedatalist') }}",
      datatype: 'JSON',
      success: function(data) {
        $('#purchaseno').html(data);
      },
      error: function(data) {}
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
window.onload=ItemDatalist();

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
  //window.onload = ItemDatalist();
  window.onload = SupplierDataList();
  window.onload = ReturnCode();
  window.onload=ViewPurchaseCode();
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
      /* "<button class='btn btn-info btn-edit'><i class='fa fa-edit' style='color:#fff'></i></button>" + */
      "<button class='btn btn-danger btn-delete'>X</button>" +
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
    $("#nettotal").val(sum.toFixed(2));
  }

  //inset Data
  function DataInsert() {
    $("#overlay").fadeIn();
    var returncode = $("#returncode").val();
    var parchasecode = $("#purchasecode").val();
    var openingdate = $("#dateinput").val();
    var supliername = $("#suppliersearch").val();
    var suplierid = $('#supplier').find('option[value="' + supliername + '"]').attr('id');
    var refno = $("#refno").val();
    var amount = $("#amount").val();
    var discount = $("#totaldiscount").val();
    var vat = $("#vat").val();
    var nettotal = $("#nettotal").val();
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
      url: "{{ route('purchasereturn.store') }}",
      //data: JSON.stringify(itemtables),
      data: {
        itemtables: itemtables,
        returncode: returncode,
        parchasecode: parchasecode,
        openingdate: openingdate,
        suplierid: suplierid,
        refno: refno,
        amount: amount,
        discount: discount,
        vat: vat,
        nettotal: nettotal,
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
    ReturnCode();
    $("#purchasecode").val("");
    $("#datatablebody").empty();
    $("#amount").val("0");
    $("#totaldiscount").val("0");
    $("#vat").val("0");
    $("#nettotal").val("0");
    $("#suppliersearch").val("");
    $("#refno").val("");
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
            url = "{{ url('Purchase-Return/show')}}" + '/' + purchaseid,
              window.location = url;
            break;
          case "catch":
            PurchasePrint();
            break;
          case "datapdf":
            url = "{{ url('Purchase-Return/purchasereturnpdf')}}" + '/' + purchaseid,
              window.open(url, '_blank');
            break;

          default:
            //swal("Thank You For Your Choice");
        }
      });
    ExecuteClear();
  }
  //data show
  /* $(document).on('click', '#datashow', function() {
    url = "{{ url('Purchase/show')}}" + '/' + purchaseid,
      window.location = url;
  });
  $("#pdf").on('click', function() {
    url = "{{ url('Purchase/purchasepdf')}}" + '/' + purchaseid,
      window.open(url, '_blank');
    $('#setting').modal('hide');

  });
  $("#print").printPage({
    url: "{{ url('Purchase/purchaseprint')}}" + '/' + purchaseid,
    attr: "href",
    message: "Your document is being created"
  }); */
</script>








<!-- <script type="text/javascript">
   
    $("form").submit(function(e){
        e.preventDefault();
        var name = $("input[name='name']").val();
        var email = $("input[name='email']").val();
     
        $(".data-table tbody").append("<tr data-name='"+name+"' data-email='"+email+"'><td>"+name+"</td><td>"+email+"</td><td><button class='btn btn-info btn-xs btn-edit'>Edit</button><button class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
    
        $("input[name='name']").val('');
        $("input[name='email']").val('');
    });
   
    $("body").on("click", ".btn-delete", function(){
        $(this).parents("tr").remove();
    });
    
    $("body").on("click", ".btn-edit", function(){
        var name = $(this).parents("tr").attr('data-name');
        var email = $(this).parents("tr").attr('data-email');
    
        $(this).parents("tr").find("td:eq(0)").html('<input name="edit_name" value="'+name+'">');
        $(this).parents("tr").find("td:eq(1)").html('<input name="edit_email" value="'+email+'">');
    
        $(this).parents("tr").find("td:eq(2)").prepend("<button class='btn btn-info btn-xs btn-update'>Update</button><button class='btn btn-warning btn-xs btn-cancel'>Cancel</button>")
        $(this).hide();
    });
   
    $("body").on("click", ".btn-cancel", function(){
        var name = $(this).parents("tr").attr('data-name');
        var email = $(this).parents("tr").attr('data-email');
    
        $(this).parents("tr").find("td:eq(0)").text(name);
        $(this).parents("tr").find("td:eq(1)").text(email);
   
        $(this).parents("tr").find(".btn-edit").show();
        $(this).parents("tr").find(".btn-update").remove();
        $(this).parents("tr").find(".btn-cancel").remove();
    });
   
    $("body").on("click", ".btn-update", function(){
        var name = $(this).parents("tr").find("input[name='edit_name']").val();
        var email = $(this).parents("tr").find("input[name='edit_email']").val();
    
        $(this).parents("tr").find("td:eq(0)").text(name);
        $(this).parents("tr").find("td:eq(1)").text(email);
     
        $(this).parents("tr").attr('data-name', name);
        $(this).parents("tr").attr('data-email', email);
    
        $(this).parents("tr").find(".btn-edit").show();
        $(this).parents("tr").find(".btn-cancel").remove();
        $(this).parents("tr").find(".btn-update").remove();
    });
    
</script> -->