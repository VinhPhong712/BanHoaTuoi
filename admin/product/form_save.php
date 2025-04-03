<?php
include_once ('./create_slug.php');
if (!empty($_POST)) {
    $id = getPost('id');
    $name = getPost('name');
    $slug = to_slug($name);
    $category_id = getPost('category_id');
    $thumnail = moveFile('thumnail');  // Di chuyển ảnh chính
    $listImg_desct = $_FILES['thumnail_desct']['name'];  // Ảnh mô tả
    $price = getPost('price');
    $description = getPost('description');

    if ($id > 0) {
        // Cập nhật sản phẩm
        $slug = to_slug($name);
        if ($thumnail != '') {
            // Xóa ảnh cũ nếu có
            $sql = "SELECT img FROM product WHERE id = $id";
            $data = executeResult($sql, true);
            $thumnail_file = fixUrl($data['img']);
            if (file_exists($thumnail_file)) {
                unlink($thumnail_file);  // Xóa ảnh cũ
            }
            // Cập nhật sản phẩm với ảnh mới
            $sql = "UPDATE product SET img='$thumnail',slug = '$slug', name = '$name', category_id = '$category_id', price='$price', description='$description' WHERE id =$id";
            execute($sql);
        } else {
            // Cập nhật sản phẩm mà không thay đổi ảnh
            $sql = "UPDATE product SET name = '$name', slug = '$slug', category_id = '$category_id', price='$price', description='$description' WHERE id =$id";            
            execute($sql);
        }
        header('Location: index.php');
        die();
    } else {
        // Thêm mới sản phẩm
        if ($thumnail != '') {
            // Thêm sản phẩm mới với ảnh chính
            $sql = "INSERT INTO product (category_id, name, slug, price, img, description) 
                    VALUES ('$category_id', '$name', '$slug', '$price', '$thumnail', '$description')";
            execute($sql);

            // Thêm ảnh mô tả
            $sql = "SELECT * FROM product ORDER BY id DESC LIMIT 1";
            $id_product_array = executeResult($sql, true);
            $id_product = $id_product_array['id'];

            // Di chuyển và lưu ảnh mô tả
            $pathTemp = $_FILES['thumnail_desct']["tmp_name"];
            foreach ($listImg_desct as $key => $value) {
                $img_desct = "assets/photos/" . $value;
                // Di chuyển ảnh từ thư mục tạm
                move_uploaded_file($pathTemp[$key], "../../" . $img_desct);
                // Lưu vào database
                $sql = "INSERT INTO img_desct (img_desct, product_id) VALUES ('$img_desct', '$id_product')";
                execute($sql);
            }
            header('Location: index.php');
            die();
        }
    }
}
?>
