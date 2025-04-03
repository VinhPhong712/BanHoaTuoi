<?php   
    $title = "Thêm/Sửa sản phẩm";
    $baseUrl = '../';
    require_once('../layouts/header.php');
    $id = $thumnail = $name = $price = $category_id = $description = '';
    $img_desctItems = [];
    require_once('./form_save.php');
    $id = getGet('id');
    if($id != null && $id > 0) {
        $sql = "select * from product where id = '$id'";
        $productItem = executeResult($sql,true);
        if($productItem != null) {
            $thumnail = $productItem['img'];
            $name = $productItem['name'];
            $price = $productItem['price'];
            $category_id = $productItem['category_id'];
            $description = $productItem['description'];
        }
        else {
            $id = 0;
        }
        $sql = "SELECT img_desct FROM img_desct WHERE product_id = $id";
        $img_desctItems = executeResult($sql);
    }else {
        $id = 0;
    }
    $sql = "select * from category";
    $categoryItems = executeResult($sql);
    // $sql = "SELECT * FROM product_type";
    // $product_typeItems = executeResult($sql);
    
?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<!-- <script src="../../ckfinder/ckfinder.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<div class="row">
	<div class="col-md-12" style="margin: 30px 0;">
		<h3>Thêm/sửa sản phẩm</h3>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Tên sản phẩm:</label>
                        <input type="text" required="true" class="form-control" name="name" value="<?=$name?>" placeholder="Nhập tên sản phẩm">
                        <input type="text" class="form-control" name="id" value="<?=$id?>" hidden="true" >
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Danh mục sản phẩm:</label>
                        <select name="category_id" id="category_id" class="form-control" required="true">
                            <option value="">-- Chọn --</option>
                            <?php 
                                foreach($categoryItems as $item) {
                                    if($item['id'] == $category_id) {
                                        echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option>';
                                    } else {
                                        echo '<option  value="'.$item['id'].'">'.$item['name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Ảnh :</label>
                        <input type="file"  class="form-control thumnail" name="thumnail" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        <img src="<?=fixUrl($thumnail)?>" alt="" style="max-width: 150px;max-height:150px; margin-top: 10px;" class="thumnail_img">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Ảnh mô tả:</label>
                        <input type="file"  multiple class="form-control thumnail" name="thumnail_desct[]" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                        <?php
                            foreach ($img_desctItems as $a => $b) {
                                foreach ($b as $c => $d) {
                                    $e = fixUrl($d);
                                    echo '
                                        <img src="'.$e.'" alt="" style="max-width: 150px;max-height:150px; margin-top: 10px;" class="thumnail_img">
                                    ';
                                }
                            }
                        ?>

                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Giá:</label>
                        <input type="text" required="true" class="form-control" name="price" value="<?=$price?>" placeholder="Nhập giá">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Mô tả:</label>
                        <textarea class="form-group" name="description" id="" style="width: 100%;" rows="5"><?=$description?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>
	</div>
</div>






<script>
    function updateThumnail() {
        $('.thumnail_img').attr('src', $('.thumnail').val())
    }
    // CKEDITOR.replace( 'description' );
    CKEDITOR.replace( 'description', {
        // // filebrowserBrowseUrl: '';
        // filebrowserBrowseUrl: '../ckfinder/ckfinder.html',
        // filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    } );
    $(document).ready(function() {
        $('#category_id').change(function() {
            // alert($(this).val())
            const category_id = $(this).val()
            $.get("form_ajax_product.php",{category_id_ajax:category_id},function(data) {
                $("#product-type").html(data);
            })
        })
    })
</script>