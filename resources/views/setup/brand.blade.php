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
                @lang('home.brand') @lang('home.management')
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            @lang('home.new') @lang('home.brand')
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword2" class="col-form-label">@lang('home.name')</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="@lang('home.name')" require>
                            </div>
                            <div class="input-group  mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">@lang('home.category')</span>
                                </div>

                                <select id="multicategory" class="multi-select muticat form-control" name="category[]" multiple="multiple">
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $(document).ready(function() {
                                        $('#multicategory').multiselect();
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2" class="col-form-label">@lang('home.description')</label>
                                <textarea name="description" class="form-control" id="description" name="description" cols="30" rows="6" placeholder="@lang('home.description')"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2" class="col-form-label">@lang('home.status')</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                            <div class="card-footer card-footer-section">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="submit" id="datainsert" class="btn btn-danger btn-lg">@lang('home.submit')</button>
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
                                @lang('home.brand') @lang('home.list')
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="mytable" class="table table-bordered" style="width:100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> #@lang('home.sl') </th>
                                        <th> @lang('home.name') </th>
                                        <th> @lang('home.type')</th>
                                        <th> @lang('home.status')</th>
                                        <th> @lang('home.description') </th>
                                        <th> @lang('home.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> #@lang('home.sl') </th>
                                        <th> @lang('home.name') </th>
                                        <th> @lang('home.type')</th>
                                        <th> @lang('home.status')</th>
                                        <th> @lang('home.description') </th>
                                        <th> @lang('home.action')</th>
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
    var brandid = 0;

    function DataTable() {
        table = $('#mytable').DataTable({
            responsive: true,
            paging: true,
            scrollY: 300,
            ordering: true,
            searching: true,
            colReorder: true,
            keys: true,
            processing: true,
            serverSide: true,

            dom: "<'row'<'col-sm-3'l><'col-sm-2 text-center'B><'col-sm-7'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                text: '<i class="fa fa-refresh"></i>@lang("home.refresh")',
                action: function() {
                    table.ajax.reload();
                },
                className: 'btn btn-info',
            }, ],
            "ajax": {
                "url": "{{ route('brand.loadall') }}",
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
                    data: 'type',
                    name: 'type',

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
    }
    window.onload = DataTable();
    $("#datainsert").on("click", function() {
        var itemlist = new Array();
        var item = {};
        var title = $("#title").val();
        item = $("#multicategory").val();
        var description = $("#description").val();
        var status = $("#status").val();
        if (title == "") {
            swal("Opps! Faild", "Title Value Requird", "error");
        } else {
            $("#overlay").fadeIn();
            if (brandid == 0) {
                $.ajax({
                    url: "{{ route('brand.store') }}",
                    type: 'Post',
                    data: {
                        title: title,
                        itemlist: item,
                        description: description,
                        status: status
                    },
                   
                    datatype: ("json"),

                    success: function(data) {
                        $("#overlay").fadeOut();
                        swal("Data Inserted Successfully", "Form Submited", "success");
                        console.log(data);
                        clear();
                        table.ajax.reload();
                    },
                    error: function() {
                        $("#overlay").fadeOut();
                        swal("Opps! Faild", "Form Submited Faild", "error");
                    }
                });
            } else {
                $.ajax({
                    url: "{{ route('brands.update') }}",
                    type: 'POST',
                    data: {
                        id: brandid,
                        title: title,
                        itemlist: item,
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
        brandid = 0;
        //$("#multicategory").val("");
        $('#multicategory').val([]).multiselect('refresh')
        $("#title").val("");
        $("#description").val("");

    }
    $(document).on('click', "#reset", function() {
        clear();
    });
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
                        url: "{{ url('Brand/delete')}}" + '/' + dataid,
                        success: function(data) {
                            clear();
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
    })
    //show Data by id

    $(document).on('click', '#datashow', function() {
        var dataid = $(this).data("id");
        $.ajax({
            url: "{{ route('brand.show') }}",
            type: 'get',
            data: {
                dataid: dataid,
            },
            cache: false,
            datatype: 'JSON',
            success: function(data) {
                //console.log(data);
                var status = data.status;
                brandid = data.id;
                var message = ((status == 0 ? " Deactive " : " Active "));
                $("#title").val(data.title);

                var valArr = []; // create array here
                data.category_name.forEach(function(value) {
                    valArr.push(value['category_id']);
                });
                i = 0, size = valArr.length;
                for (i; i < size; i++) {
                 //   $("#multicategory").multiselect("widget").find(":checkbox[value='" + valArr[i] + "']").attr("checked", "checked");
                    $("#multicategory option[value='" + valArr[i] + "']").attr("selected", 1);
                    $("#multicategory").multiselect("refresh");
                }
                /*    data.category_name.forEach(function(value) {
                       $("#multicategory").multiselect("widget").find(":checkbox[value='" + valArr[i] + "']").attr("checked", "checked");
                       $("#multicategory option[value='" + valArr[i] + "']").attr("selected", 1);
                       $("#multicategory").multiselect("refresh");

                       $("#multicategory option[value='" + value['category_id']+ "']").prop("selected", true);

                       console.log(value['category_id']);
                       $("#multicategory option[value='" + value['category_id'] + "']").prop("selected", true);
                   }); */

                //$("#multicategory option[value='" + data.type + "']").attr('selected', 'selected');
                if (data.description) {
                    $("#description").val(data.description);
                } else {
                    $("#description").val("");
                }
                $("#status option[value='" + status + "']").attr('selected', 'selected');
            },
            error: function(data) {
                console.log(data);
            }
        });
    })
</script>


@endsection