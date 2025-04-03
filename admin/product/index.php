<?php
	$title = 'Quản lý sản phẩm';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');

	$itemsPerPage = 5;

	// Lấy số trang hiện tại từ query string
	$page = isset($_GET['page']) ? $_GET['page'] : 1;

	// Tính toán offset cho câu truy vấn
	$offset = ($page - 1) * $itemsPerPage;

	// Truy vấn để lấy sản phẩm và danh mục
	$sql = "SELECT product.*, category.name as category_name from product 
			left join category on product.category_id = category.id 
			LIMIT $offset, $itemsPerPage";
	$data = executeResult($sql);

	// Truy vấn để đếm tổng số sản phẩm
	$totalRows = executeCountTotal('SELECT product.*, category.name as category_name from product 
									left join category on product.category_id = category.id');
?>

<style> 
.my-table {
  width: 100%;
  border-collapse: collapse;
}

.my-table th,
.my-table td {
  padding: 8px;
  border: 1px solid #ddd;
}

.pagination {
	float: right;
  margin-top: 20px;
}

.pagination-link {
  padding: 4px 8px;
  text-decoration: none;
  background-color: #f2f2f2;
  color: #333;
  text-decoration: none;
  margin-right: 4px;
}

.pagination-link.active {
  background-color: #333;
  color: #fff;
}

.pagination-link:hover {
	text-decoration: none;
  background-color: #ddd;
}

	.nav-item:nth-child(2) {
		background-color: #c1c1c1;
	}
	.thumnail {
		max-width: 80px;
		max-height: 80px;
		object-fit: cover;
	}
	.description h1,
	.description h2,
	.description h3,
	.description h4,
	.description h5,
	.description h6,
	.description li,
	.description span,
	.description p,
	.description b
	{
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
		max-width: 100px;
	}
	.description ul {
		padding: 0 !important;
	}
</style>

<div class="row">
	<div class="col-md-12 table-responsive" style="margin-top: 30px;">
		<h3>Quản lý sản phẩm</h3>
		<a href="editor.php"><button type="submit" class="btn btn-success" style="margin-top: 10px;">Thêm sản phẩm</button></a>
		<table class="table table-bordered table-hover" style="margin-top: 15px;">
			<tr>
				<th>STT</th>
				<th>Tên sp</th>
				<th>Danh mục</th>
				<th>Giá</th>
				<th>Ảnh chính</th>
				<th style="width: 50px;">Tùy chỉnh</th>
				<th style="width: 50px;">Tùy chỉnh</th>
			</tr>
			<?php
			$index = 0;
			foreach($data as $item) {
				$category_id = $item['category_id'];
				$sql = "SELECT name from category WHERE id = '$category_id'";
				$name_category = executeResult($sql, true);
				echo '
					<tr>
					<th>'.(++$index).'</th>
					<td>'.$item['name'].'</td>
					<td>'.$name_category['name'].'</td>
					<td>'.$item['price'].' <sup>đ</sup></td>
					<td><img class="thumnail" src="'.fixUrl($item['img']).'" alt=""></td>
					<th style="width: 40px; height:40px;" >
						<a href="editor.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
					</th>
					<th style="width: 50px;" >
						<button onclick="deleteProduct('.$item['id'].')" class="btn btn-danger">Xóa</button>
					</th>
					</tr>
				';
			}
			?>
		</table>
		
		<?php
			$totalPages = ceil($totalRows / $itemsPerPage);
			echo '<div class="pagination">';
			for ($i = 1; $i <= $totalPages; $i++) {
				$isActive = ($i == $page) ? 'active' : '';
				echo '<a href="?page=' . $i . '" class="pagination-link ' . $isActive . '">' . $i . '</a>';
			}
			echo '</div>';
		?>
	</div>
</div>

<?php
	require_once($baseUrl.'layouts/footer.php');
?>

<script>
	// Dùng ajax để xóa sản phẩm
	function deleteProduct(id) {
		option = confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')
		if(!option) return;
		$.post('form_api.php', {
			'id': id,
			'action': 'delete'
		}, function(data) {
			if(data != null && data != '') {
				alert(data);
			}
			location.reload() // reload lại trang sau khi xóa
		})
	}
</script>
