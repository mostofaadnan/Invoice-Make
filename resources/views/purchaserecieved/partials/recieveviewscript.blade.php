<script>
  var precieveno;



  function ViewPurchaseCode() {
    $.ajax({
      type: 'get',
      url: "{{ route('precieve.recieveCodeDataList') }}",
      datatype: 'JSON',
      success: function(data) {
        $('#purchaseno').html(data);
      },
      error: function(data) {
        console.log(data)
      }
    });
  }
  window.onload = ViewPurchaseCode();
  $("#purchasecode").on('input', function() {
    var val = this.value;
    if ($('#purchaseno option').filter(function() {
        return this.value.toUpperCase() === val.toUpperCase();
      }).length) {
      precieveno = $('#purchaseno').find('option[value="' + val + '"]').attr('id');
      $.ajax({
        type: 'post',
        url: "{{ url('Session-Id/grnid')}}" + '/' + precieveno,
        success: function() {
          PurchaseInfo();
        }
      });
    }
  });

  function PurchaseInfo() {
    $.ajax({
      type: "get",
      url: "{{ url('PurchaseRecieved/getview')}}",
      datatype: ("json"),
      success: function(data) {
        precieveno = data.id
        lodDataBasicInfo(data);
        supplierinfo(data.purchase_details.supplier_id)
        loadTableDetails(data.purchase_details.p_details)
      },
      error: function(data) {
        console.log(data);
      }
    });
  }
  window.onload = PurchaseInfo();

  function lodDataBasicInfo(data) {
    var status = data.purchase_details['status'] == 1 ? 'Active' : 'Inactive'
    $("#purchasecode").val(data.purchaseRecievdNo)
    $("#recieve_no").html(data.purchaseRecievdNo)
    $("#purchase_no").html(data.purchase_details['purchasecode'])
    $("#purchasedate").html(data.inputdate)
    $("#refno").html(data.ref_no)
    $("#subtotal").html(data.purchase_details['amount'])
    $("#discount").html(data.purchase_details['discount'])
    $("#vat").html(data.purchase_details['vat'])
    $("#shipment").html(data.purchase_details['shipment'])
    $("#nettotal").html(data.purchase_details['nettotal'])
    $("#status").html(status)
    $("#remark").html(data.remark)
  }

  function supplierinfo(supid) {
    $.ajax({
      type: 'get',
      url: "{{url('Supplier/supplierinfo')}}?supplierid=" + supid,
      success: function(data) {
        supplierInformation(data.supplier);
        SupplierinfoDetails(data);
      },
      error: function(data) {
        console.log(data);
      }
    });

  }

  function supplierInformation(data) {
    $("#suppliername").html(data.name);
    $("#supplieraddress").html("<p>" + data.address + "," + data.city_name['name'] + "," + data.state_name['name'] + ",</p>");
    $("#suppliercountry").html("<p>" + data.country_name['name'] + ".</p>");
    $("#mobile").html("&nbsp;&nbsp;" + data.mobile_no);
    $("#telno").html("&nbsp;&nbsp;" + data.tell_no);
    $("#email").html("&nbsp;&nbsp;" + data.email);
    $("#website").html("&nbsp;&nbsp;" + data.website);
  }

  function SupplierinfoDetails(data) {
    $("#consignment").html('<b>' + data.consignment + '</b>')
    $("#sdiscount").html('<b>' + data.discount + '</b>')
    $("#spayment").html('<b>' + data.payment + '</b>')
    $("#sbalancedue").html('<b>' + data.balancedue + '</b>')
  }

  function loadTableDetails(data) {
    $("#tablebody").empty();
    var sl = 1;
    data.forEach(function(value) {

      $(".data-table tbody").append("<tr>" +
        "<td>" + sl + "</td>" +
        "<td>" + value.product_name['name'] + "</td>" +
        "<td>" + value.qty + "</td>" +
        "<td>" + value.unit_name['Shortcut'] + "</td>" +
        "<td  align='right'>" + value.tp + "</td>" +
        "<td class='amount' align='right'>" + value.amount + "</td>" +
        "</tr>");
      sl++;
    })

  }
  $("#pdf").on('click', function() {

    url = "{{ url('PurchaseRecieved/pdf')}}" + '/' + precieveno,
      window.open(url, '_blank');

  });
  $("#print").on('click', function() {

    url = "{{ url('PurchaseRecieved/LoadPrintslip')}}" + '/' + precieveno,
      window.open(url, '_blank');

  });
  $("#mail").on('click', function() {

    url = "{{ url('PurchaseRecieved/sendmail')}}" + '/' + precieveno,
      window.location = url;

  });

  $("#print").printPage({
    url: "{{ url('Purchase/purchaseprint')}}" + '/' + precieveno,
    attr: "href",
    message: "Your document is being created"
  });

  /*  //edit
   $(document).on('click', '#dataedit', function() {
     var id = $(this).data("id");
     url = "{{ url('Purchase/edit')}}" + '/' + urlid,
       window.location = url;
   });
  */
</script>