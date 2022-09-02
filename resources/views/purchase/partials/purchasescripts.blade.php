<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  var sl = 1;
  const $tableID = $('.data-table');

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
      var dataid = $('#product').find('option[value="' + val + '"]').attr('id');
      $.ajax({
        type: 'get',
        url: "{{ route('purchase.getSearch') }}",
        //data: data,
        data: {
          dataid: dataid,
        },
        datatype: 'JSON',
        success: function(data) {
          $("#mrp").val(data.mrp);
        },
        error: function(data) {
          // console.log(data);
        }
      });

    }
  });



  //Add rows
  $("#addrows").on('click', function(e) {

    var productname = $("#search").val();
    var itemcode = $('#product').find('option[value="' + productname + '"]').attr('id');
    var qty = $("#qty").val();
    if (productname == "" || qty == "") {
      swal("Please Select Requrie Field", "Require Field", "error");

    } else {
     
      var unitprice = $("#mrp").val();
      var amount = parseFloat(qty * unitprice);
      var discount = $("#discount").val();
      var totaldiscount = parseFloat(discount * qty);
      var vat = 0.50;
      var totalvat = parseFloat(qty * unitprice);
      var total = parseFloat(amount - discount);
      var nettotal = totalvat + total;

      $(".data-table tbody").append("<tr id=" + sl + " >" +
        "<td>" + sl + "</td>" +
        "<td>" + itemcode + "</td>" +
        "<td class='itemname'>" + productname + "</td>" +
        "<td>" + qty + "</td>" +
        "<td>" + unitprice + "</td>" +
        "<td class='amount'>" + amount + "</td>" +
        "<td class='discount'>" + totaldiscount + "</td>" +
        "<td class='vat'>" + totalvat + "</td>" +
        "<td class='nettotal'>" + nettotal + "</td>" +
        "<td>" +
        /* "<button class='btn btn-info btn-edit'><i class='fa fa-edit' style='color:#fff'></i></button>" + */
        "<button class='btn btn-danger btn-delete'><i class='fa fa-trash' style='color:#fff'></i></button>" +
        "</td>" +
        "</tr>");
      sl++;
      
      TablelSummation();

      clear();


    }

  });
  $("body").on("click", ".btn-delete", function() {
    $(this).parents("tr").remove();
    TablelSummation();
  });


  $tableID.on('click', '.table-up', function() {

    const $row = $(this).parents('tr');

    if ($row.index() === 0) {
      return;
    }

    $row.prev().before($row.get(0));
  });

  $tableID.on('click', '.table-down', function() {

    const $row = $(this).parents('tr');
    $row.next().after($row.get(0));
  });



  function clear() {

    $("#search").val("");
    $("#qty").val("");
    $("#mrp").val("");
    $("#discount").val("");
    var amount = 0;
    var discount = 0;
    var totaldiscount = 0;
    var vat = 0;
    var totalvat = 0;
    var total = 0;
    var nettotal = 0;
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
    $("#amount").val(sum);

  }

  function totaldiscount() {
    var sum = 0;
    $(".discount").each(function() {
      var value = $(this).text();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    $("#totaldiscount").val(sum);
  }

  function totalvat() {
    var sum = 0;
    $(".vat").each(function() {
      var value = $(this).text();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    $("#vat").val(sum);
  }

  function Nettotal() {
    var sum = 0;
    $(".nettotal").each(function() {
      var value = $(this).text();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    $("#nettotal").val(sum);
  }

  //inset Data
  function DataInsert() {
    var parchasecode = $("#purchasecode").val();
    var openingdate = $("#dateinput").val();
    var supliername = $("#suppliersearch").val();
    var suplierid = $('#supplier').find('option[value="' + supliername + '"]').attr('id');
    var refno = $("#refno").val();
    var amount = $("#amount").val();
    var discount = $("#totaldiscount").val();
    var vat = $("#vat").val();
    var nettotal = $("#nettotal").val();
    var itemtables = new Array();
    $("#purchasetable TBODY TR").each(function() {
      var row = $(this);
      var item = {};
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
    //  console.log(itemtables);
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
      },
      datatype: ("json"),
      success: function(data) {
        swal("Successfully Data Save", "Data Submit", "success");
        ExecuteClear();
      },
      error: function(data) {
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
    $("#datatablebody").empty();
    $("#amount").val("0");
    $("#discount").val("0");
    $("#vat").val("0");
    $("#nettoal").val("0");
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