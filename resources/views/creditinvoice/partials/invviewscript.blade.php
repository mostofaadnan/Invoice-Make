<script>
  var invoiceid;

  /*   function getUrl() {
      var url = $(location).attr('href')
      var segment = url.split("/").length - 1 - (url.indexOf("http://") == -1 ? 0 : 2);
      if (segment == 3) {
        invoiceid = url.substring(url.lastIndexOf('/') + 1);
        InvoiceDetails();
      }
    }
   */
  function ViewInvoiceCode() {
    $.ajax({
      type: 'get',
      url: "{{ route('creditinvoice.invoicecodedatalist') }}",
      datatype: 'JSON',
      success: function(data) {
        $('#invoicenumber').html(data);
      },
      error: function(data) {}
    });
  }

  window.onload = ViewInvoiceCode();

  $("#invoicecode").on('input', function() {
    var val = this.value;
    if ($('#invoicenumber option').filter(function() {
        return this.value.toUpperCase() === val.toUpperCase();
      }).length) {
      invoiceid = $('#invoicenumber').find('option[value="' + val + '"]').attr('id');
      $.ajax({
        type: 'post',
        url: "{{ url('Session-Id/invid')}}" + '/' + invoiceid,
        success: function() {
          InvoiceDetails();
        }
      });
    }
  });

  function InvoiceDetails() {
    $.ajax({
      type: "get",
      url: "{{ url('Invoice/getView')}}",
      datatype: ("json"),
      success: function(data) {
        invoiceid = data.id
        $("#invoicecode").val(data.invoice_no);
        lodData(data);
      },
      error: function(data) {

      }

    });
  }
  window.onload = InvoiceDetails();

  function lodData(data) {
    var paymenttype = data.paymenttype_id = 1 ? 'Cash' : 'Card';
    var type = data.type_id = 1 ? 'Cash Invoice' : 'Credit';
    $("#invoiceno").html(data.invoice_no)
    $("#invoicedate").html(data.inputdate)
    $("#refno").html(data.ref_no)
    $("#type").html(type)
    $("#subtotal").html(data.amount)
    $("#discount").html(data.discount)
    $("#vat").html(data.vat)
    $("#shipment").html(data.shipment)
    $("#nettotal").html(data.nettotal)
    $("#paymenttype").html(paymenttype)
    loadTableDetails(data);
    customerInfo(data.customer_id);
  }

  function customerInfo(cusid) {
    $.ajax({
      type: 'get',
      url: "{{url('Customer/customerinfo')}}?customerid=" + cusid,
      success: function(data) {
        console.log(data)
        customerInformation(data.customer);
        CustomerinfoDetails(data);
      },
      error: function(data) {
        console.log(data);
      }
    });

  }
  function customerInformation(data) {
    $("#customername").html(data.name);
    $("#customeraddress").html("<p>" + data.address + "," + data.city_name['name'] + "," + data.state_name['name'] + ",</p>");
    $("#customercountry").html("<p>" + data.country_name['name'] + ".</p>");
    $("#mobile").html("&nbsp;&nbsp;" + data.mobile_no);
    $("#telno").html("&nbsp;&nbsp;" + data.tell_no);
    $("#email").html("&nbsp;&nbsp;" + data.email);
    $("#website").html("&nbsp;&nbsp;" + data.website);
  }

  function CustomerinfoDetails(data) {
    $("#opening").html('<b>' + (data.openingbalance).toFixed(2) + '</b>')
    $("#cashinv").html('<b>' + (data.cashinvoice).toFixed(2) + '</b>')
    $("#creditinv").html('<b>' + (data.creditinvoice).toFixed(2) + '</b>')
    $("#consignment").html('<b>' + (data.consignment).toFixed(2) + '</b>')
    $("#sdiscount").html('<b>' + (data.discount).toFixed(2) + '</b>')
    $("#spayment").html('<b>' + (data.payment).toFixed(2) + '</b>')
    $("#sbalancedue").html('<b>' + (data.balancedue).toFixed(2) + '</b>')
  }


  function loadTableDetails(data) {
    $("#tablebody").empty();
    var sl = 1;
    data.inv_details.forEach(function(value) {
      $(".data-table tbody").append("<tr>" +
        "<td>" + sl + "</td>" +
        "<td class='itemname'>" + value.product_name['name'] + "</td>" +
        "<td align='right'>" + value.qty + "</td>" +
        "<td>" + value.unit_name['Shortcut'] + "</td>" +
        "<td align='right'>" + value.mrp + "</td>" +
        "<td align='right' class='vat'>" + value.amount + "</td>" +
        "</tr>");
      sl++;
    })
  }
  $("#invoicepdf").on('click', function() {

    url = "{{ url('Credit-Invoice/invoicepdf')}}" + '/' + invoiceid,
      window.open(url, '_blank');

  });
  $(document).on('click', '#printslip', function() {
   
    url = "{{ url('Credit-Invoice/LoadPrintslip')}}" + '/' + invoiceid,
      window.open(url, '_blank');
  });
  $("#mail").on('click', function() {
    if (invoiceid > 0) {
      url = "{{ url('Credit-Invoice/sendmail')}}" + '/' + invoiceid,
        window.location = url;
    }

  });
</script>