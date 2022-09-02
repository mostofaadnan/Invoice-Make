@extends('layouts.master')
@section('content')
<style>
    .image-container {
        position: relative;
    }

    .image {
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .image-container:hover .image {
        opacity: 0.3;
    }

    .image-container:hover .middle {
        opacity: 1;
    }

    .my-custom-scrollbar {
        position: relative;
        height: 200px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }
</style>

<div class="row">
    <div class="col-sm-12 form-single-input-section">
        <div class="card">
            <div class="card-header card-header-section">
                <div class="row mb-3 mt-2">
                    <div class="col-sm-6">
                        @lang('home.employee') @lang('home.profile')
                        <input type="hidden" id="userid" value="{{ Auth::user()->id }}">
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="card-title mb-4">
                    <div class="d-flex justify-content-start">
                        <div class="image-container">
                            <img src="{{asset('storage/app/public/Employee/'.$Emplyer->image)}}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                            <div class="middle">
                                <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                <input type="file" style="display: none;" id="profilePicture" name="file" />
                            </div>
                        </div>
                        <div class="ml-auto">
                            <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Salary Payment</a>
                            </li>
                        </ul>
                        <div class="tab-content ml-1" id="myTabContent">
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">

                                <table class="table">
                                    <tr>
                                        <th width="20%">@lang('home.field')</th>
                                        <th>@lang('home.description')</th>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.id')</td>
                                        <td>{{$Emplyer->employer_id }}
                                            <input type="hidden" id="employeeid" value="{{$Emplyer->id }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.name')</td>
                                        <td>{{$Emplyer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.address')</td>
                                        <td>{{$Emplyer->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.mobile')</td>
                                        <td>{{$Emplyer->mobile_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.email')</td>
                                        <td>{{$Emplyer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.education')</td>
                                        <td>{{$Emplyer->education_background }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.joining') @lang('home.date')</td>
                                        <td>{{$Emplyer->joining_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.job') @lang('home.type')</td>
                                        <td>{{$Emplyer->job_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.designation')</td>
                                        <td>{{$Emplyer->designation }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.description')</td>
                                        <td>{{$Emplyer->other_description }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('home.status')</td>
                                        <td>{{$Emplyer->status==1?'Active':'Inactive' }}</td>
                                    </tr>

                                </table>

                            </div>
                            <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="connectedServices-tab">
                                <div class="container">
                                    <table id="mytable" class="table table-bordered" style="width:100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th> #@lang('home.sl') </th>
                                                <th> @lang('home.from')</th>
                                                <th> @lang('home.to')</th>
                                                <th> @lang('home.salary') </th>
                                                <th> @lang('home.overtime')</th>
                                                <th> @lang('home.bonus')</th>
                                                <th> @lang('home.reduction')</th>
                                                <th> @lang('home.nettotal')</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th> #@lang('home.sl') </th>
                                                <th> @lang('home.from')</th>
                                                <th> @lang('home.to')</th>
                                                <th> @lang('home.salary') </th>
                                                <th> @lang('home.overtime')</th>
                                                <th> @lang('home.bonus')</th>
                                                <th> @lang('home.reduction')</th>
                                                <th> @lang('home.nettotal')</th>
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
    </div>
</div>
<script>
    $(document).ready(function() {
        $imgSrc = $('#imgProfile').attr('src');

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imgProfile').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#btnChangePicture').on('click', function() {
            // document.getElementById('profilePicture').click();
            if (!$('#btnChangePicture').hasClass('changing')) {
                $('#profilePicture').click();
            } else {
                var name = document.getElementById("profilePicture").files[0].name;
                var form_data = new FormData();
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert("Invalid Image File");
                }
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("profilePicture").files[0]);
                var f = document.getElementById("profilePicture").files[0];
                var fsize = f.size || f.fileSize;
                if (fsize > 2000000) {
                    alert("Image File Size is very big");
                } else {
                    var employeeid = $("#employeeid").val();
                    form_data.append("file", document.getElementById('profilePicture').files[0]);
                    form_data.append("id",employeeid);
                  
                    $.ajax({
                        type: 'post',
                        url: "{{ url('Employee/ImageChange')}}",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            location.reload(true);
                            // console.log(data)
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });
                }
            }
        });
        $('#profilePicture').on('change', function() {
            readURL(this);
            $('#btnChangePicture').addClass('changing');
            $('#btnChangePicture').attr('value', 'Confirm');
            $('#btnDiscard').removeClass('d-none');
            // $('#imgProfile').attr('src', '');
        });
        $('#btnDiscard').on('click', function() {
            // if ($('#btnDiscard').hasClass('d-none')) {
            $('#btnChangePicture').removeClass('changing');
            $('#btnChangePicture').attr('value', 'Change');
            $('#btnDiscard').addClass('d-none');
            $('#imgProfile').attr('src', $imgSrc);
            $('#profilePicture').val('');
            // }
        });
    });

    var table;

    function DataTable() {
        var employeeid = $("#employeeid").val();
        console.log(employeeid);
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
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
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

                    $(column.footer()).html(sum);

                });
            },
            buttons: [{

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
                    title: 'Salary List',
                    filename: 'SalaryList',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-text-o"></i>CSV',
                    title: 'Salary List',
                    filename: 'SalaryList',
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
                    title: 'Salary List',
                    filename: 'SalaryList',
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
                    title: 'Salary List',
                    filename: 'SalaryList',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7]
                    },
                    footer: true,
                },

            ],
            "ajax": {
                "type": "GET",
                "data": {
                    employeeid: employeeid
                },
                "url": "{{ route('employees.empSalary') }}",

            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
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
                    data: 'salary',
                    name: 'salary',
                    className: "text-right"
                },
                {
                    data: 'over_time',
                    name: 'over_time',
                    className: "text-right"
                },
                {
                    data: 'bonus',
                    name: 'bonus',
                    className: "text-right"
                },
                {
                    data: 'reduction',
                    name: 'reduction',
                    className: "text-right"
                },
                {
                    data: 'netsalary',
                    name: 'netsalary',
                    className: "text-right"
                },


            ],

        });

    }
    window.onload = DataTable();
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust()
            .responsive.recalc();
    });
</script>
@endsection