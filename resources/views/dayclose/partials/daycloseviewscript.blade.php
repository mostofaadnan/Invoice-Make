<script>
    var urlid;

    function getUrl() {
        var url = $(location).attr('href')
        var segment = url.split("/").length - 1 - (url.indexOf("http://") == -1 ? 0 : 2);
        if (segment == 3) {
            urlid = url.substring(url.lastIndexOf('/') + 1);
            DayCloseInfo(urlid);
        }
    }
  /*   $('#datetimepicker').on('change', function(e) {
        var date = $("#dateinput").val();
        $.ajax({
            type: "get",
            data: {
                date: date
            },
            url: "{{ url('Day-Close/getviewbydate')}}",
            datatype: ("json"),
            success: function(data) {
                if (!$.trim(data)) {
                    urlid = data.id;
                    LoadData(data);
                } else {
                 $("#date").html("");
                    $("#cashinvoice").html("")
                    $("#creditinvoice").html("")
                    $("#salereturn").html("")
                    $("#purchase").html("")
                    $("#grn").html("")
                    $("#purchasereturn").html("");
                    $("#supplierpayment").html("")
                    $("#customerpayment").html("")
                    $("#expenses").html("")
                    $("#cashin").html("");
                    $("#cashout").html("");
                    $("#cashdrawer").html("");
                    $("#cashinbank").html("");
                    $("#stockamount").html("");
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }) */

    function DayCloseInfo(id) {
        $.ajax({
            type: "get",
            url: "{{ url('Day-Close/getView')}}" + '/' + id,
            datatype: ("json"),
            success: function(data) {
                LoadData(data);
            },
            error: function(data) {

            }
        });
    }
    var type;
    function LoadData(data) {
        // $("#dateinput").val(data.date);
       type=data.type;
        if(type==1){
            $("#date").html(data.date);
            $("#monthview").hide();
            $("#yearview").hide()
            $("#type").html('Daily')
        }else if(type==2){
            $("#date").html(data.created_at);
            $("#monthview").show();
            $("#yearview").hide()
            $("#month").html(data.month);
            $("#type").html('Mothly')
        }else{
            $("#date").html(data.created_at);
            $("#monthview").hide();
            $("#yearview").show()
            $("#year").html(data.year);
            $("#type").html('Yearly')
        }

        $("#cashinvoice").html(data.cashinvoice)
        $("#creditinvoice").html(data.creditinvoice)
        $("#salereturn").html(data.salereturn)
        $("#purchase").html(data.purchase)
        $("#grn").html(data.grn)
        $("#purchasereturn").html(data.purchasereturn);
        $("#supplierpayment").html(data.supplierpayment)
        $("#customerpayment").html(data.creditpayment)
        $("#expenses").html(data.expenses)
        $("#cashin").html(data.cashin);
        $("#cashout").html(data.cashout);
        $("#cashdrawer").html(data.cashdrawer);
        $("#cashinbank").html(data.cashinbank);
        $("#stockamount").html(data.stockamount);
    }
    window.onload = getUrl();
    $("#pdf").on('click', function() {

        url = "{{ url('Day-Close/dayclosepdf')}}" + '/' + urlid,
            window.open(url, '_blank');

    });
    // data Delete
    $(document).on('click', '#datadelete', function() {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this  data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                  
                    $.ajax({
                        type: "post",
                        url: "{{ url('Day-Close/delete')}}" + '/' + urlid,
                        success: function(data) {
                             if(type==1){
                                url = "{{ url('Day-Close')}}",
                                window.location = url;
                             }else if(type==2){
                                url = "{{ url('Day-Close/monthly')}}",
                                window.location = url;
                             }else{
                               /*  url = "{{ url('Day-Close')}}",
                                window.location = url; */
                             }
                           
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
                   
                    $.ajax({
                        type: "post",
                        url: "{{ url('Day-Close/delete')}}" + '/' + urlid,
                        success: function(data) {
                            if(type==1){
                                url = "{{ url('Day-Close/create')}}",
                                window.location = url;
                             }else if(type==2){
                                url = "{{ url('Day-Close/monthlycreate')}}",
                                window.location = url;
                             }else{
                               /*  url = "{{ url('Day-Close')}}",
                                window.location = url; */
                             }
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