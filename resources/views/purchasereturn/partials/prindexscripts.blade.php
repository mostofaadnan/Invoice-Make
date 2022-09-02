<script>
  var table;
  function DataTable() {
    var fromdate = $("#min").val();
    var todate = $("#max").val();
    table = $('#mytable').DataTable({
      responsive:true,
      paging: true,
      scrollY: 400,
      ordering: true,
      searching: true,
      colReorder: true,
      keys: true,
      processing: true,
      serverSide: true,
      footerCallback: function() {
        var sum = 0;
        var column = 0;
        this.api().columns('5,6,7,8', {
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
          /* if (!sum.includes('€'))
            sum += ' &euro;'; */
          $(column.footer()).html(sum);

        });
      },
      dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: [{

          text: '<i class="fa fa-refresh"></i>@lang("home.refresh")',
          action: function() {
            $("#min").val("");
            $("#max").val("");
            table.destroy();
            DataTable();
            //table.ajax.reload();
          },
          className: 'btn btn-info',
        },
        {
          extend: 'copy',
          className: 'btn btn-secondary',
          text: '<i class="fa fa-files-o"></i>@lang("home.export")',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
          }
        },
        {
          extend: 'csv',
          text: '<i class="fa fa-file-text-o"></i>@lang("home.csv")',
          className: 'btn btn-info',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
          }
        },
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel-o"></i>@lang("home.excel")',
          className: 'btn btn-success',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
          },
          footer: true,
        },
        {

          text: '<i class="fa fa-file-pdf-o"></i>@lang("home.pdf")',
          extend: 'pdf',
          className: 'btn btn-light',
          orientation: 'portrait', //portrait',
          pageSize: 'A4',
          title: 'Purchase Reurn List',
          filename: 'purchasereturnlist',
          className: 'btn btn-danger',

          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
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
          text: '<i class="fa fa-print"></i>@lang("home.print")',
          className: 'btn btn-dark',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
          },
          footer: true,
        },

      ],
      "ajax": {
        "url": "{{ route('purchasereturn.loadall') }}",
        "data": {
          fromdate: fromdate,
          todate: todate
        },
        "type": "GET",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: "text-center"
        },
        {
          data: 'return_code',
          name: 'return_code',
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
          data: 'supplier',
          name: 'supplier',
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
          data: 'user',
          name: 'user',
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
    $('.dataTables_length').addClass('bs-select');
  }
  $("#submitdate").on('click', function() {
    if ($("#max").val() == "" || $("#min").val() == ""){
      swal("Opps! Faild", "Please Select Between Date", "error");
    } else {
      table.destroy();
      DataTable();
    }

  });
  //setInterval("$('#mytable').DataTable().ajax.reload()", 10000);
  window.onload = DataTable();

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
    })
  }

  function currenDateData() {
    var value = $("#dateinput").val();
    readAllData(value);
  }
  $(document).on('keyup', "#dateinput", function() {
    var value = $("#dateinput").val();
    readAllData(value);
  });
  $('#datepicker').datepicker().on('changeDate', function(ev) {
    var value = $("#dateinput").val();
    readAllData(value);
  });

  function readAllData(value) {
    $.ajax({
      type: 'get',
      url: "{{ route('purchase.getlist') }}",
      data: {
        value: value
      },
      "dataSrc": "tableData",
      success: function(data) {
        if (data) {
          LoadTableData(data);
        }
      },
      error: function(data) {
        console.log(data)
      }
    });
  }
  $(document).on('keyup', "#dateinput2", function() {
    Datebetween();
  });
  $('#datepicker2').datepicker().on('changeDate', function(ev) {
    Datebetween();
  });


  function LoadAll() {
    var url = "{{ route('purchase.loadall') }}";
    $.get(url, function(data) {
      //LoadTableData(data);

    })
  }
  $(document).on('click', "#loadall", function() {
    $('#mytable').DataTable().ajax.reload()
  });
  window.onload = LoadAll();

  function Datebetween() {
    var start_date = $("#dateinput").val();
    var end_date = $("#dateinput2").val();
    //console.log(isValidDate(end_date));
    if (start_date == "" || end_date == "") {} else {
      $.ajax({
        type: 'GET',
        url: "{{ route('purchase.datebetween') }}",
        data: {
          start_date: start_date,
          end_date: end_date,
        },
        "dataSrc": "tableData",
        success: function(data) {
          LoadTableData(data)
        },
        error: function(data) {
          console.log(data)
        }
      })
    }

  }

  function isValidDate(s) {
    var bits = s.split('/');
    var d = new Date(bits[0] + '/' + bits[1] + '/' + bits[2]);
    return !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));
    /*  return !!(d.getDate() == Number(bits[0]) && (d.getMonth() + 1) == bits[1] &&  d); */
  }

  function LoadTableData(data) {
    /*   $(".data-table  tbody").empty();
    var sl = 1;
    data.forEach(function(value) {
      var message = (value.status == 0 ? " Deactive " : " Active ");
      $(".data-table  tbody").append("<tr  class=" + 'item' + value.id + ">" +
        "<td  class='text-center'>" + sl + "</td>" +
        "<td>" + value.purchasecode + "</td>" +
        "<td class='itemname'>" + value.supplier_name['name'] + "</td>" +
        "<td>" + value.inputdate + "</td>" +
        "<td class='amount' align='right'>" + value.amount + "</td>" +
        "<td class='totaldiscount' align='right'>" + value.discount + "</td>" +
        "<td class='vat' align='right'>" + value.vat + "</td>" +
        "<td class='nettotal' align='right'>" + value.nettotal + "</td>" +
        "<td>" + message + "</td>" +
        "<td>" + value.user_id + "</td>" +
        "<td>" +
        '<div class="btn-group" role="group" aria-label="Basic example">' +
        '<a type="button" id="datashow" class="btn btn-outline-info" data-id="' + value.id + '"> View</a>' +
        '<a type="button" id="dataedit" class="btn btn-outline-primary" data-id="' + value.id + '">Edit</a>' +
        '<a type="button" class="btn btn-outline-danger" id="deletedata" data-id="' + value.id + '">Delete</a>' +
        '</div>' +
        "</td>" +
        "</tr>");

      sl++;
    })
    TablelSummation();
 */
  }


  /*  function netamount() {
    $('#example').DataTable( {
     drawCallback: function () {
       var api = this.api();
       $( api.table().footer() ).html(
         api.column( 4, {page:'current'} ).data().sum()
       );
     }
   } );
   }
   window.onload = netamount(); */

  function totaldiscount() {
    var sum = 0;
    $(".totaldiscount").each(function() {
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

  function TablelSummation() {
    netamount();
    totaldiscount();
    totalvat();
    Nettotal();
  }
  $(document).on('click', '#datashow', function() {
    var id = $(this).data("id");
    url = "{{ url('Purchase-Return/show')}}" + '/' + id,
      window.location = url;
  });
  //edit
  $(document).on('click', '#dataedit', function() {
    var id = $(this).data("id");
    url = "{{ url('Purchase-Return/edit')}}" + '/' + id,
      window.location = url;
  });

  $(document).on('click', "#deletedata", function() {

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
            url: "{{ url('Purchase-Return/delete')}}" + '/' + id,
            success: function() {
              table.ajax.reload()
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
  //pdf data
  $(document).on('click', '#pdfdata', function() {
    var id = $(this).data("id");
    url = "{{ url('Purchase-Return/purchasereturnpdf')}}" + '/' + id,
      window.open(url, '_blank');

  });
  //supplier text search
  $("#suppliersearch").on('input', function() {
    var val = this.value;
    if (val == "") {
      readAllData();
    } else {

      if ($('#supplier option').filter(function() {
          return this.value.toUpperCase() === val.toUpperCase();
        }).length) {
        var dataid = $('#supplier').find('option[value="' + val + '"]').attr('id');

        $.ajax({
          type: 'post',
          url: "{{ route('purchase.getsupplierbyid') }}",
          //data: data,
          data: {
            dataid: dataid,
          },
          datatype: 'JSON',
          success: function(data) {
            LoadTableData(data);
          },
          error: function(data) {
            //console.log(data);
          }
        });

      }
    }

  });
</script>