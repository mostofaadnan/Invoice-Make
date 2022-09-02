<script>
    var wastageid;

    function getUrl() {
        var url = $(location).attr('href')
        var segment = url.split("/").length - 1 - (url.indexOf("http://") == -1 ? 0 : 2);
        if (segment == 3) {
            wastageid = url.substring(url.lastIndexOf('/') + 1);
            WastageDtails();
        }
    }
    window.onload = getUrl();

    function WastageDtails() {
        $.ajax({
            type: "get",
            url: "{{ url('Wastage/getview')}}" + '/' + wastageid,
            datatype: ("json"),
            success: function(data) {
                lodData(data);

            },
            error: function(data) {

            }

        });
    }

    function lodData(data) {
        $("#date").html(data.inputdate)
        $("#nettotal").html(data.nettotal)
        $("#remark").html(data.remark)
        loadTableDetails(data);

    }

    function loadTableDetails(data) {
        $("#tablebody").empty();
        var sl = 1;
        data.w_datils.forEach(function(value) {
            $(".data-table tbody").append("<tr>" +
                "<td>" + sl + "</td>" +
                "<td class='itemname'>" + value.product_name['name'] + "</td>" +
                "<td align='right'>" + value.qty + "</td>" +
                "<td>" + value.product_name.unit_name['Shortcut'] + "</td>" +
                "<td align='right'>" + value.tp + "</td>" +
                "<td align='right' class='vat'>" + value.amount + "</td>" +
                "</tr>");
            sl++;
        })
    }
   
    $("#invoicepdf").on('click', function() {

        url = "{{ url('Wastage/wastagepdf')}}" + '/' + wastageid,
            window.open(url, '_blank');

    });
</script>