<script type="text/javascript">
  var table;

  function DataTable() {
    var fromdate = $("#min").val();
    var todate = $("#max").val();
    table = $('#mytable').DataTable({
      responsive: true,
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
        this.api().columns('6', {
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
      dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: [{

          text: '<i class="fa fa-refresh"></i>Refresh',
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
          text: '<i class="fa fa-files-o"></i>Data Export',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6]
          }
        },
        {
          extend: 'csv',
          text: '<i class="fa fa-file-text-o"></i>CSV',
          className: 'btn btn-info',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6]
          }
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
          title: 'GRN(Goods Recieved List)',
          filename: 'grnlist',
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
        "data": {
          fromdate: fromdate,
          todate: todate
        },
        "url": "{{ route('precieve.loadall') }}",
        "type": "GET",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: "text-center"
        },
        {
          data: 'purchaseRecievdNo',
          name: 'purchaseRecievdNo',
          className: "text-center"
        },
        {
          data: 'purchasecode',
          name: 'purchasecode',
          className: "text-center"
        },
        {
          data: 'purchasedate',
          name: 'purchasedate',
          className: "text-center"
        },
        {
          data: 'inputdate',
          name: 'inputdate',
          className: "text-center"
        },

        {
          data: 'supplier',
          name: 'supplier'
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
  }
  $("#submitdate").on('click', function() {
    if ($("#max").val() == "" || $("#min").val() == "") {
      swal("Opps! Faild", "Please Select Between Date", "error");
    } else {
      table.destroy();
      DataTable();
    }

  });

  window.onload = DataTable();

  $(document).on('keyup', "#dateinput2", function() {
    Datebetween();
  });
  $('#datepicker2').datepicker().on('changeDate', function(ev) {
    Datebetween();
  });

  $(document).on('click', '#datashow', function() {
    var id = $(this).data("id");
    url = "{{ url('PurchaseRecieved/show')}}" + '/' + id,
      window.location = url;
  });
  $(document).on('click', '#datapdf', function() {
    var dataid = $(this).data('id');
    url = "{{ url('PurchaseRecieved/pdf')}}" + '/' + dataid,
      window.open(url, '_blank');
  });
  $(document).on('click', '#print', function() {
    var dataid = $(this).data('id');
    url = "{{ url('PurchaseRecieved/LoadPrintslip')}}" + '/' + dataid,
      window.open(url, '_blank');
  });
  $(document).on('click', '#mail', function() {
    var id = $(this).data("id");
    url = "{{ url('PurchaseRecieved/sendmail')}}" + '/' + id,
      window.location = url;
  });
  //delete Data
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
            url: "{{ url('PurchaseRecieved/delete')}}" + '/' + id,
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
</script>