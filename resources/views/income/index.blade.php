@extends('layouts.master')
@section('content')

<div class="card">
    <style .input-group-text{width:auto;}></style>
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.sector') @lang('home.expenditure')
        </div>
    </div>
    <div class="card-body">
        @include('partials.ErrorMessage')
        <table class="table table-bordered" id="mytable" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.description') </th>
                    <th> @lang('home.number') </th>
                    <th> @lang('home.amount') </th>
                    <th> @lang('home.action') </th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.description') </th>
                    <th> @lang('home.number') </th>
                    <th class="text-right"> @lang('home.amount') </th>
                    <th> @lang('home.action') </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    var tabledata;

    function DataTable() {
        tabledata = $('#mytable').DataTable({
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

                    $(column.footer()).html('<b style="color:red">' + sum + '</b>');

                });
            },
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{

                    text: '<i class="fa fa-refresh"></i>@lang("home.refresh")',
                    action: function() {
                        tabledata.ajax.reload();
                    },
                    className: 'btn btn-info',
                },

                {
                    extend: 'copy',
                    className: 'btn btn-secondary',
                    text: '<i class="fa fa-files-o"></i>@lang("home.export")',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'csv',
                    extend: 'csv',
                    text: '<i class="fa fa-file-text-o"></i>@lang("home.csv")',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i>@lang("home.excel")',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    footer: true,
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>@lang("home.pdf")',
                    extend: 'pdfHtml5',
                    className: 'btn btn-light',
                    orientation: 'portrait', //portrait',
                    pageSize: 'A4',
                    title: 'Sector Expenditure',
                    filename: 'expenses',
                    className: 'btn btn-danger',

                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    footer: true,
                    customize: function(doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    },

                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>@lang("home.print")',
                    className: 'btn btn-dark',
                    title: 'Sector Expenditure',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                    footer: true,
                },

            ],
            "ajax": {
                "url": "{{ route('income.loadall') }}",
                "type": "GET",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: "text-center"
                },
                {
                    data: 'inputdate',
                    name: 'inputdate',
                    className: "text-center"

                },
                {
                    data: 'source',
                    name: 'source',

                },

                {
                    data: 'number',
                    name: 'number',


                },
                {
                    data: 'amount',
                    name: 'amount',
                    className: "text-right"

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
            ],
        });

    }
    window.onload = DataTable();

    $(document).on('click', '#datashow', function() {
    var id = $(this).data("id");
    var type = $(this).data("type");
    //url = "{{ url('Purchase/show')}}" + '/' + id
    console.log(type);
    switch (type) {
      case 'Cash Invoice':
        url = "{{ url('Invoice/show')}}" + '/' + id,
          window.location = url;
        break;
        case 'Credit Invoice':
        url = "{{ url('Credit-Invoice/show')}}" + '/' + id,
          window.location = url;
        break;
      case 'Credit Payment':
        url = "{{ url('CustomerPayment/show')}}" + '/' + id,
          window.location = url;
        break;
        break;
      default:
    }
    // window.location = url;

  });
</script>
@endsection