<?php
	$title = 'Quản lý danh mục';
	$baseUrl = '../';
	require_once($baseUrl.'layouts/header.php');

	$itemsPerPage = 5;

	// Get the current page number from the query string
	$page = isset($_GET['page']) ? $_GET['page'] : 1;

	// Calculate the offset for the query
	$offset = ($page - 1) * $itemsPerPage;

	$sql = "SELECT *  from category LIMIT $offset, $itemsPerPage";
	$data = executeResult($sql);
	$totalRows = executeCountTotal('SELECT *  from category');
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

	.nav-item:nth-child(5) {
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
		<h3>Quản lý danh mục</h3>
		<a href="editor.php"><button type="submit" class="btn btn-success" style="margin-top: 10px;">Thêm danh mục</button></a>
		<table class="table table-bordered table-hover" style="margin-top: 15px;">
			<!-- <thead> -->
				<tr>
					<th>STT</th>
					<th>Tên danh mục</th>
					<th style="width: 150px;">Tùy chỉnh</th>
					<th style="width: 150px;">Tùy chỉnh</th>
				</tr>
				<!-- <td><img class="thumnail" src="'.'../../'.$item['thumnail'].'" alt=""></td> -->
				<!-- ../../assets/photos/244746673_668612887369866_6774119670192200319_n.jpg -->
				<?php
				$index = 0;
				foreach($data as $item) {
					echo '
						<tr>
						<th>'.(++$index).'</th>
						<td>'.$item['name'].'</td>
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
		<?php
				$totalPages = ceil($totalRows / $itemsPerPage);
					echo '<div class="pagination">';
					for ($i = 1; $i <= $totalPages; $i++) {
						$isActive = ($i == $page) ? 'active' : '';
					
						echo '<a href="?page=' . $i . '" class="pagination-link ' . $isActive . '">' . $i . '</a>';
					}
				?>
	</div>
</div>

<?php
	require_once($baseUrl.'layouts/footer.php');
?>
<script>
	// Dùng ajax
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
			location.reload()
		})
	}
</script>