@extends('layouts.master')
@section('content')



<style>
    .card {
        border: 1px #ccc solid;

    }

    .mainpanel {
        border: none;
    }
</style>

<div class="col-lg-12">
    <div class="card mainpanel">
        <div class="card-header card-header-section">
            <div class="pull-left">
                @lang('home.category') @lang('home.management')
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">

                    <div class="card">
                        <div class="card-header card-header-section">
                            @lang('home.new') @lang('home.category')
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputPassword2" class=" col-form-label">@lang('home.name')</label>
                                <input type="text" class="form-control" id="title" name="categorytitle" placeholder="@lang('home.name')">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2" class="col-form-label">@lang('home.description')</label>
                                <textarea name="description" class="form-control" id="description" name="categorydescription" cols="30" rows="8" placeholder="@lang('home.description')"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2" class="col-form-label">@lang('home.status')</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>

                            <div class="card-footer card-footer-section">
                                
                                    <div class="btn-group button-grp" role="group" aria-label="Basic example">
                                        <button id="datainsert" class="btn btn-danger btn-lg">@lang('home.submit')</button>
                                        <button id="reset" class="btn btn-success btn-lg">@lang('home.reset')</button>
                                   
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header card-header-section">
                            <div class="pull-left">
                                @lang('home.category') @lang('home.list')
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="mytable" class="table table-bordered" style="width:100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> #@lang('home.sl') </th>
                                        <th> @lang('home.name') </th>
                                        <th> @lang('home.status')</th>
                                        <th> @lang('home.description') </th>
                                        <th>@lang('home.action')</th>
                                    </tr>
                                </thead>
                                <tbody id="showalldata">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> #@lang('home.sl') </th>
                                        <th> @lang('home.name') </th>
                                        <th> @lang('home.status')</th>
                                        <th> @lang('home.description') </th>
                                        <th>@lang('home.action')</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    var table;
    var categoryid = 0;



    function DataTable() {

        table = $('#mytable').DataTable({
            responsive: true,
            paging: true,
            scrollY: 223,
            ordering: true,
            searching: true,
            colReorder: true,
            keys: true,
            processing: true,
            serverSide: true,

            //dom: 'lBfrtip',
            dom: "<'row'<'col-sm-3'l><'col-sm-2 text-center'B><'col-sm-7'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                    text: '<i class="fa fa-refresh"></i>@lang("home.refresh")',
                    action: function() {
                        table.ajax.reload();
                    },
                    className: 'btn btn-info',
                },



            ],
            "ajax": {
                "url": "{{ route('category.loadall') }}",
                "type": "GET",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: "text-center"
                },
                {
                    data: 'title',
                    name: 'title',

                },
                {
                    data: 'status',
                    name: 'status',

                },
                {
                    data: 'description',
                    name: 'description',

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
        });
        $('.dataTables_length').addClass('bs-select');
    }
    window.onload = DataTable();

    $("#datainsert").on("click", function(e) {
        $("#overlay").fadeIn();
        var title = $("#title").val();
        var description = $("#description").val();
        var status = $("#status").val();
        var method = $(this).attr("method");
        if (title == "") {
            swal("Opps! Faild", "Title Value Requird", "error");
        } else {
            if (categoryid == 0) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('category.store') }}",
                    data: {
                        title: title,

                        description: description,
                        status: status
                    },
                    datatype: ("json"),
                    success: function(data) {
                        $("#overlay").fadeOut();
                        swal("Data Inserted Successfully", "Form Submited", "success");
                        clear();
                        table.ajax.reload();
                    },
                    error: function(data) {
                        $("#overlay").fadeOut();
                        swal("Opps! Faild", "Form Submited Faild", "error");
                        console.log(data);
                    }
                });
            } else {
                $.ajax({
                    type: 'post',
                    url: "{{ route('category.update') }}",
                    data: {
                        id: categoryid,
                        title: title,
                        description: description,
                        status: status
                    },
                    datatype: ("json"),
                    success: function() {
                        $("#overlay").fadeOut();
                        swal("Data Update Successfully", "Form Submited", "success");
                        clear();
                        table.ajax.reload();

                    },
                    error: function() {
                        $("#overlay").fadeOut();
                        swal("Opps! Faild", "Form Submited Faild", "error");

                    }

                });

            }
        }
    })

    function clear() {
        categoryid = 0;
        $("#title").val("");
        $("#description").val("");
        $("#status").val("1");
    }
    $(document).on('click', "#reset", function() {
        clear();
    })
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
                        url: "{{ url('Category/delete')}}" + '/' + dataid,
                        success: function(data) {
                            table.ajax.reload();
                            clear();
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


    })
    //show Data by id

    $(document).on('click', '#datashow', function() {
        var id = $(this).data("id");
        $.ajax({
            type: 'get',
            url: "{{ route('category.show') }}",
            data: {
                dataid: id,
            },
            datatype: 'JSON',
            success: function(data) {
                categoryid = data.id;
                console.log(categoryid)
                var status = data.status
                var message = ((status == 0 ? " Deactive " : " Active "));
                $("#title").val(data.title);
                if (data.description) {
                    $("#description").val(data.description);
                } else {
                    $("#description").val("");
                }
                $("#status option[value='" + status + "']").attr('selected', 'selected');
            },
            error: function(data) {

            }
        });
    })
</script>

@endsection