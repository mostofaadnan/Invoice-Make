@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header card-header-section">
        <div class="card-title">
            <h5 style="color:#fff;">@lang('home.new') @lang('home.salary') @lang('home.sheet')</h5>
        </div>
        @include('section.salarysection')
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @include('section.employeesection')
                    </div>
                    <div class="card-body">
                        <div class="my-custom-scrollbar my-custom-scrollbar-primary scrollbar-morpheus-den">
                            <table class="data-table table table-striped table-bordered table-sm" cellspacing="0" id="employetable">
                                <thead>
                                    <tr>
                                        <th align='center'> @lang('home.sl') </th>
                                        <th align='center'> @lang('home.employee') @lang('home.id') </th>
                                        <th align='center'> @lang('home.name')</th>
                                        <th align='center'> @lang('home.salary') </th>
                                        <th align='center'> @lang('home.bonus') </th>
                                        <th align='center'> @lang('home.overtime')</th>
                                        <th align='center'> @lang('home.reduction') </th>
                                        <th align='center'> @lang('home.nettotal') </th>
                                        <th align='center'> @lang('home.action')</th>
                                    </tr>
                                </thead>
                                <tbody id="datatablebody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer sum-section">
        @include('salary.partials.sumfootersection')
    </div>
</div>

<script type="text/javascript">
    var sl = 1;
    var salary = 0;
    var unitid = 0;
    const $tableID = $('.data-table');
    var salaryid = 0;

    function Paymentcode() {
        $.ajax({
            type: 'get',
            url: "{{ route('salary.paymentcode') }}",
            datatype: 'JSON',
            success: function(data) {
                $("#paymentno").val(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function EmployeeDatalist() {
        $.ajax({
            type: 'get',
            url: "{{ route('employees.employedatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#employee').html(data);
            },
            error: function(data) {}
        });
    }

    window.onload = EmployeeDatalist();
    window.onload = Paymentcode();
    $("#search").on('input', function() {
        var val = this.value;
        if ($('#employee option').filter(function() {
                return this.value.toUpperCase() === val.toUpperCase();
            }).length) {
            var salary = $('#employee').find('option[value="' + val + '"]').attr('data-salary');
            $("#salary").val(salary)
        }
    });

    $("#clear").on('click', function() {
        clear();
    })
    //Add rows
    $("#addrows").on('click', function(e) {
        var salary = $("#salary").val();
        var employeename = $("#search").val();
        var employeid = $('#employee').find('option[value="' + employeename + '"]').attr('id');

        if (employeename == "" || employeid == 0 || salary == "" || salary == 0) {
            swal("Please Select Requrie Field", "Require Field", "error");
        } else {
            var rowCount = $('.data-table tr').length;
            if (rowCount == 1) {
                addRowData();
            } else {

                CheckEntry();
            }
        }

    });

    $('#salary').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            var salary = $("#salary").val();
            var employeename = $("#search").val();
            var employeid = $('#employee').find('option[value="' + employeename + '"]').attr('id');

            if (employeename == "" || employeid == 0 || salary == "" || salary == 0) {
                swal("Please Select Requrie Field", "Require Field", "error");
            } else {
                var rowCount = $('.data-table tr').length;
                if (rowCount == 1) {
                    addRowData();
                } else {

                    CheckEntry();
                }
            }

        }
    });

    function CheckEntry() {
        var name = $("#search").val();
        var item = $('#employee').find('option[value="' + name + '"]').attr('data-employeid');
        var isvalid = true;
        $("#employetable tr").each(function() {
            var row = $(this);
            var tableitemcode = row.find("TD").eq(1).html();
            if (item == tableitemcode) {
                isvalid = false;
                //break;
                swal("Ops! This Data Already Exists", "input Data", "error");
                clear();
            }
        });
        if (isvalid == true) {
            addRowData();
        }
    }

    function addRowData() {
        var overtime = 0;
        var bonus = 0;
        var reduction = 0;
        var search = $("#search").val();
        var id = $('#employee').find('option[value="' + search + '"]').attr('id');
        var employeid = $('#employee').find('option[value="' + search + '"]').attr('data-employeid');
        var employename = $('#employee').find('option[value="' + search + '"]').attr('data-name');
        salary = $('#employee').find('option[value="' + search + '"]').attr('data-salary');
        if ($("#overtime").val() == "") {
            overtime = 0.00;
        } else {
            overtime = $("#overtime").val();
        }
        if ($("#bonus").val() == "") {
            bonus = 0;
        } else {
            bonus = $("#bonus").val();
        }
        if ($("#reduction").val() == "") {
            reduction = 0;
        } else {
            reduction = $("#reduction").val();
        }

        var totalsalary = parseFloat(salary) + parseFloat(bonus) + parseFloat(overtime);
        var netsalary = parseFloat(totalsalary) - parseFloat(reduction);

        $(".data-table tbody").append("<tr id=" + sl + "  data-id='" + id + "'>" +
            "<td>" + sl + "</td>" +
            "<td id='itemcode'>" + employeid + "</td>" +
            "<td class='itemname'>" + employename + "</td>" +
            "<td align='right' class='salary' contenteditable='true'>" + salary + "</td>" +
            "<td class='overtime' align='right' contenteditable='true'>" + overtime + "</td>" +
            "<td class='bonus' align='right' contenteditable='true'>" + bonus + "</td>" +
            "<td class='reduction' align='right' contenteditable='true'>" + reduction + "</td>" +
            "<td class='netsalary' align='right'>" + netsalary + "</td>" +
            "<td>" +
            " <div class='btn-group' role='group' aria-label='Basic example'>" +
            "<button class='btn btn-danger btn-delete'>X</button>" +
            "<div>" +
            "</td>" +
            "</tr>");
        sl++;
        TablelSummation();
        clear();


    }
    $("body").on("click", ".btn-delete", function() {
        swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parents("tr").remove();
                    TablelSummation();
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
    });

    //qty update
    $("body").on("keyup", '.salary', function() {
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        var salary = $(this).parent("tr").find("td").eq(3).text();
        if (salary == "" || !numberRegex.test(salary)) {
            salary = 0;
        }
        var bonus = $(this).parent("tr").find("td").eq(4).text();
        var overtime = $(this).parent("tr").find("td").eq(5).text();
        var reduction = $(this).parent("tr").find("td").eq(6).text();
        var totalsalary = parseFloat(salary + bonus + overtime).toFixed(2);
        var netsalary = parseFloat(totalsalary - reduction).toFixed(2);
        $(this).parents("tr").find("td:eq(7)").text(netsalary);
        TablelSummation();

    });
    $("body").on("keyup", '.overtime', function() {
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        var overtime = $(this).parent("tr").find("td").eq(5).text();
        if (overtime == "" || !numberRegex.test(overtime)) {
            overtime = 0;
        }

        var salary = $(this).parent("tr").find("td").eq(3).text();
        var bonus = $(this).parent("tr").find("td").eq(4).text();
        var reduction = $(this).parent("tr").find("td").eq(6).text();
        var totalsalary = parseFloat(salary) + parseFloat(bonus) + parseFloat(overtime);
        var netsalary = parseFloat(totalsalary) - parseFloat(reduction);
        $(this).parents("tr").find("td:eq(7)").text(netsalary);
        TablelSummation();

    });
    $("body").on("keyup", '.reduction', function() {
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        var reduction = $(this).parent("tr").find("td").eq(6).text();
        if (reduction == "" || !numberRegex.test(reduction)) {
            reduction = 0;
        }
        console.log(reduction);
        var salary = $(this).parent("tr").find("td").eq(3).text();
        var overtime = $(this).parent("tr").find("td").eq(5).text();
        var bonus = $(this).parent("tr").find("td").eq(4).text();
        var totalsalary = parseFloat(salary) + parseFloat(bonus) + parseFloat(overtime);
        var netsalary = parseFloat(totalsalary) - parseFloat(reduction);
        $(this).parents("tr").find("td:eq(7)").text(netsalary);
        TablelSummation();

    });

    function clear() {
        $("#search").val("");
        $("#salary").val("");
        $("#overtime").val("0");
        $("#bonus").val("0");
        $("#reduction").val("0");
        $('#search').focus();
        salary = 0;
    }

    function TablelSummation() {
        netsalary();
        totalovertime();
        totalbonus();
        Nettotal();
        totalreduction();
    }

    function netsalary() {
        var sum = 0;
        $(".salary").each(function() {
            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        $("#totalsalary").val(sum.toFixed(2));
    }

    function totalovertime() {
        var sum = 0;
        $(".overtime").each(function() {
            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        $("#totalovertime").val(sum.toFixed(2));
    }

    function totalbonus() {
        var sum = 0;
        $(".bonus").each(function() {
            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        $("#totalbonus").val(sum.toFixed(2));
    }

    function totalreduction() {
        var sum = 0;
        $(".reduction").each(function() {
            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        $("#totalreduction").val(sum.toFixed(2));
    }

    function Nettotal() {
        var sum = 0;
        $(".netsalary").each(function() {
            var value = $(this).text();
            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });
        $("#netsalary").val(sum.toFixed(2));
    }

    //inset Data
    function DataInsert() {
        $("#overlay").fadeIn();
        /*    var shipmens; */
        var paymentno = $("#paymentno").val();
        var inputdate = $("#inputdate").val();
        var fromdate = $("#fromdate").val();
        var todate = $("#todate").val();
        var salary = $("#totalsalary").val();
        var overtime = $("#totalovertime").val();
        var bonus = $("#totalbonus").val();
        var reduction = $("#totalreduction").val();
        var nettotal = $("#netsalary").val();

        /*  if ($("#shipmentcost").val() == "") {
             shipmens = 0;
         } else {
             shipmens = $("#shipment").val();
         } */
        var itemtables = new Array();
        $("#employetable TBODY TR").each(function() {
            var row = $(this);
            var item = {};
            item.id = row.data('id');
            item.salary = row.find("TD").eq(3).html();
            item.bonus = row.find("TD").eq(4).html();
            item.overtime = row.find("TD").eq(5).html();
            item.reduction = row.find("TD").eq(6).html();
            item.nettotal = row.find("TD").eq(7).html();
            itemtables.push(item);
        });

        $.ajax({
            type: "POST",
            url: "{{ route('salary.store') }}",
            cache: 'false',
            data: {
                itemtables: itemtables,
                paymentno: paymentno,
                inputdate: inputdate,
                fromdate: fromdate,
                todate: todate,
                salary: salary,
                bonus: bonus,
                overtime: overtime,
                reduction: reduction,
                nettotals: nettotal,
            },
            datatype: ("json"),
            success: function(data) {
                $("#overlay").fadeOut();
                salaryid = data;
                Cinfirm()
            },
            error: function(data) {
                $("#overlay").fadeOut();
                swal("Ops! Fail To submit", "Data Submit", "error");
                console.log(data);
            }
        });

    }
    $("#submittData").click(function() {
        var totalsalary = $("#netsalary").val();
        var fromdate = $("#fromdate").val();
        var todate = $("#todate").val();
        if ($(".data-table tbody").is(':empty') || totalsalary == "" || totalsalary == 0 || fromdate == "" || todate == "") {
            swal("Please Select Requirment Fields", "Requirment Field Empty", "error");
        } else {
            DataInsert();
        }
    });

    function ExecuteClear() {
        Paymentcode();
        $(".data-table tbody").empty();
        $("#totalsalary").val("0");
        $("#netsalary").val("0");
        $("#totalbonus").val("0");
        $("#totalovertime").val("0");
        $("#totalreduction").val("0");
        $("#fromdate").val("");
        $("todate").val("");
    }

    $("#resteBtn").click(function() {
        if ($("#datatablebody").is(':empty')) {
            ExecuteClear();
        } else {
            swal({
                    title: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        ExecuteClear();
                    } else {
                        //swal("Your imaginary file is safe!");
                    }
                });
        }

    });

    function Cinfirm() {
        swal("Successfully Data Save", "Data Submit", "success", {
                buttons: {
                    cancel: "Cancel",
                    Show: "Show",

                    catch: {
                        text: "Print",
                        value: "catch",
                    },
                    datapdf: {
                        text: "Pdf",
                        value: "datapdf",
                        background: "#endregion",
                    },
                    Cancel: false,
                },
            })
            .then((value) => {
                switch (value) {

                    case "Show":
                        url = "{{ url('Salary/show')}}" + '/' + salaryid,
                            window.location = url;
                        break;

                    case "catch":
                        PurchasePrint();
                        break;
                    case "datapdf":
                        url = "{{ url('Salary/pdf')}}" + '/' + purchaseid,
                            window.open(url, '_blank');
                        break;

                    default:
                        //swal("Thank You For Your Choice");
                }
            });
        ExecuteClear();
    }
</script>








<!-- <script type="text/javascript">
   
    $("form").submit(function(e){
        e.preventDefault();
        var name = $("input[name='name']").val();
        var email = $("input[name='email']").val();
     
        $(".data-table tbody").append("<tr data-name='"+name+"' data-email='"+email+"'><td>"+name+"</td><td>"+email+"</td><td><button class='btn btn-info btn-xs btn-edit'>Edit</button><button class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
    
        $("input[name='name']").val('');
        $("input[name='email']").val('');
    });
   
    $("body").on("click", ".btn-delete", function(){
        $(this).parents("tr").remove();
    });
    
    $("body").on("click", ".btn-edit", function(){
        var name = $(this).parents("tr").attr('data-name');
        var email = $(this).parents("tr").attr('data-email');
    
        $(this).parents("tr").find("td:eq(0)").html('<input name="edit_name" value="'+name+'">');
        $(this).parents("tr").find("td:eq(1)").html('<input name="edit_email" value="'+email+'">');
    
        $(this).parents("tr").find("td:eq(2)").prepend("<button class='btn btn-info btn-xs btn-update'>Update</button><button class='btn btn-warning btn-xs btn-cancel'>Cancel</button>")
        $(this).hide();
    });
   
    $("body").on("click", ".btn-cancel", function(){
        var name = $(this).parents("tr").attr('data-name');
        var email = $(this).parents("tr").attr('data-email');
    
        $(this).parents("tr").find("td:eq(0)").text(name);
        $(this).parents("tr").find("td:eq(1)").text(email);
   
        $(this).parents("tr").find(".btn-edit").show();
        $(this).parents("tr").find(".btn-update").remove();
        $(this).parents("tr").find(".btn-cancel").remove();
    });
   
    $("body").on("click", ".btn-update", function(){
        var name = $(this).parents("tr").find("input[name='edit_name']").val();
        var email = $(this).parents("tr").find("input[name='edit_email']").val();
    
        $(this).parents("tr").find("td:eq(0)").text(name);
        $(this).parents("tr").find("td:eq(1)").text(email);
     
        $(this).parents("tr").attr('data-name', name);
        $(this).parents("tr").attr('data-email', email);
    
        $(this).parents("tr").find(".btn-edit").show();
        $(this).parents("tr").find(".btn-cancel").remove();
        $(this).parents("tr").find(".btn-update").remove();
    });
    
</script> -->
@endsection