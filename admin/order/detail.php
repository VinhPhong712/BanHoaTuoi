
<?php
	$title = 'Quản lý người dùng';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');

    $id = getGet('id');
    $stt = getGet('stt');
	$sql = "SELECT use_neme FROM users WHERE id = '$id'";
	$data = executeResult($sql,true);
    $full_name = $data['use_name'];
    $sql = "SELECT * FROM orders WHERE user_name1 = '$full_name' AND stt='$stt'";
    $data= executeResult($sql);
?>

<link rel="stylesheet" href="./detail.css">
<style> 
	.nav-item:nth-child(3) {
		background-color: #c1c1c1;
	}
</style>
<div class="row">
	<div class="col-md-12 table-responsive" style="margin-top: 30px;">
		<h3>Chi tiết đơn hàng</h3>


		<table class="table table-bordered table-hover" style="margin-top: 15px;">
			<!-- <thead> -->
				<tr>
					<th>STT</th>
					<th>Tên người nhận</th>
					<th>Đơn hàng</th>
					<th>Số lượng</th>
					<th>Giá</th>
				</tr>
			<!-- </thead> -->
			<!-- <tbody> -->
				<?php
				$index = 0;
				foreach($data as $item) {
                    $product_id = $item['product_id'];
                    $sql = "SELECT name FROM product WHERE id='$product_id'";
                    $name_product = executeResult($sql,true);
                    $sql = "SELECT price FROM product WHERE id='$product_id'";
                    $price_product = executeResult($sql,true);
                    $price = intval(preg_replace('/[^\d.]/', '', $price_product['price']));
                    $money_detail = $item['num'] * $price;
					$thanh_toan = $item['status'];
					$list_thanh_toan = ['Đang xử lý','Đã xác nhận','Đang giao','Đã giao','Đã hủy','Đã thanh toán'];
					echo '
					<form method="post" action="" enctype="multipart/form-data">
						<tr>
                            <th>'.(++$index).'</th>
                            <td>'.$item['user_name'].'</td>
                            <td>'.$name_product['name'].'</td>
                            <td>'.$item['num'].'</td>
                            <td>'.number_format($money_detail).'đ</td>';
							
							echo '
								</select>
							</td>
						</tr>
					</form>
					';
				}
				?>
			<!-- </tbody> -->
		</table>
	</div>
</div>

<?php
	require_once($baseUrl.'layouts/footer.php');
?>