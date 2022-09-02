<script type="text/javascript">
    var response = 0;

    function formresponse() {
        $("#response").val(response);
    }
    window.onload = formresponse();
    $('#country').change(function() {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('Supplier/get-state-list')}}?country_id=" + countryID,
                success: function(res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
            $("#city").empty();
        }
    });
    $('#state').on('change', function() {
        var stateID = $(this).val();
        if (stateID) {
            $.ajax({
                type: "GET",
                url: "{{url('Supplier/get-city-list')}}?state_id=" + stateID,
                success: function(res) {
                    if (res) {
                        $("#city").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#city").append('<option value="' + key + '">' + value + '</option>');
                        });

                    } else {
                        $("#city").empty();
                    }
                }
            });
        } else {
            $("#city").empty();
        }

    });
    $(document).ready(function() {
        $("#openingbalance").val("");

        function calc() {
            var $num1 = ($.trim($("#openingbalance").val()) != "" && !isNaN($("#openingbalance").val())) ? parseInt($("#openingbalance").val()) : 0;
            var $num2 = 0;
            $("#balancedue").val($num1 + $num2);
        }
        $("#openingbalance").keyup(function() {
            calc();

        });
    });

    function SupplierDataList() {
        $.ajax({
            type: 'get',
            url: "{{ route('supplier.suplierdatalist') }}",
            datatype: 'JSON',
            success: function(data) {
                $('#supplier').html(data);
            },
            error: function(data) {

            }
        });
    }
    window.onload = SupplierDataList();
    $("#suppliersearch").on('input', function() {
        var val = this.value;
        if (val == "") {
            clear();
        } else {
            if ($('#supplier option').filter(function() {
                    return this.value.toUpperCase() === val.toUpperCase();
                }).length) {
                var supplierid = $('#supplier').find('option[value="' + val + '"]').attr('id');
                supplierinfo(supplierid);

            }
        }

    });

    function supplierinfo(supid) {
        $.ajax({
            type: 'get',
            url: "{{url('Supplier/supplierinfo')}}?supplierid=" + supid,
            success: function(data) {
                if (data.supplier) {
                    loadData(data.supplier);
                    if (data.supplier.category_name) {
                        mutiCategory(data.supplier.category_name);
                    }
                } else {
                    clear();
                }
            },
            error: function(data) {
                console.log(data);
            }
        });

    }

    function loadData(data) {
        var response = 1;
        formresponse();
        $('.img-preview').attr('src', '');
        var imagesrc = "{{ asset('images/supplier') }}/" + data.image;
        $('.img-preview').attr('src', imagesrc);
        var countryid = data.country_id;
        var stateid = data.state_id;
        var cityid = data.city_id;
        FindState(countryid, stateid);
        findCity(stateid, cityid);
        $("#supplierid").val(data.id);
        $("#sup_name").val(data.name);
        $("#country option[value='" + countryid + "']").attr('selected', 'selected')
        $("#addresstext").val(data.address);
        $("#tin").val(data.TIN);
        $("#postalcode").val(data.postalcode);
        $("#mobile_no").val(data.mobile_no);
        $("#tell_no").val(data.tell_no);
        $("#fax_no").val(data.fax_no);
        $("#status option[value='" + data.status + "']").attr('selected', 'selected')
        $("#supemail").val(data.email);
        $("#website").val(data.website);
        $("#openingdate").val(data.openingDate);
        $("#openingbalance").val(data.openingBalance);
        $("#consignment").val(data.consignment);
        $("#payment").val(data.payment);
        $("#discount").val(data.totaldiscount);
        $("#balancedue").val(data.balancedue);
    }

    function mutiCategory(data) {
        data.forEach(function(value) {
            console.log(value.category_id);
            $("#multicategory option[value='" + value.category_id + "']").attr('selected', 'selected')
        })
    }

    function clear() {
        response = 0;
        formresponse();
        $('.img-preview').attr('src', '');
        var src = "{{asset('assets/images/avater/avater.jpg')}}";
        $('.img-preview').attr('src', src);
        $("#supplierid").val("");
        $("#sup_name").val("");
        $("#country").val("Select");
        $("#state").empty();
        $("#city").empty();
        $("#addresstext").val("");
        $("#postalcode").val("");
        $("#mobile_no").val("");
        $("#tell_no").val("");
        $("#fax_no").val("");
        $("#supemail").val("");
        $("#website").val("");
        $("#tin").val("");
        $("#openingdate").val("");
        $("#openingbalance").val(0);
        $("#consignment").val(0);
        $("#payment").val(0);
        $("#discount").val(0);
        $("#balancedue").val(0);

    }

    function FindState(countryID, stateid) {
        if (countryID) {
            $.ajax({
                type: "GET",
                url: "{{url('State/get-state-list')}}?country_id=" + countryID,
                success: function(res) {
                    if (res) {
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#state").append('<option value="' + key + '">' + value + '</option>');
                        });

                        $("#state option[value='" + stateid + "']").attr('selected', 'selected');
                    } else {
                        $("#state").empty();
                    }
                }
            });
        } else {
            $("#state").empty();
            $("#city").empty();
        }
    }

    function findCity(stateID, cityid) {
        if (stateID) {
            $.ajax({
                type: "GET",
                url: "{{url('City/get-city-list')}}?state_id=" + stateID,
                success: function(res) {
                    if (res) {
                        $("#city").empty();
                        $("#city").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#city").append('<option value="' + key + '">' + value + '</option>');
                        });
                        $("#city option[value='" + cityid + "']").attr('selected', 'selected');
                    } else {
                        $("#city").empty();
                    }
                }
            });
        } else {
            $("#city").empty();
        }

    }
</script>