@extends('layouts.master')
@section('content')

<div class="card">
    <style .input-group-text{width:auto;}></style>
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.dayclose') @lang('home.management')(@lang('home.yearly'))
        </div>
        <div class="pull-right">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <a type="button" class="btn btn-outline-danger" href="{{Route('dayclose.yearlycreate')}}">@lang('home.new')</i>
                    </a>
                    <!--            <a class="btn btn-outline-info" href="{{Route('purchase.profile')}}">Check</a>
                    <a class="btn btn-outline-success" href="{{Route('purchase.editcheck')}}">Edit</a>
                    <button type="button" id="loadall" class="btn btn-outline-light">Load All</button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                @include('section.dateBetween')
            </div>
        </div>
        <div class="divider"></div>
        @include('partials.ErrorMessage')
        <table id="mytable" class="table table-bordered" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center"> #@lang('home.sl') </th>
                    <th class="text-center"> @lang('home.type') </th>
                    <th class="text-center"> @lang('home.date') </th>
                    <th class="text-center"> @lang('home.year') </th>
                    <th class="text-center"> @lang('home.cash') @lang('home.invoice') </th>
                    <th class="text-center"> @lang('home.credit') @lang('home.invoice') </th>
                    <th class="text-center"> @lang('home.sale') @lang('home.return')</th>
                    <th class="text-center"> @lang('home.purchase')</th>
                    <th class="text-center"> @lang('home.grn')</th>
                    <th class="text-center"> @lang('home.purchase') @lang('home.return')</th>
                    <th class="text-center"> @lang('home.supplier') @lang('home.payment') </th>
                    <th class="text-center"> @lang('home.customer') @lang('home.payment') </th>
                    <th class="text-center"> @lang('home.expenses')</th>
                    <th class="text-center"> @lang('home.stock') @lang('home.amount')</th>
                    <th class="text-center"> @lang('home.cashin')</th>
                    <th class="text-center"> @lang('home.cashout')</th>
                    <th class="text-center"> @lang('home.cash') @lang('home.drawer')</th>
                    <th class="text-center"> @lang('home.cashin') @lang('home.bank')</th>
                    <th class="text-center"> @lang('home.status')</th>
                    <th class="text-center"> @lang('home.action')</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center"> #@lang('home.sl') </th>
                    <th class="text-center"> @lang('home.type') </th>
                    <th class="text-center"> @lang('home.date') </th>
                    <th class="text-center"> @lang('home.year') </th>
                    <th class="text-center"> @lang('home.cash') @lang('home.invoice') </th>
                    <th class="text-center"> @lang('home.credit') @lang('home.invoice') </th>
                    <th class="text-center"> @lang('home.sale') @lang('home.return')</th>
                    <th class="text-center"> @lang('home.purchase')</th>
                    <th class="text-center"> @lang('home.grn')</th>
                    <th class="text-center"> @lang('home.purchase') @lang('home.return')</th>
                    <th class="text-center"> @lang('home.supplier') @lang('home.payment') </th>
                    <th class="text-center"> @lang('home.customer') @lang('home.payment') </th>
                    <th class="text-center"> @lang('home.expenses')</th>
                    <th class="text-center"> @lang('home.stock') @lang('home.amount')</th>
                    <th class="text-center"> @lang('home.cashin')</th>
                    <th class="text-center"> @lang('home.cashout')</th>
                    <th class="text-center"> @lang('home.cash') @lang('home.drawer')</th>
                    <th class="text-center"> @lang('home.cashin') @lang('home.bank')</th>
                    <th class="text-center"> @lang('home.status')</th>
                    <th class="text-center"> @lang('home.action')</th>
                </tr>
            </tfoot>
        </table>

    </div>


</div>

<script>
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
                this.api().columns('4,5,6,7,8,9,10,11,12,13,14', {
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-text-o"></i>@lang("home.csv")',
                    className: 'btn btn-info',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i>@lang("home.excel")',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    footer: true,
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>@lang("home.pdf")',
                    extend: 'pdf',
                    className: 'btn btn-light',
                    orientation: 'portrait', //portrait',
                    pageSize: 'A4',
                    title: 'Dayclose List',
                    filename: 'dayclose',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    },
                    footer: true,
                },

            ],
            "ajax": {
                "url": "{{ route('dayclose.loadallyearly') }}",
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
                    data: 'closetype',
                    name: 'closetype',
                    className: "text-center"
                },
                {
                    data: 'created',
                    name: 'created',
                    className: "text-center"
                },
                {
                    data: 'year',
                    name: 'year',
                    className: "text-center"
                },
                {
                    data: 'cashinvoice',
                    name: 'cashinvoice',
                    className: "text-right"

                },
                {
                    data: 'creditinvoice',
                    name: 'creditinvoice',
                    className: "text-right"
                },
                {
                    data: 'salereturn',
                    name: 'salereturn',
                    className: "text-right"
                },

                {
                    data: 'purchase',
                    name: 'purchase',
                    className: "text-right"

                },
                {
                    data: 'grn',
                    name: 'grn',
                    className: "text-right"

                },
                {
                    data: 'purchasereturn',
                    name: 'purchasereturn',
                    className: "text-right"

                },

                {
                    data: 'supplierpayment',
                    name: 'supplierpayment',
                    className: "text-right"
                },
                {
                    data: 'creditpayment',
                    name: 'creditpayment',
                    className: "text-right"
                },
                {
                    data: 'expenses',
                    name: 'expenses',
                    className: "text-right"
                },
                {
                    data: 'stockamount',
                    name: 'stockamount',
                    className: "text-right"
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
                    data: 'cashdrawer',
                    name: 'cashdrawer',
                    className: "text-right"
                },

                {
                    data: 'cashinbank',
                    name: 'cashinbank',
                    className: "text-right"
                },
                {
                    data: 'status',
                    name: 'status',
                    className: "text-right"
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
    $("#submitdate").on('click', function() {
        if ($("#max").val() == "" || $("#min").val() == "") {
            swal("Opps! Faild", "Please Select Between Date", "error");
        } else {
            table.destroy();
            DataTable();
        }

    });
    $(document).on('click', '#datashow', function() {
        var id = $(this).data("id");
        url = "{{ url('Day-Close/show')}}" + '/' + id,
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
                        url: "{{ url('Day-Close/delete')}}" + '/' + dataid,
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
    $(document).on('click', '#reopen', function() {
        swal({
                title: "Are you sure?",
                text: "want to re-open,if you re-open this data will be delete",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var dataid = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "{{ url('Day-Close/delete')}}" + '/' + dataid,
                        success: function(data) {
                            url = "{{ url('Day-Close/create')}}",
                                window.location = url;
                        },
                        error: function() {
                            swal("Opps! Faild", "Form Submited Faild", "error");

                        }
                    });

                    swal("Poof! succefully reopen!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });


    });
</script>

@endsection