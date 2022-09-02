<script type="text/javascript">
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
            },
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{

                    text: '<i class="fa fa-refresh"></i>@lang("home.refresh")',
                    action: function() {
                        $("#min").val("");
                        $("#max").val("");
                        tabledata.destroy();
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
                    extend: 'csv',
                    text: '<i class="fa fa-file-text-o"></i>@lang("home.csv")',
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
                    title: 'Expenses List',
                    filename: 'expenses',
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
                {
                    data: 'source',
                    name: 'source',

                },
                {
                    data: 'description',
                    name: 'description',

                },
                {
                    data: 'voucherno',
                    name: 'voucherno',

                },
                {
                    data: 'payment_description',
                    name: 'payment_description',

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
    window.onload = DataTable();
    $(document).on('click', '#datashow', function() {
        var id = $(this).data("id");
        url = "{{ url('Expenses/show')}}" + '/' + id,
            window.location = url;
    });
    $(document).on('click', '#canceldata', function() {
        swal({
                title: "Are you sure?",
                text: "Once Cancel, you will not be able to recover this  data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "{{ url('Expenses/cancel')}}" + '/' + id,
                        success: function(data) {
                            $('#mytable').DataTable().ajax.reload()
                        },
                        error: function(data) {
                            console.log(data);
                            swal("Opps! Faild", "Data Fail to Cancel", "error");
                        }
                    });
                    swal("Ok! Your file has been cancelled!", {
                        icon: "success",
                    });
                } else {
                    swal("Your file is safe!");
                }
            });
    });

    //permanant Delete
    $(document).on('click', '#datashow', function() {
        var id = $(this).data("id");
        url = "{{ url('Expenses/show')}}" + '/' + id,
            window.location = url;
    });
    $(document).on('click', '#print', function() {
        var id = $(this).data("id");
        url = "{{ url('Expenses/LoadPrintslip')}}" + '/' + id,
            window.open(url, '_blank');
    });
    $(document).on('click', '#deletedata', function() {
        swal({
                title: "Are you sure?",
                text: "Once Delete, you will not be able to recover this  data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "{{ url('Expenses/destroy')}}" + '/' + id,
                        success: function(data) {
                            $('#mytable').DataTable().ajax.reload()
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
    //retive data

    $(document).on('click', '#retrivedata', function() {
        swal({
                title: "Are you sure?",
                icon: "success",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "{{ url('Expenses/retrive')}}" + '/' + id,
                        success: function(data) {
                            $('#mytable').DataTable().ajax.reload()
                        },
                        error: function(data) {
                            console.log(data);
                            swal("Opps! Faild", "Data Fail to Retrive", "error");
                        }
                    });
                    swal("Ok! Your file has been Retrive!", {
                        icon: "success",
                    });
                }
            });
    });

    //pdf data
    $(document).on('click', '#pdfdata', function() {
        var id = $(this).data("id");
        url = "{{ url('Expenses/pdf')}}" + '/' + id,
            window.location = url;
    });
</script>