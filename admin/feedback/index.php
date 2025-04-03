<?php
	$title = 'Quản lý tài khoản';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');
    $sql = "SELECT * FROM users";
    $data = executeResult($sql);
?>
<style> 
	.nav-item:nth-child(4) {
		background-color: #c1c1c1;
	}
</style>
<div class="row">
	<div class="col-md-12 table-responsive" style="margin-top: 30px;">
		<h3>Quản lý tài khoản</h3>
		<table class="table table-bordered table-hover" style="margin-top: 15px;">
			<!-- <thead> -->
				<tr>
					<th>STT</th>
					<th>Họ & tên</th>
					<th>Email</th>
					<th>Password</th>
					<th>Hành động</th>
					<th>Hành động</th>
				</tr>
				<?php
				$index = 0;
				foreach($data as $item) {
					echo '
						<tr>
						<th>'.(++$index).'</th>
						<td>'.$item['fullname'].'</td>
						<td>'.$item['email'].'</td>
						<td>'.'********'.'</td>

						<th style="width: 40px; height:40px;" >
						<a href="editor.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
					</th>
					<th style="width: 50px;" >
							<button onclick = deleteProduct('.$item['id'].') class="btn btn-danger">Xóa</button>
						</th>
                        </tr>
					';
				}
				?>
		</table>
	</div>
</div>

<?php
	require_once($baseUrl.'layouts/footer.php');
?>

<script>
	// Dùng ajax
	function deleteProduct(id) {
		option = confirm('Bạn có chắc chắn muốn tài khoản này không?')
		if(!option) return;
		$.post('form_api.php', {
			'id': id,
			'action': 'delete'
		}, function(data) {
			if(data != null && data != '') {
				alert(data);
			}
			location.reload()
		})
	}
</script>
