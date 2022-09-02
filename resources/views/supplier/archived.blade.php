@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header card-header-section">
        <div class="pull-left">
            @lang('home.supplier') @lang('home.archive')
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
                    <th> @lang('home.opening') <br>@lang('home.balance') </th>
                    <th> @lang('home.consignment') </th>
                    <th> @lang('home.discount') </th>
                    <th> @lang('home.payment')</th>
                    <th> @lang('home.balance')</th>
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
                    <th> @lang('home.opening') <br>@lang('home.balance') </th>
                    <th> @lang('home.consignment') </th>
                    <th> @lang('home.discount') </th>
                    <th> @lang('home.payment')</th>
                    <th> @lang('home.balance')</th>
                    <th> @lang('home.status')</th>
                    <th> @lang('home.action')</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

@<script>
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
            footerCallback: function() {
                var sum = 0;
                var column = 0;
                this.api().columns('3,4,5,6,7', {
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
                    /* if (!sum.includes('tk'))
                      sum += ' &euro;'; */
                    $(column.footer()).html(sum);

                });
            },
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "ajax": {
                "url": "{{ route('supplier.LoadAllArchived') }}",
                "type": "GET",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: "text-center"
                },
                {
                    data: 'id',
                    name: 'id',
                    className: "text-center"
                },
                {
                    data: 'name',
                    name: 'name',
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
                    data: 'payment',
                    name: 'payment',
                    className: "text-right"
                },
                {
                    data: 'balancedue',
                    name: 'balancedue',
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
        url = "{{ url('Supplier/show')}}" + '/' + dataid,
            window.location = url;
    });

    //Balance Upload
    $(document).on('click', "#openingbalance", function() {
        var dataid = $(this).data("id");
        url = "{{ url('Supplier/openingbalance')}}" + '/' + dataid,
            window.location = url;
    });
    // data Delete
    $(document).on('click', '#deletedata', function() {
        swal({
                title: "Are you sure?",
                text: "Once deleted!All Data will be remove,like purchase,purchase return & Supplier Payment.Better Skip This",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var dataid = $(this).data("id");
                    $.ajax({
                        type: "post",
                        url: "{{ url('Supplier/permanentdelete')}}" + '/' + dataid,
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

    $(document).on("click", "#retrive", function(event) {
        var dataid = $(this).data("id");
        $.ajax({
            type: "post",
            url: "{{ url('Supplier/retrive')}}" + '/' + dataid,
            data: {
                id: dataid,
            },
            datatype: ("json"),
            success: function() {
                table.ajax.reload();
            },
            error: function() {
                swal("Opps! Faild", "Form Submited Faild", "error");

            }
        });
    });
</script>
@endsection