@extends('layouts.master')
@section('content')

<div class="card">
  <div class="card-header card-header-section">
    <div class="pull-left">
      @lang('home.employee') @lang('home.management')
    </div>
    <div class="pull-right">
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
          <a type="button" class="btn btn-outline-danger" href="{{Route('employees.create')}}"><i class="fa fa-plus" aria-hidden="true">@lang('home.new') @lang('home.employee')</i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    @include('partials.ErrorMessage')
    <table id="mytable" class="table table-bordered display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th> #@lang('home.sl') </th>
          <th> @lang('home.id') </th>
          <th> @lang('home.name') </th>
          <th> @lang('home.mobile') @lang('home.number') </th>
          <th> @lang('home.joining') <br>@lang('home.date') </th>
          <th> @lang('home.job') @lang('home.type') </th>
          <th> @lang('home.designation') </th>
          <th> @lang('home.salary') @lang('home.basis')</th>
          <th> @lang('home.salary')</th>
          <th> @lang('home.status')</th>
          <th> @lang('home.action')</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th> #@lang('home.sl') </th>
          <th> @lang('home.id') </th>
          <th> @lang('home.name') </th>
          <th> @lang('home.mobile') @lang('home.number') </th>
          <th> @lang('home.joining') <br>@lang('home.date') </th>
          <th> @lang('home.job') @lang('home.type') </th>
          <th> @lang('home.designation') </th>
          <th> @lang('home.salary') @lang('home.basis')</th>
          <th> @lang('home.salary')</th>
          <th> @lang('home.status')</th>
          <th> @lang('home.action')</th>
        </tr>
      </tfoot>
    </table>

  </div>
</div>
<script>
  var table;

  function DataTable() {
    table = $('#mytable').DataTable({
      paging: true,
      scrollY: 400,
      scrollCollapse: false,
      ordering: true,
      searching: true,
      select: false,
      colReorder: true,
      keys: true,
      processing: true,
      serverSide: true,
      fixedHeader: false,
      "initComplete": function(settings, json) {
        table.columns.adjust().draw();
      },
      dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: [{

          text: '<i class="fa fa-refresh"></i>@lang("home.refresh")',
          action: function() {
            table.ajax.reload();
          },
          className: 'btn btn-info',
        },
        {
          extend: 'copy',
          className: 'btn btn-secondary',
          text: '<i class="fa fa-files-o"></i>@lang("home.export")',
          exportOptions: {
            columns: [0, 2, 3, 4, 5, 6, 7, 8],
            "page": 'all'
          }
        },
        {
          extend: 'csv',
          text: '<i class="fa fa-file-text-o"></i>@lang("home.csv")',
          className: 'btn btn-info',
          exportOptions: {
            columns: [0, 2, 3, 4, 5, 6, 7, 8],
            "page": 'all'
          }
        },
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel-o"></i>@lang("home.excel")',
          className: 'btn btn-success',
          exportOptions: {
            columns: [0, 2, 3, 4, 5, 6, 7, 8],
            "page": 'all'
          },
          footer: true,
        },
        {
          text: '<i class="fa fa-file-pdf-o"></i>@lang("home.pdf")',
          extend: 'pdf',
          className: 'btn btn-light',
          orientation: 'portrait', //portrait',
          pageSize: 'A4',
          title: 'Supplier List',
          filename: 'supplierlist',
          className: 'btn btn-danger',
          exportOptions: {
            columns: [0, 2, 3, 4, 5, 6, 7, 8],
            "page": 'all'
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
            columns: [0, 2, 3, 4, 5, 6, 7, 8],
            page: 'all'
          },
          footer: true,
        },

      ],
      "ajax": {
        "url": "{{ route('employees.loadall') }}",
        "type": "GET",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: "text-center"
        },
        {
          data: 'employer_id',
          name: 'employer_id',
          className: "text-center"
        },
        {
          data: 'name',
          name: 'name',
        },
        {
          data: 'mobile_no',
          name: 'mobile_no',


        },
        {
          data: 'joining_date',
          name: 'joining_date',
        },
        {
          data: 'job_type',
          name: 'job_type',
        },
        {
          data: 'designation',
          name: 'designation',

        },
        {
          data: 'salary_basis',
          name: 'salary_basis',

        },
        {
          data: 'salary',
          name: 'salary',
          className: "text-right"
        },
        {
          data: 'status',
          name: 'status',
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
  window.onload = DataTable();
  //data show
  $(document).on('click', "#datashow", function() {
    var dataid = $(this).data("id");
    url = "{{ url('Employee/profile')}}" + '/' + dataid,
      window.location = url;
  });
  //data edit
  $(document).on('click', "#dataedit", function() {
    var dataid = $(this).data("id");
    url = "{{ url('Employee/edit')}}" + '/' + dataid,
      window.location = url;
  });
  //Balance Upload
  $(document).on('click', "#openingbalance", function() {
    var dataid = $(this).data("id");
    url = "{{ url('Supplier/openingbalance')}}" + '/' + dataid,
      window.location = url;
  });
  //document upload
  $(document).on('click', "#documentup", function() {
    var dataid = $(this).data("id");
    url = "{{ url('Supplier/document')}}" + '/' + dataid,
      window.location = url;
  });
  // data Delete
  $(document).on('click', '#deletedata', function() {
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
            url: "{{ url('Employee/delete')}}" + '/' + dataid,
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

  $(document).on("click", "#active", function(event) {
    var dataid = $(this).data("id");
    $.ajax({
      type: "post",
      url: "{{ url('Supplier/Active')}}" + '/' + dataid,
      data: {
        id: dataid,
      },
      datatype: ("json"),
      success: function() {
        readAllData();
      },
      error: function() {
        swal("Opps! Faild", "Form Submited Faild", "error");

      }

    });



  });
  $(document).on("click", "#inactive", function(event) {
    var dataid = $(this).data("id");
    $.ajax({
      type: "post",
      url: "{{ url('Supplier/Inactive')}}" + '/' + dataid,
      data: {
        id: dataid,
      },
      datatype: ("json"),
      success: function() {
        readAllData();
      },
      error: function() {
        swal("Opps! Faild", "Form Submited Faild", "error");

      }

    });
  });
  $('#search').on('keyup', function() {
    var value = $("#search").val();

    $.ajax({
      url: "{{ route('supplier.search') }}",
      type: 'get',
      data: {
        'search': value
      },
      success: function(data) {
        LoadTableData(data);
      }

    })


  });
</script>
@endsection