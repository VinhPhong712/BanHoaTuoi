<?php
	$title = 'Thống kê Doanh thu';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');
	if(isset($_POST['submit'])) {
		$date1=  $_POST['date1'];
    	$date2=  $_POST['date2'];
	}else{
		$date1 = date("Y-m-d");
		$date2 = date("Y-m-d");
	}
	$sql = " ( SELECT DATE(STR_TO_DATE(created_at, '%e-%c-%Y')) as created_at,  SUM(CAST(REPLACE(total,',','') AS UNSIGNED INTEGER)) as total  FROM orders  GROUP BY DATE(created_at) HAVING DATE(created_at) BETWEEN '$date1' and '$date2' ORDER BY created_at) UNION ALL ( SELECT NULL , (SELECT SUM(CAST(REPLACE(total,',','') AS UNSIGNED INTEGER))  FROM orders WHERE DATE(STR_TO_DATE(created_at, '%e-%c-%Y')) BETWEEN '$date1' and '$date2') );";
    $data = executeResult($sql);
?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<style> 
	.nav-item:nth-child(6) {
		background-color: #c1c1c1;
	}
</style>
<div class="row">
	<div class="col-md-12 table-responsive" style="margin-top: 30px;">
		<h3>Quản lý Doanh thu</h3>
		<div class="box-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div width="200" height="100" style="padding-top: 20px;">
                                <input class="form-control from" name="from" type="date">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div width="200" height="100" style="padding-top: 20px;">
                                <input class="form-control to" name="to" type="date">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div width="200" height="100" style="padding-top: 20px;">
                                <a href="" data-url="filter_post.php" class="btn btn-info" id="loc">Lọc</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="chart" style="height: 250px;"></div>
                </div>
	</div>
</div>

<?php
	require_once($baseUrl.'layouts/footer.php');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
	$(function () {
    $("#loc").click(function (e) {
        e.preventDefault();
        const url = $(this).data("url");
        const form = $(".from").val();
        const to = $(".to").val();
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {
                form: form,
                to: to,
            },
            success: function (res) {
                const data = res ? res : [{ period: "0", quantity: 0, price: 0 }];
               
                chart.setData(data);
            },
        });
    });
});

</script>
<script>
	// morris chat js
var chart = new Morris.Bar({
    // ID of the element in which to draw the chart.
    element: "chart",
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    hideHover: true,
    data: [{ period: "0", quantity: 0, price: 0 }],
    // The name of the data record attribute that contains x-values.
    xkey: "period",
    // A list of names of data record attributes that contain y-values.
    ykeys: ["quantity", "price"],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ["Tổng số đơn đã bán", "Doanh thu (VNĐ)"],
        formatter: function (value, data) {
            return formatCurrency(value); // Định dạng VNĐ
        }
    });


</script>

<script>
    $.ajax({
        url: 'filter.php',
        type: 'GET', // phương truyền tải dữ liệu
        success: function(res) {
            
            const data = JSON.parse(res);
            chart.setData(data);
        },
        error: function(e) { // lỗi nếu có
            console.log(e);
        }
    });
</script>