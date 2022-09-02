<script>
  var urlid;
  var status;

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
  window.onload = ViewPurchaseCode();

  function PurchaseInfo() {
    $.ajax({
      type: "get",
      url: "{{ url('Purchase/getView')}}",
      datatype: ("json"),
      success: function(data) {
        urlid = data.id;
        lodDataBasicInfo(data);
        supplierInformation(data);
        loadTableDetails(data.p_details)
        status = data.status;
        showHideBtn();
      },
      error: function(data) {
        console.log(data)
      }
    });
  }
  window.onload = PurchaseInfo();
  $("#purchasecode").on('input', function() {
    var val = this.value;
    if ($('#purchaseno option').filter(function() {
        return this.value.toUpperCase() === val.toUpperCase();
      }).length) {
      urlid = $('#purchaseno').find('option[value="' + val + '"]').attr('id');
      $.ajax({
        type: 'post',
        url: "{{ url('Session-Id/purchaseId')}}" + '/' + urlid,
        success: function() {
          PurchaseInfo();
        }
      });
    }
  });


  function showHideBtn() {
    if (status == 0) {
      $("#dataedit").show();
      $("#datadelete").show();
    } else {
      $("#dataedit").hide();
      $("#datadelete").hide();
    }
  }

  function lodDataBasicInfo(data) {
    var status = data.status == 1 ? 'Active' : 'Inactive'
    $("#purchasecode").val(data.purchasecode)
    $("#purchase_no").html(data.purchasecode)
    $("#purchasedate").html(data.inputdate)
    $("#shipment").html(data.shipment)
    $("#refno").html(data.ref_no)
    $("#subtotal").html(data.amount)
    $("#discount").html(data.discount)
    $("#vat").html(data.vat)
    $("#nettotal").html(data.nettotal)
    $("#status").html(status)
  }

  function supplierInformation(data) {
    $("#customername").html('<b style="color:red">' + data.supplier_name['name'] + '</b>');
    $("#customeraddress").html("<p>" + data.supplier_name['address'] + "," + data.supplier_name.city_name['name'] + "," + data.supplier_name.state_name['name'] + ",</p>");
    $("#customercountry").html("<p>" + data.supplier_name.country_name['name'] + ".</p>");
    $("#mobile").html("&nbsp;&nbsp;" + data.supplier_name['mobile_no']);
    $("#telno").html("&nbsp;&nbsp;" + data.supplier_name['tell_no']);
    $("#email").html("&nbsp;&nbsp;" + data.supplier_name['email']);
    $("#website").html("&nbsp;&nbsp;" + data.supplier_name['website']);
  }

  function loadTableDetails(data) {
    $("#tablebody").empty();
    var sl = 1;

    data.forEach(function(value) {
      $(".data-table tbody").append("<tr>" +
        "<td>" + sl + "</td>" +
        "<td>" + value.product_name['name'] + "</td>" +
        "<td align='right'>" + value.qty + "</td>" +
        "<td>" + value.unit_name['Shortcut'] + "</td>" +
        "<td  align='right'>" + value.tp + "</td>" +
        "<td class='amount' align='right'>" + value.amount + "</td>" +
        "</tr>");
      sl++;
    })
  }
  $("#purchasepdf").on('click', function() {
    url = "{{ url('Purchase/purchasepdf')}}" + '/' + urlid,
      window.open(url, '_blank');

  });
  $("#print").on('click', function() {
    url = "{{ url('Purchase/LoadPrintslip')}}" + '/' + urlid,
      window.open(url, '_blank');

  });
  //edit
  $(document).on('click', '#dataedit', function() {
    var id = $(this).data("id");
    if (status == 0) {
      url = "{{ url('Purchase/edit')}}" + '/' + urlid,
        window.location = url;
    } else {
      swal("Opps! Faild", "This Purchase Data Already Active", "error");
    }

  });
  $("#mail").on('click', function() {
    if (urlid > 0) {
      url = "{{ url('Purchase/sendmail')}}" + '/' + urlid,
        window.location = url;
    }
  });
  $(document).on('click', "#datadelete", function() {

    if (status == 0) {
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this  data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).data("id");
            $.ajax({
              type: "post",
              url: "{{ url('Purchase/delete')}}" + '/' + urlid,
              success: function() {
                url = "{{ route('purchases')}}";
                window.location = url;
              },
              error: function() {

                swal("Opps! Faild", "Data Fail to Delete", "error");
              }
            });
            swal("Ok! Your file has been deleted!", {
              icon: "success",
            });
          } else {
            swal("Your file is safe!");
          }
        });
    } else {
      swal("Opps! Faild", "This Purchase Data Already Active", "error");
    }

  });
</script>