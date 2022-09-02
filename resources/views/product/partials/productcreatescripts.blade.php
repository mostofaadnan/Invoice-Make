<script type="text/javascript">
$( document ).ready(function() {
    var editRespomse = 0;
    function InputDate() {
    var myDate = $("#inputdate").attr('data-date');
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    var currentmonth = new Date(date.getFullYear(), date.getMonth());
    $('#inputdate').datepicker({
      dateFormat: 'yyyy/mm/dd',
      todayHighlight: true,
      startDate: today,
      endDate: end,
      autoclose: true
    });
    $('#inputdate').datepicker('setDate', myDate);
    $('#inputdate').datepicker('setDate', today);

  }
  window.onload = InputDate();
    function Barcode() {
      $.ajax({
        type: 'get',
        url: "{{ route('product.barcodemaker') }}",
        datatype: 'JSON',
        cache:false,
        success: function(data) {
          $("#barcodes").val(data);
        },
        error: function(data) {}
      });
    }

    function ItemDatalist() {
      $.ajax({
        type: 'get',
        url: "{{ route('product.itemdatalist') }}",
        datatype: 'JSON',
        success: function(data) {
          $('#product').html(data);
        },
        error: function(data) {}
      });
    }
    $('#vattype').change(function() {
      var vatid = $(this).val();

      $.ajax({
        type: 'get',
        url: "{{url('Vatsetting/Show')}}?dataid=" + vatid,
        cache: false,
        success: function(data) {
          if (data) {
            $("#vatvalue").val(data.value);
          } else {
            $("#vatvalue").val(0);
          }

        },
        error: function(data) {
          console.log(data);
        }
      });

    });

  window.onload = Barcode();
//    window.onload = ItemDatalist();

    $('#category').change(function() {
      var categoryid = $(this).val();
      if (categoryid) {
        $.ajax({
          type: "GET",
          url: "{{url('Product/get-subcategory-list')}}?category_id=" + categoryid,
          success: function(res) {
            if (res) {
              $("#subcategory").empty();
              $("#subcategory").append('<option>Select</option>');
              $.each(res, function(key, value) {
                $("#subcategory").append('<option value="' + key + '">' + value +
                  '</option>');
              });
            } else {
              $("#subcategory").empty();
            }
          }
        });
      } else {
        $("#subcategory").empty();

      }
    });
    $('#category').change(function() {
      var categoryid = $(this).val();
      if (categoryid) {
        $.ajax({
          type: "GET",
          url: "{{url('Product/get-Brand-list')}}?category_id=" + categoryid,
          success: function(data) {
            if (data) {
              $("#brand").empty();
              $("#brand").append('<option>Select</option>');
              $.each(data, function(index, value) {
                $("#brand").append('<option value="' + value.brand_name['id'] + '">' + value.brand_name['title'] + '</option>');
              });
            } else {
              $("#brand").empty();
            }
          }
        });
      } else {
        $("#brand").empty();

      }
    });

    //insert Data

    //$("#adddata").on("submit", function(e) {
    $(document).on("click", "#datainsert", function(e) {
      /* var editRespomse = 0; */
      console.log(editRespomse);
      var barcode = $("#barcodes").val();
      var name = $("#name").val();
      var category_id = $("#category").val();
      var subcategory_id = $("#subcategory").val();
      var brand_id = $("#brand").val();
      var unit_id = $("#unit").val();
      var openingdate = $("#inputdate").val();
      var tp = $("#tp").val();
      var mrp = $("#mrp").val();
      var remark = $("#remark").val();
      var status = $("#status").val();
      var vattype = $("#vattype").val();

      //var url = $(this).attr("action");
    /*   if (name == "" || category_id == "" || unit_id == "" || openingdate == "" || tp == "" || mrp == "" || vattype == "") {
        swal("Opps! Faild", "Requirment Field Error", "error");
      } else { */
        if (editRespomse == 0) {

          $.ajax({
            url: "{{ route('product.store') }} ",
            type: 'post',

            data: {
              barcode: barcode,
              name: name,
              category: category_id,
              subcategory: subcategory_id,
              brand: brand_id,
              unit: unit_id,
              openingdate: openingdate,
              tp: tp,
              mrp: mrp,
              vattype: vattype,
              remark: remark,
              status: status,
            },
            datatype: ("json"),

            success: function(data) {
              swal("Data Inserted Successfully", "Form Submited", "success", {
                timer: 2000
              });
              clear();

            },
            error: function(data) {
              swal("Opps! Faild", "Form Submited Faild1", "error");
              //console.log(data);
            }

          });

        } else {

          //update
          var dataid = $("#productid").val();
          $.ajax({
            url: "{{ route('product.dataUpdate') }}",
            // type: 'method',
            type: 'post',
            data: {
              dataid: dataid,
              barcode: barcode,
              name: name,
              category: category_id,
              subcategory: subcategory_id,
              brand: brand_id,
              unit: unit_id,
              openingdate: openingdate,
              tp: tp,
              mrp: mrp,
              vattype: vattype,
              remark: remark,
              status: status,
            },

            datatype: ("json"),
            success: function() {
              swal("Data Update Successfully", "Form Submited", "success", {
                timer: 2000
              });
              clear();

            },
            error: function(data) {
              swal("Opps! Faild", "Form Submited Faild", "error");
              console.log(data);
            }
          });
        }
     /*  } */
    });

    function clear() {
      editRespomse = 0;
      Barcode();
      ItemDatalist();
      InputDate();
      $("#productid").val("");
      $("#name").val("");
      $("#category").val("");
      $("#subcategory").empty();
      $("#brand").empty();
      $("#unit").val("");
      $("#tp").val("0");
      $("#mrp").val("0");
      $("#remark").val("");
      $("#status").val("1");
      $("#search").val("");
  /*     $("#vattype").val(""); */

    }
    $("#tp").on('click', function() {
      $("#tp").val("");
    })
    $("#mrp").on('click', function() {
      $("#mrp").val("");
    })


    // data view
    function getUrl() {
      var url = $(location).attr('href')
      var segment = url.split("/").length - 1 - (url.indexOf("http://") == -1 ? 0 : 2);
      if (segment == 3) {
        itemDetails();
      }
    }
    window.onload = getUrl();
    $("#search").on('input', function() {

      var val = this.value;
      if ($('#product option').filter(function() {
          return this.value.toUpperCase() === val.toUpperCase();
        }).length) {
        var productid = $('#product').find('option[value="' + val + '"]').attr('id');
        $.ajax({
          type: 'post',
          url: "{{ url('Session-Id/productId')}}" + '/' + productid,
          success: function() {
            itemDetails();
          }
        });
      }
    });

    function itemDetails() {
      $.ajax({
        type: 'get',
        url: "{{ route('product.getDataById') }}",
        //data: data,
        datatype: 'JSON',
        success: function(data) {
          editRespomse = 1;
          SubcategoryChange(data.category_id, data.subcategory_id);
          BrandChange(data.category_id, data.brand_id);
          $("#productid").val(data.id);
          $("#barcodes").val(data.barcode);
          $("#name").val(data.name);
          $("#category option[value='" + data.category_id + "']").attr('selected', 'selected');
          $("#unit option[value='" + data.unit_id + "']").attr('selected', 'selected');
          $("#inputdate").val(data.openingDate);
          $("#tp").val(data.tp);
          $("#mrp").val(data.mrp);
          $("#qty").val(data.qty);
          $("#remark").val(data.remark);
          $("#vattype option[value='" + data.VatSetting_id + "']").attr('selected', 'selected');
      //    $("#vatvalue").val(data.vat_name['value']);
          $("#status option[value='" + data.status + "']").attr('selected', 'selected');
        },
        error: function(data) {
          // console.log(data);
        }
      });
    }

    function SubcategoryChange(categoryid, subcategory_id) {
      if (categoryid) {
        $.ajax({
          type: "GET",
          url: "{{url('Product/get-subcategory-list')}}?category_id=" + categoryid,
          success: function(res) {
            if (res) {
              $("#subcategory").empty();
              $("#subcategory").append('<option>Select</option>');
              $.each(res, function(key, value) {
                $("#subcategory").append('<option value="' + key + '">' + value +
                  '</option>');
              });
              $("#subcategory option[value='" + subcategory_id + "']").attr('selected', 'selected');
            } else {
              $("#subcategory").empty();
            }
          }
        });
      } else {
        $("#subcategory").empty();

      }
    }

    function BrandChange(categoryid, brand_id) {
      if (categoryid) {
        $.ajax({
          type: "GET",
          url: "{{url('Product/get-Brand-list')}}?category_id=" + categoryid,
          success: function(data) {
            if (data) {
              $("#brand").empty();
              $("#brand").append('<option>Select</option>');
              $.each(data, function(index, value) {
                $("#brand").append('<option value="' + value.brand_name['id'] + '">' + value.brand_name['title'] + '</option>');
              });
              $("#brand option[value='" + brand_id + "']").attr('selected', 'selected');
            } else {
              $("#brand").empty();
            }
          }
        });
      } else {
        $("#brand").empty();

      }
    }

    //reset

    $("#reset").on("click", function(e) {
      clear();
      $("#vattype").val("");
      $("#vatvalue").val("0");
    });

    //data delete

    $("#deletedata").on("click", function(e) {
      if (editRespomse == 1) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this  data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              var dataid = $("#productid").val();
              $.ajax({
                type: "post",
                url: "{{ url('Product/delete')}}" + '/' + dataid,
                success: function(data) {
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

      }

    });

  });
</script>
