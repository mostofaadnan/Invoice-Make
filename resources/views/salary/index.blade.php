@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.salary') @lang('home.management')
        </div>
        <div class="pull-right">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a type="button" class="btn btn-outline-danger" href="{{Route('salary.create')}}"><i class="fa fa-plus" aria-hidden="true">@lang('home.new') @lang('home.salary')</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('partials.ErrorMessage')
        <table id="mytable" class="table table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.payment') @lang('home.number') </th>
                    <th> @lang('home.from')</th>
                    <th> @lang('home.to')</th>
                    <th> @lang('home.salary') </th>
                    <th> @lang('home.overtime')</th>
                    <th> @lang('home.bonus')</th>
                    <th> @lang('home.reduction')</th>
                    <th> @lang('home.nettotal')</th>
                    <th> @lang('home.payment')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.payment') @lang('home.number') </th>
                    <th> @lang('home.from')</th>
                    <th> @lang('home.to')</th>
                    <th> @lang('home.salary') </th>
                    <th> @lang('home.overtime')</th>
                    <th> @lang('home.bonus')</th>
                    <th> @lang('home.reduction')</th>
                    <th> @lang('home.nettotal')</th>
                    <th> @lang('home.payment')</th>
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
            responsive: true,
            paging: true,
            scrollY: 400,
            ordering: true,
            searching: true,
            colReorder: true,
            keys: true,
            processing: true,
            serverSide: true,
            "initComplete": function(settings, json) {
                table.columns.adjust().draw();
            },
            
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          /*   buttons: [{

                    text: '<i class="fa fa-refresh"></i>Refresh',
                    action: function() {
                        table.ajax.reload();
                    },
                    className: 'btn btn-info',
                },
                {
                    extend: 'copy',
                    className: 'btn btn-secondary',
                    text: '<i class="fa fa-files-o"></i>Data Export',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-text-o"></i>CSV',
                    className: 'btn btn-info',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7]
                    }
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

            ], */
            "ajax": {
                "url": "{{ route('salary.loadall') }}",
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
                    data: 'from_date',
                    name: 'from_date',
                },
                {
                    data: 'to_date',
                    name: 'to_date',

                },
                {
                    data: 'total_salary',
                    name: 'total_salary',
                    className: "text-right"
                },
                {
                    data: 'total_over_time',
                    name: 'total_over_time',
                    className: "text-right"
                },
                {
                    data: 'total_bonus',
                    name: 'total_bonus',
                    className: "text-right"
                },
                {
                    data: 'total_reduction',
                    name: 'total_reduction',
                    className: "text-right"
                },
                {
                    data: 'netsalary',
                    name: 'netsalary',
                    className: "text-right"
                },
                {
                    data: 'payment',
                    name: 'payment',

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
        url = "{{ url('Salary/show')}}" + '/' + dataid,
            window.location = url;
    });
    //datae edit
    $(document).on('click', "#dataedit", function() {
        var dataid = $(this).data("id");
        url = "{{ url('Salary/edit')}}" + '/' + dataid,
            window.location = url;
    });
    //data pdf
    $(document).on('click', "#pdf", function() {
        var dataid = $(this).data("id");
        url = "{{ url('Salary/pdf')}}" + '/' + dataid,
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

   
</script>
@endsection