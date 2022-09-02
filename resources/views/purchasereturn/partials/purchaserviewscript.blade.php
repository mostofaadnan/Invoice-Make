<script>
  var urlid;

  function getUrl() {
    var url = $(location).attr('href')
    var segment = url.split("/").length - 1 - (url.indexOf("http://") == -1 ? 0 : 2);
    if (segment == 3) {
      urlid = url.substring(url.lastIndexOf('/') + 1);
      PurchaseInfo(urlid);
    }
  }

  function ViewPurchaseReturnCode() {
    $.ajax({
      type: 'get',
      url: "{{ route('purchasereturn.retuncodedatalist') }}",
      datatype: 'JSON',
      success: function(data) {
        $('#returnno').html(data);
      },
      error: function(data) {
        console.log(data);
      }
    });
  }
  window.onload = ViewPurchaseReturnCode();
  window.onload = getUrl();
  $("#returncode").on('input', function() {
    var val = this.value;
    if ($('#returnno option').filter(function() {
        return this.value.toUpperCase() === val.toUpperCase();
      }).length) {
      urlid = $('#returnno').find('option[value="' + val + '"]').attr('id');
      PurchaseInfo(urlid);
    }
  });

  function PurchaseInfo(productid) {
    $.ajax({
      type: "get",
      url: "{{ url('Purchase-Return/getView')}}" + '/' + productid,
      datatype: ("json"),
      success: function(data) {
        console.log(data);
        lodDataBasicInfo(data);
        supplierInformation(data);
        loadTableDetails(data)
      },
      error: function(data) {
        console.log(data)
      }
    });
  }

  function lodDataBasicInfo(data) {
    $("#purchase_no").html(data.return_code);
    $("#returncode").val(data.return_code)
    $("#purchasedate").html(data.inputdate)
    $("#refno").html(data.ref_no)
    $("#subtotal").html(data.amount)
    $("#discount").html(data.discount)
    $("#vat").html(data.vat)
    $("#nettotal").html(data.nettotal)

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
    data.p_details.forEach(function(value) {

      $(".data-table tbody").append("<tr>" +
        "<td>" + sl + "</td>" +
        "<td>" + value.product_name['name'] + "</td>" +
        "<td>" + value.qty + "</td>" +
        "<td>" + value.product_name.unit_name['title'] + "</td>" +
        "<td  align='right'>" + value.tp + "</td>" +
        "<td class='amount' align='right'>" + value.amount + "</td>" +
        /*  "<td class='totaldiscount' align='right'>" + value.discount + "</td>" +
         "<td class='vat'align='right'>" + value.vat + "</td>" +
         "<td class='nettotal' align='right'>" + value.nettotal + "</td>" + */
        "</tr>");
      sl++;
    })
    /*     $(".data-table tbody").append("<tr>" +
          "<td colspan='4' align='right'><b>Total</b></td>" +
          "<td id='amount' align='right'> </td>" +
          "<td  id='totaldiscount'  align='right'> </td>" +
          "<td id='vat'  align='right'>  </td>" +
          "<td id='nettotal'  align='right'></td>" +
          "</tr>");
     */
  }
  $("#pdf").on('click', function() {
    url = "{{ url('Purchase-Return/purchasereturnpdf')}}" + '/' + urlid,
      window.open(url, '_blank');

  });

  $("#mail").on('click', function() {
    if (urlid > 0) {
      url = "{{ url('Purchase-Return/sendmail')}}" + '/' + urlid,
        window.location = url;
    }
  });


  $(document).on('click', "#datadelete", function() {

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
            url: "{{ url('Purchase-Return/delete')}}" + '/' + urlid,
            success: function() {
              url = "{{ route('purchasereturns')}}",
                window.location = url;
            },
            error: function(data) {
              console.log(data);
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

  });
</script>