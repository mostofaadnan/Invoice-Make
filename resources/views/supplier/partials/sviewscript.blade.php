<script>
  var supplierid = 0;
  var purchaseTable;
  var tablepayment;

  function getUrl() {
    var url = $(location).attr('href')
    var segment = url.split("/").length - 1 - (url.indexOf("http://") == -1 ? 0 : 2);
    supplierid = url.substring(url.lastIndexOf('/') + 1);
    supplierinfo(supplierid);
  }
  window.onload = getUrl();

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
  $("#suppliersearch").on('input', function() {
    var val = this.value;
    if (val == "") {
      //clear();
    } else {
      if ($('#supplier option').filter(function() {
          return this.value.toUpperCase() === val.toUpperCase();
        }).length) {
        supplierid = $('#supplier').find('option[value="' + val + '"]').attr('id');
        purchaseTable.destroy();
        tablepayment.destroy();
        supplierinfo(supplierid);
        changeUrl();
      }
    }

  });

  function changeUrl() {
    var url = $(location).attr('href')
    var i = url.lastIndexOf('/');
    if (i != -1) {
      newurl = url.substr(0, i) + "/" + supplierid;
      history.pushState({}, null, newurl);
    }
  }

  function supplierinfo(supid) {
    $.ajax({
      type: 'get',
      url: "{{url('Supplier/supplierinfo')}}?supplierid=" + supid,

      success: function(data) {
        supplierBasicInfo(data.supplier);
        Supplieraddress(data.supplier);
        SupplierinfoDetails(data);
        supplierDocument(data.supplier.supplier_document)
        DataTablePurchase();
        DataTablesPayment();

      },
      error: function(data) {
        console.log(data);
      }
    });

  }

  function supplierBasicInfo(data) {
    $('#imgProfilev').attr('src', '');
    $("#suppliername").text(data.name);
    
    var imagesrc = "{{ asset('storage/app/public/supplier/') }}/" + data.image;
    $('#imgProfile').attr('src', imagesrc);
    var status = data.status == 1 ? 'Active' : 'Inactive';
    $("#basicinfo").html(
      '<h5>Details</h5>' +
      '<hr>' +
      'TIN:' + data.TIN + '<br>' +
      'Oppening Date:' + data.openingDate + '<br>' +
      'Status: <span class="span-info">' + status + '</span>'
    );

  }

  function Supplieraddress(data) {
    $("#customeraddress").html("<p>" + data.address + "," + data.city_name['name'] + "," + data.state_name['name'] + ",</p>");
    $("#customercountry").html("<p>" + data.country_name['name'] + ".</p>");
    $("#mobile").html("&nbsp;&nbsp;" + data.mobile_no);
    $("#telno").html("&nbsp;&nbsp;" + data.tell_no);
    $("#email").html("&nbsp;&nbsp;" + data.email);
    $("#website").html("&nbsp;&nbsp;" + data.website);
  }

  function SupplierinfoDetails(data) {

    $("#supplierinfodetails").empty();
    $(".table-infodetails tbody").append(
      '<tr>' +
      '<th>Opening Balance</th>' +
      '<td>' + data.openingbalance + '</td>' +
      '</tr>' +
      '<tr>' +
      '<th>Consignment</th>' +
      '<td>' + data.consignment + '</td>' +
      '</tr>' +
      '<tr>' +
      '<th>Discount</th>' +
      '<td>' + data.discount + '</td>' +
      '</tr>' +
      '<tr>' +
      '<th>Payment</th>' +
      '<td>' + data.payment + '</td>' +
      '</tr>' +
      '<tr>' +
      '<th>Balance Due</th>' +
      '<td>' + data.balancedue + '</td>' +
      '</tr>'
    );
  }

  /*   data.category_name.forEach(function(value) {
          value.cate_name.title
          //console.log(value.cate_name.title)
        }) */

  function supplierDocument(data) {
    //console.log(data)
    $("#tabledocument").empty();
    var sl = 1;
    data.forEach(function(value) {
      var imagesrc = "{{ asset('storage/supplier/SupplierDoucument/') }}/" + value.image;
      
      $(".data-table-document tbody").append("<tr>" +
        "<td>" + sl + "</td>" +
        "<td>" + value.type + "</td>" +
        "<td><p class='text-justify'>" + value.remark + "</p></td>" +
        "<td><img src=" + imagesrc + " width='100px' height='100px'></td>" +
        "<td>" +
        '<div class="btn-group" role="group" aria-label="Basic example">' +
        '<a type="button" id="datashowcash" class="btn btn-danger btn-sm" data-id="' + value.id + '">Delete</a>' +
        '</div>' +
        "</td>" +
        "</tr>");
      sl++;
    })
  }
  window.onload = SupplierDataList();

  //purchase History


  function DataTablePurchase() {
    var purchaseTable = $('#purchasetable').DataTable({
      responsive: true,
      paging: true,
      scrollY: 400,
      scrollX: 800,
      scrollCollapse: false,
      ordering: true,
      searching: true,
      select: true,
      autoFill: true,
      colReorder: true,
      keys: true,
      processing: true,
      serverSide: true,
      footerCallback: function() {
        var sum = 0;
        var column = 0;
        this.api().columns('3,4,5,6,7', {
          page: 'current'
        }).every(function() {
          column = this;
          sum = column
            .data()
            .reduce(function(a, b) {
              a = parseFloat(a, 10);
              if (isNaN(a)) {
                a = 0;
              }
              b = parseFloat(b, 10);
              if (isNaN(b)) {
                b = 0;
              }
              return (a + b).toFixed(2);
            }, 0);
          /* if (!sum.includes('tk'))
            sum += ' &euro;'; */
          $(column.footer()).html(sum);

        });
      },
      dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: [{

          text: '<i class="fa fa-refresh"></i>Refresh',
          action: function() {
            table.ajax.reload();
          },
          className: 'btn btn-info',
        },
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel-o"></i>Excel',
          className: 'btn btn-success',
          exportOptions: {
            columns: [0, 2, 3, 4, 5, 6, 7]
          },
          footer: true,
        },
        {
          text: '<i class="fa fa-file-pdf-o"></i>PDF',
          extend: 'pdf',
          className: 'btn btn-light',
          orientation: 'portrait', //portrait',
          pageSize: 'A4',
          title: 'Supplier List',
          filename: 'supplierlist',
          className: 'btn btn-danger',
          exportOptions: {
            columns: [0, 2, 3, 4, 5, 6, 7]
          },
          footer: true,
          customize: function(doc) {

            var tblBody = doc.content[1].table.body;
            doc.content[1].layout = {
              hLineWidth: function(i, node) {
                return (i === 0 || i === node.table.body.length) ? 2 : 1;
              },
              vLineWidth: function(i, node) {
                return (i === 0 || i === node.table.widths.length) ? 2 : 1;
              },
              hLineColor: function(i, node) {
                return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';
              },
              vLineColor: function(i, node) {
                return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';
              }
            };
            $('#gridID').find('tr').each(function(ix, row) {
              var index = ix;
              var rowElt = row;
              $(row).find('td').each(function(ind, elt) {
                tblBody[index][ind].border
                if (tblBody[index][1].text == '' && tblBody[index][2].text == '') {
                  delete tblBody[index][ind].style;
                  tblBody[index][ind].fillColor = '#FFF9C4';
                } else {
                  if (tblBody[index][2].text == '') {
                    delete tblBody[index][ind].style;
                    tblBody[index][ind].fillColor = '#FFFDE7';
                  }
                }
              });
            });
          }

        },
        {
          extend: 'print',
          text: '<i class="fa fa-print"></i>Print',
          className: 'btn btn-dark',
          exportOptions: {
            columns: [0, 2, 3, 4, 5, 6, 7]
          },
          footer: true,
        },

      ],
      "ajax": {
        "url": "{{url('Purchase/getlistsupplier')}}?supplierid=" + supplierid,
        "type": "GET",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: "text-center"
        },
        {
          data: 'purchasecode',
          name: 'purchasecode',
          className: "text-center"
        },
        {
          data: 'inputdate',
          name: 'inputdate',
          className: "text-center"
        },
        {
          data: 'amount',
          name: 'amount',
          className: "text-right"

        },
        {
          data: 'discount',
          name: 'discount',
          className: "text-right"

        },
        {
          data: 'vat',
          name: 'vat',
          className: "text-right"

        },
        {
          data: 'nettotal',
          name: 'nettotal',
          className: "text-right"
        },
        {
          data: 'status',
          name: 'status',
          orderable: false,
        },
        {
          data: 'user_id',
          name: 'user_id',
          orderable: false,
        },

        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        }
      ],
    });

  }
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .responsive.recalc();
  });
  $(document).on('click', '#datashow', function() {
    var id = $(this).data("id");
    url = "{{ url('Purchase/show')}}" + '/' + id,
      window.location = url;

  });

  function DataTablesPayment() {
    tablepayment = $('#supplierpaymenttable').DataTable({
      responsive: true,
      paging: true,
      scrollY: 400,
      ordering: true,
      searching: true,
      select: true,
      autoFill: true,
      colReorder: true,
      keys: true,
      processing: true,
      serverSide: true,
      footerCallback: function() {
        var sum = 0;
        var column = 0;
        this.api().columns('5', {
          page: 'current'
        }).every(function() {
          column = this;
          sum = column
            .data()
            .reduce(function(a, b) {
              a = parseFloat(a, 10);
              if (isNaN(a)) {
                a = 0;
              }
              b = parseFloat(b, 10);
              if (isNaN(b)) {
                b = 0;
              }
              return (a + b).toFixed(2);
            }, 0);

          $(column.footer()).html(sum);

        });
      },
      dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: [{

          text: '<i class="fa fa-refresh"></i>Refresh',
          action: function() {
            tablepayment.ajax.reload();
          },
          className: 'btn btn-info',
        },
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel-o"></i>Excel',
          className: 'btn btn-success',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6]
          },
          footer: true,
        },
        {
          text: '<i class="fa fa-file-pdf-o"></i>PDF',
          extend: 'pdf',
          className: 'btn btn-light',
          orientation: 'portrait', //portrait',
          pageSize: 'A4',
          title: 'Supplier Payment List',
          filename: 'supplierpayment',
          className: 'btn btn-danger',

          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6]
          },
          footer: true,
          customize: function(doc) {

            var tblBody = doc.content[1].table.body;
            doc.content[1].layout = {
              hLineWidth: function(i, node) {
                return (i === 0 || i === node.table.body.length) ? 2 : 1;
              },
              vLineWidth: function(i, node) {
                return (i === 0 || i === node.table.widths.length) ? 2 : 1;
              },
              hLineColor: function(i, node) {
                return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';
              },
              vLineColor: function(i, node) {
                return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';
              }
            };
            $('#gridID').find('tr').each(function(ix, row) {
              var index = ix;
              var rowElt = row;
              $(row).find('td').each(function(ind, elt) {
                tblBody[index][ind].border
                if (tblBody[index][1].text == '' && tblBody[index][2].text == '') {
                  delete tblBody[index][ind].style;
                  tblBody[index][ind].fillColor = '#FFF9C4';
                } else {
                  if (tblBody[index][2].text == '') {
                    delete tblBody[index][ind].style;
                    tblBody[index][ind].fillColor = '#FFFDE7';
                  }
                }
              });
            });
          }

        },
        {
          extend: 'print',
          text: '<i class="fa fa-print"></i>Print',
          className: 'btn btn-dark',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6]
          },
          footer: true,
        },

      ],
      "ajax": {
        "url": "{{ route('supplierpayment.getlistsupplier') }}",
        "data": {
          supplier_id: supplierid
        },
        "type": "GET",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: "text-center"
        },
        {
          data: 'payment_no',
          name: 'payment_no',
          className: "text-center"
        },
        {
          data: 'inputdate',
          name: 'inputdate',
          className: "text-center"
        },
        {
          data: 'amount',
          name: 'amount',
          className: "text-right"

        },
        {
          data: 'payment',
          name: 'payment',
          className: "text-right"

        },
        {
          data: 'balancedue',
          name: 'balancedue',
          className: "text-right"

        },
        {
          data: 'paymenttype',
          name: 'paymenttype',
          className: "text-center"
        },
        {
          data: 'user',
          name: 'user',
          orderable: false,
        },


      ],
    });
  }

  $imgSrc = $('#imgProfile').attr('src');

  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#imgProfile').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
  $('#btnChangePicture').on('click', function() {
    // document.getElementById('profilePicture').click();
    if (!$('#btnChangePicture').hasClass('changing')) {
      $('#profilePicture').click();
    } else {
      var name = document.getElementById("profilePicture").files[0].name;
      var form_data = new FormData();
      var ext = name.split('.').pop().toLowerCase();
      if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        alert("Invalid Image File");
      }
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("profilePicture").files[0]);
      var f = document.getElementById("profilePicture").files[0];
      var fsize = f.size || f.fileSize;
      if (fsize > 2000000) {
        alert("Image File Size is very big");
      } else {

        form_data.append("file", document.getElementById('profilePicture').files[0]);
        form_data.append("id", supplierid);

        $.ajax({
          type: 'post',
          url: "{{ url('Supplier/ImageChange')}}",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            location.reload(true);
            // console.log(data)
          },
          error: function(data) {
            console.log(data)
          }
        });
      }
    }
  });
  $('#profilePicture').on('change', function() {
    readURL(this);
    $('#btnChangePicture').addClass('changing');
    $('#btnChangePicture').attr('value', 'Confirm');
    $('#btnDiscard').removeClass('d-none');
    // $('#imgProfile').attr('src', '');
  });
  $('#btnDiscard').on('click', function() {
    // if ($('#btnDiscard').hasClass('d-none')) {
    $('#btnChangePicture').removeClass('changing');
    $('#btnChangePicture').attr('value', 'Change');
    $('#btnDiscard').addClass('d-none');
    $('#imgProfile').attr('src', $imgSrc);
    $('#profilePicture').val('');
    // }
  });
</script>