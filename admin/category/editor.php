<?php   
    $title = "Thêm/Sửa danh mục";
    $baseUrl = '../';
    require_once('../layouts/header.php');
    $id = $name = '';

    require_once('./form_save.php');
    $id = getGet('id');
    if($id != null && $id > 0) {
        $sql = "select * from category where id = '$id'";
        $productItem = executeResult($sql,true);
        if($productItem != null) {
            $name = $productItem['name'];
        }
        else {
            $id = 0;
        }
    }else {
        $id = 0;
    }
    
?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<!-- <script src="../../ckfinder/ckfinder.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<div class="row">
	<div class="col-md-12" style="margin: 30px 0;">
		<h3>Thêm/sửa danh mục</h3>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Tên danh mục:</label>
                        <input type="text" required="true" class="form-control" name="name" value="<?=$name?>" placeholder="Nhập tên danh mục">
                        <input type="text" class="form-control" name="id" value="<?=$id?>" hidden="true" >
                    </div>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>
	</div>
</div>