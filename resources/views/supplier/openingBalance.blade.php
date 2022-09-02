@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            @include('supplier.partials.openingForm')
        </div>
        <hr>
        <h4 align='center' style="border-bottom:1px #ccc solid;">Balance History</h4>
        <table class="table table-bordered" cellspacing="0" id="mytable" width="100%">
            <thead>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.opening') @lang('home.balance') </th>
                    <th> @lang('home.consignment') </th>
                    <th> @lang('home.discount') </th>
                    <th>@lang('home.return') @lang('home.amount')</th>
                    <th> @lang('home.payment') </th>
                    <th> @lang('home.remark') </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th> #@lang('home.sl') </th>
                    <th> @lang('home.date') </th>
                    <th> @lang('home.opening') @lang('home.balance') </th>
                    <th> @lang('home.consignment') </th>
                    <th> @lang('home.discount') </th>
                    <th>@lang('home.return') @lang('home.amount')</th>
                    <th> @lang('home.payment') </th>
                    <th> @lang('home.remark') </th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

<script>
    $(document).ready(function() {
        var opening = 0;

        function getUrl() {
            var url = $(location).attr('href')
            var segment = url.split("/").length - 1 - (url.indexOf("http://") == -1 ? 0 : 2);
                var supplierid = url.substring(url.lastIndexOf('/') + 1);
                $("#supplier_id").val(supplierid);
                getOpening(supplierid);
                DataTable(supplierid);
           
        }
        window.onload = getUrl()

        function calc() {
            var consignment = 0.00;
            var totaldiscount = 0.00;
            var payment = 0.00;

            consignment = ($.trim($("#consignment").val()) != "" && !isNaN($("#consignment").val())) ? parseFloat($("#consignment").val()) : 0.00;
            totaldiscount = ($.trim($("#totaldiscount").val()) != "" && !isNaN($("#totaldiscount").val())) ? parseFloat($("#totaldiscount").val()) : 0.00;
            payment = ($.trim($("#payment").val()) != "" && !isNaN($("#payment").val())) ? parseFloat($("#payment").val()) : 0.00;
            var balancedue = 0.00;
            netconsignment = parseFloat(consignment - totaldiscount);
            balancedue = parseFloat(netconsignment - payment);
            $("#balancedue").val(balancedue);
        }
        $("#consignment").keyup(function() {
            calc();
        });
        $("#totaldiscount").keyup(function() {
            calc();
        });
        $("#payment").keyup(function() {
            calc();
        });
    });

    function getOpening(supplierid) {
        $.ajax({
            type: 'get',
            url: "{{url('Supplier/getopening')}}?supplierid=" + supplierid,
            success: function(data) {
              
               
                LoadData(data);
            },
            error: function(data) {
                console.log(data);
            }
        });

    }

    function LoadData(data) {
        var netconsignment = 0.00;
        var balancedue = 0.00;
        var consignment =  parseFloat(data.consignment);
        var totaldiscount =  parseFloat(data.totaldiscount);
        var payment =  parseFloat(data.payment);
        $("#consignment").val(consignment);
        $("#totaldiscount").val(totaldiscount);
        $("#payment").val(payment);
        netconsignment = parseFloat(consignment - totaldiscount);
        balancedue = parseFloat(netconsignment - payment);
        $("#balancedue").val(balancedue);
    }
    //load Balance
    var tabledata;

    function DataTable(supplierid) {
        var tabledata = $('#mytable').DataTable({
            responsive: true,
            paging: true,
            scrollY: 300,
            scrollCollapse: false,
            ordering: true,
            searching: true,
            colReorder: true,
            keys: true,
            processing: true,
            serverSide: true,
            footerCallback: function() {
                var sum = 0;
                var column = 0;
                this.api().columns('2,3,4,5,6', {
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
                    /*  if (!sum.includes('tk'))
                       sum += ' &euro;';*/
                    $(column.footer()).html(sum);

                });
            },

            dom: "<'row'<'col-sm-4'l><'col-sm-5 text-center'B><'col-sm-3'f>>" +
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
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i>@lang("home.excel")',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5]
                    },
                    footer: true,
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>@lang("home.pdf")',
                    extend: 'pdfHtml5',
                    className: 'btn btn-light',
                    orientation: 'portrait', //portrait',
                    pageSize: 'A4',
                    title: 'Customer List(Cash)',
                    filename: 'Customer',
                    className: 'btn btn-danger',

                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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
                    orientation: 'portrait',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    footer: true,
                },

            ],
            "ajax": {
                "data": {
                    supplierid: supplierid
                },
                "url": "{{ route('supplier.balanceloadall') }}",
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
                },
                {
                    data: 'openingBalance',
                    name: 'openingBalance',
                    className: "text-right"
                },
                {
                    data: 'consignment',
                    name: 'consignment',
                    className: "text-right"
                },
                {
                    data: 'totaldiscount',
                    name: 'totaldiscount',
                    className: "text-right"

                },
                {
                    data: 'returnamount',
                    name: 'returnamount',
                    className: "text-right"

                },
                {
                    data: 'payment',
                    name: 'payment',
                    className: "text-right"
                },
              
                {
                    data: 'remark',
                    name: 'remark',
                   
                },

            ],
        });
        /*   $('.dataTables_length').addClass('bs-select'); */
    }
</script>
@endsection