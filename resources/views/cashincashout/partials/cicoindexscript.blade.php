<script>
  var table;
  //Retrive Data
  function DataTable() {

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
      iDisplayLength: 50,
      footerCallback: function() {
        var sum = 0;
        var column = 0;
        this.api().columns('5,6', {
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

          $(column.footer()).html('<b style="color:red;" class="text-right">' + sum + '</b>');

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
           /*  table.destroy();
            DataTable(); */
            table.ajax.reload();
          },
          className: 'btn btn-info',
        },
        {
          extend: 'collection',
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
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
            modifier: {
              page: 'all',
              search: 'none'
            }
          },

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
          /*  extend: 'pdf', */

          text: '<i class="fa fa-file-pdf-o"></i>@lang("home.pdf")',
          extend: 'pdf',
          className: 'btn btn-light',
          orientation: 'portrait', //portrait',
          pageSize: 'A4',
          title: 'Cash In/Cash Out List',
          filename: 'invoice',
          className: 'btn btn-danger',
          //download: 'open',
          exportOptions: {
            /* modifer: {
              page: 'all',
            }, */
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
            modifier: {
              page: 'all',
              search: 'none'
            }
          },
          footer: true,
          customize: function(doc) {
            doc.styles.title = {
              color: 'red',
              fontSize: '20',
              // background: 'blue',
              alignment: 'center'
            }
          }
        },
        {
          extend: 'print',
          text: '<i class="fa fa-print"></i>@lang("home.print")',
          className: 'btn btn-dark',
          title: 'Cash In/Cash Out List',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7]
          },
          footer: true,
        },


      ],
      "ajax": {
        "url": "{{ route('cashincashout.loadall') }}",
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
          data: 'type',
          name: 'type',


        },
        {
          data: 'source',
          name: 'source',


        },
        {
          data: 'cashin',
          name: 'cashin',
          className: "text-right"

        },
        {
          data: 'cashout',
          name: 'cashout',
          className: "text-right"
        },
        {
          data: 'payment_description',
          name: 'payment_description',

        },
        {
          data: 'remark',
          name: 'remark',

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
  window.onload = DataTable();
  $(document).on('click', "#datashow", function() {
    var dataid = $(this).data("id");
    url = "{{ url('CashInCashOut/show')}}" + '/' + dataid,
      window.location = url;
  });
  $(document).on('click', "#pdf", function() {
    var dataid = $(this).data("id");
    url = "{{ url('CashInCashOut/pdf')}}" + '/' + dataid,
      window.open(url, '_blank');
  });
  $(document).on('click', '#datadelete', function() {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this  data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var dataid = $(this).data("id");
          $.ajax({
            type: "post",
            url: "{{ url('CashInCashOut/delete')}}" + '/' + dataid,
            success: function(data) {
              table.ajax.reload();
            },
            error: function() {
              swal("Opps! Faild", "Form Submited Faild", "error");
            }
          });
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
  });

</script>