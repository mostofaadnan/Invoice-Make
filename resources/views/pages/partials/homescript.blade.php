<script>
  var type = 1;
  var data;


  $(".btn-group > .btn").click(function() {
    $(".btn-group > .btn").removeClass("active");
    $(this).addClass("active");
  });

  function GetData() {
    if ($("#today").on('click')) {
      type = 1;
    } else if ($("#sevenday").on('click')) {
      type = 2;
    } else if ($("#thismonth").on('click')) {
      type = 3;
    } else if ($("#thisyear").on('click')) {
      type = 4;
    }

  }
  $("#today").on('click', function() {
    type = 1;
    accountSummerise();

    console.log(type)
  })
  $("#sevenday").on('click', function() {
    type = 2;
    accountSummerise();
    console.log(type)
  })
  $("#thismonth").on('click', function() {
    type = 3;
    accountSummerise();
    console.log(type)
  })
  $("#thisyear").on('click', function() {
    type = 4;
    accountSummerise();
    console.log(type)
  })

  function accountSummerise() {
    $.ajax({
      type: 'get',
      data: {
        type: type
      },
      url: "{{ route('accountsummery') }}",
      datatype: 'JSON',
      success: function(data) {
       
        $("#invoice").html(parseFloat(data.invoice).toFixed(2))
        $("#purchase").html(parseFloat(data.purchase).toFixed(2))
        $("#ppayment").html(parseFloat(data.SupplierPayment).toFixed(2))
        $("#cpayment").html(parseFloat(data.CustomerRecieved).toFixed(2))
        $("#cdrawer").html(parseFloat(data.balance).toFixed(2))
        $("#expencess").html(parseFloat(data.Expenses).toFixed(2))
      },
      error: function(data) {
        console.log(data);
      }
    });
  }

  function TableDetails() {
    CashInvoice();
    CreditInvoice();
    purchase();
    SupplierPayment();
    CreditRecieve();
    Expenses();
  
  }
  $("#loadall").on('click', function() {
    tabledataone.reload();
  });

  function CashInvoice() {
    var tabledataone = $('#cinvoice').DataTable({
      paging: true,
      scrollX: true,
      scrollY: 200,
      ordering: true,
      searching: true,
      select: true,
      autoFill: true,
      colReorder: true,
      keys: true,
      processing: true,
      serverSide: true,
      iDisplayLength: 10,
      footerCallback: function() {
        var sum = 0;
        var column = 0;
        this.api().columns('4', {
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


      "ajax": {
        "url": "{{ route('invoice.loadall') }}",
        "type": "GET",
      },

      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: "text-center"
        },
        {
          data: 'invoice_no',
          name: 'invoice_no',
          className: "text-center"
        },
        {
          data: 'inputdate',
          name: 'inputdate',
          className: "text-center"
        },
        {
          data: 'customer',
          name: 'customer',
        },
        {
          data: 'nettotal',
          name: 'nettotal',
          className: "text-right"
        },
      ],

    });
  }

  function CreditInvoice() {
    var tabledata = $('#creditinv').DataTable({
      paging: true,
      scrollX: true,
      scrollY: 200,
      ordering: true,
      searching: true,
      select: true,
      autoFill: true,
      colReorder: true,
      keys: true,
      processing: true,
      serverSide: true,
      iDisplayLength: 10,
      footerCallback: function() {
        var sum = 0;
        var column = 0;
        this.api().columns('4', {
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


      "ajax": {
        "url": "{{ route('creditinvoice.loadall') }}",
        "type": "GET",
      },

      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: "text-center"
        },
        {
          data: 'invoice_no',
          name: 'invoice_no',
          className: "text-center"
        },
        {
          data: 'inputdate',
          name: 'inputdate',
          className: "text-center"
        },
        {
          data: 'customer',
          name: 'customer',
        },
        {
          data: 'nettotal',
          name: 'nettotal',
          className: "text-right"
        },
      ],

    });
  }

  function purchase() {
    var tabledata = $('#purchasetbl').DataTable({
      paging: true,
      scrollY: 200,
      scrollCollapse: true,
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
        this.api().columns('4', {
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

      "ajax": {
        "url": "{{ route('purchase.loadall') }}",
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
          data: 'supplier',
          name: 'supplier',


        },
        {
          data: 'inputdate',
          name: 'inputdate',
          className: "text-center"
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
      ],
    });
    $('.dataTables_length').addClass('bs-select');
  }

  function SupplierPayment() {
    var tabledata = $('#purchasepaymenttbl').DataTable({
      paging: true,
      scrollY: 200,
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
        this.api().columns('4', {
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

      "ajax": {
        "url": "{{ route('supplierpayment.loadall') }}",
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
          data: 'supplier',
          name: 'supplier',
        },
        {
          data: 'payment',
          name: 'payment',
          className: "text-right"

        }

      ],
    });
  }

  function CreditRecieve() {
    var tabledata = $('#creditrecieve').DataTable({
      paging: true,
      scrollY: 200,
      ordering: true,
      searching: true,
      select: true,
      autoFill: true,
      colReorder: true,
      keys: true,
      fixedHeader: false,
      processing: true,
      serverSide: true,
      footerCallback: function() {
        var sum = 0;
        var column = 0;
        this.api().columns('4', {
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

      "ajax": {
        "url": "{{ route('customerpayment.loadall') }}",
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
          data: 'customer',
          name: 'customer',
        },


        {
          data: 'recieve',
          name: 'recieve',
          className: "text-right"

        },
      ],
    });
  }

  function Expenses() {
    var tabledata = $('#expensesstbl').DataTable({
      paging: true,
      scrollY: 200,
      scrollCollapse: true,
      ordering: true,
      searching: true,
      select: true,
      autoFill: true,
      colReorder: true,
      keys: true,
      processing: true,
      serverSide: true,
      /*  footerCallback: function() {
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

           $(column.footer()).html('<b style="color:red">' + sum + '</b>');

         });
       }, */

      "ajax": {
        "url": "{{ route('expenses.loadall') }}",
        "type": "GET",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: "text-center"
        },
        {
          data: 'expenses_no',
          name: 'expenses_no',
          className: "text-center"
        },
        {
          data: 'inputdate',
          name: 'inputdate',
          className: "text-center"
        },
        {
          data: 'Exp_Title',
          name: 'Exp_Title',

        },
        {
          data: 'exptype',
          name: 'exptype',

        },
        {
          data: 'amount',
          name: 'amount',
          className: "text-right"

        },

      ],
    });
    $('.dataTables_length').addClass('bs-select');
  }
  window.onload = accountSummerise();
  window.onload = TableDetails();
</script>