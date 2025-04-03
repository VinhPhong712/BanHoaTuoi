<?php
	$baseUrl = '../';
    include_once('../database/dbhelper.php');
    if(isset($_GET["slug"])) {
        $slug = $_GET["slug"];
        $sql = "SELECT * FROM product WHERE slug = '$slug'";
        $dataProduct = executeResult($sql,true);
        if($dataProduct == null) {
            header('Location: ../');
        }
    }else {
        header('Location: ../');
    }
    $id = $dataProduct['id'];
    $category_id = $dataProduct['category_id'];
    $title = $dataProduct['name'];
    include_once ($baseUrl.'layouts/header.php');
    $UrlCartView = '..';
    include ($baseUrl.'cart/add_cart.php');
    
?>
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/chitietsanpham.css">
<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_blog.jpg" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page"><?=$dataProduct['name']?></p>
        </div>
    </div>
</div>

<div class="grid wide">
    <div class="chitietsanpham">
        <div class="chitiet-header">
            <div class="row">
                <div class="col l-6 c-12">
                    <?php 
                        
                        // $x = $dataProduct['product_type'];
                        echo '<div class="chitiet-big-img">
                                <img src="'.$baseUrl.$dataProduct['img'].'" alt="" style="object-fit: cover">
                            </div>';
                    ?>
                    <div class="chitiet-small-img">
                        <?php
                        echo ' <div class="chitiet-small-box-img " style="height: 75px">
                                    <img src="'.$baseUrl.$dataProduct['img'].'" alt="" >
                                 </div>';
                        $sql = "SELECT img_desct FROM img_desct WHERE product_id = $id";
                        $img_desctItems = executeResult($sql);
                            foreach ($img_desctItems as $a => $b) {
                                foreach ($b as $c => $d) {
                                    $e = $baseUrl.$d;
                                    echo '<div class="chitiet-small-box-img " style="height: 75px">
                                            <img src="'.$e.'" alt="" >
                                        </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col l-6 c-12">
                    <div class="chitiet-description">
                        <div class="type-product">
                            <a href="" class="tag-a"><span style="text-transform: uppercase;">hoa tươi </span></a>
                        </div>
                        <div class="group-status">
                            <span class="frist-status">
                                Thương hiệu: <span class="status-name">Vinmart</span>
                            </span>
                            <span class="frist-status status-2">
                                <span class="line_tt hidden-sm" style="margin-right: 10px;">|</span>
                                Tình trạng: <span class="status-name">Còn hàng</span>
                            </span>
                        </div>
                        <div class="chitiet-des-name">
                            <span><?=$dataProduct['name']?></span>
                        </div>
                        <div class="chitiet-des-price">
                            <span><?=$dataProduct['price']?><sup>đ</sup></span>
                        </div>
                        <div class="product-description">
                            <span>Thông tin sản phẩm đang được cập nhật</span>
                        </div>
                        <form method="post" class="quantity-product">
                                <div class="box-quantity-product">
                                    <div class="so-luong">
                                        <h1>Số lượng: </h1>
                                    </div>
                                    <input type="button" value="-" class="tru" onclick="changeQuantity(-1)">
                                <input type="number" name="num" id="quantity" class="value-quantity" value="1" min="1">
                                <input type="button" value="+" class="cong" onclick="changeQuantity(1)">
                            </div>
                                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
                                <?php
                                    if(isset($_SESSION['email'])) {
                                        $Url_cart = 'cart/cart_home.php?add_to_cart='.$dataProduct['id'];
                                    }else {
                                        $Url_cart = 'authen/login';
                                    }
                                    echo '<button onclick=alertChitiet() data-title="'.$Url_cart.'" type="submit"  name="btn-add-cart" value="'.$id.'" class="chitiet-add-cart ">
                                        <h3>Thêm vào giỏ hàng</h3>
                                    </button>';
                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-product" style="margin-bottom: 30px;">
            <img src="../assets/img/bg_blog.jpg" xriginal="" alt="">
            <h1>OARS</h1>
            <h3>Hoa an tươi</h3>
        </div>
        <div class="chitiet-body">
            <div class="chitiet-body-header">
                <div class="chitiet-body-title">
                    <span class="chitiet-title-mota chitiet-body-active" data-title="#chitiet-mota">
                        Mô tả
                    </span>
                    <span class="chitiet-title-rate" data-title="#chitiet-rate">ĐÁNH GIÁ <p class="quantity-rate">(0)</p></span>
                </div>
                <div class="chitiet-mota chitiet-active" id="chitiet-mota">
                    <div class="chitiet-mota-text"><?=$dataProduct['description']?></div>
                </div>
                <div class="chitiet-rate" id="chitiet-rate">
                    <span>Chưa có đánh giá nào</span>
                    <div class="chitiet-rate-foot">Chỉ những khách hàng đã đăng nhập và mua sản phẩm này mới có thể đưa ra đánh giá.</div>
                </div>
            </div>
        </div>
        <div class="chitiet-foot">
            <div class="chitiet-foot-title">
                <span>SẢN PHẨM TƯƠNG TỰ</span>
            </div>
            <div class="grid wide product-selling-main">
                <div class="row">
                    <?php
                        $sql = "SELECT * FROM product WHERE id != $id AND category_id = '$category_id' limit 4";
                        $dataProduct = executeResult($sql);
                        foreach($dataProduct as $item) {
                            echo '
                                <div class="col l-3 c-6">
                                    <div class="content-tab-item">
                                        <div class="product-thumnail">
                                            <a href="'.$baseUrl.'sanpham/'.$item['slug'].'">
                                                <img src="'.$baseUrl.$item['img'].'" alt="">
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <div class="product-name">
                                                <h3>'.$item['name'].'</h3>
                                            </div>
                                            <div class="product-price">
                                                <h3>'.$item['price'].'</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	require_once($baseUrl.'layouts/footer.php');
?>
<script src="../assets/js/chitiet.js"></script>

<script>
    function alertChitiet() {
            const link_cart = 'cart/cart_home.php'
            const a = document.querySelector('.chitiet-add-cart')
            const attr = a.getAttribute('data-title')
            if(attr.indexOf(link_cart) !== -1) {
                return;
            }else {
                alert('Bạn hãy đăng nhập để thêm sản phẩm vào giỏ hàng của mình!!!')
            }
    }

    function changeQuantity(amount) {
    const quantityInput = document.getElementById('quantity');
    let currentValue = parseInt(quantityInput.value) || 1;

    // Tăng hoặc giảm giá trị
    currentValue += amount;

    // Đảm bảo giá trị tối thiểu là 1
    if (currentValue < 1) {
        currentValue = 1;
    }

    // Cập nhật lại giá trị vào ô input
    quantityInput.value = currentValue;
}

</script>