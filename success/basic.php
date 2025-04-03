<?php
    $title = "Đặt hàng";
    $baseUrl = '../';
    include_once ($baseUrl.'layouts/header.php');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/checkouts_product.css">
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/success.css">

<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_blog.jpg" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Đặt hàng thành công</p>
        </div>
    </div>
</div>
<div class="order-success">
    <div class="grid wide">
        <div class="row">
            <div class="order-success2col l-7">
                <div class="order-heading">
                    <h2 class="order-head-title flex">
                        Đặt hàng thành công
                        <div class="icon-check">
                            <i class="fa-solid fa-check"></i>
                        </div>
                    </h2>
                    <?php
                    $sql2 = "SELECT MAX(stt) as max_stt FROM orders";
                    $data2 = executeResult($sql2,true);
                    $max_stt = $data2['max_stt'];
                    $sql = "SELECT * FROM orders WHERE user_name1 = '$user_name' AND stt='$max_stt'";
                    $data = executeResult($sql,true);
                    ?>
                    <span class="order-thank-you">Cảm ơn bạn đã mua hàng</span>
                </div>
                <div class="infor-order">
                    <h3>Thông tin giao hàng</h3>
                    <div class="content-main">
                        <div class="form-group flex">
                            <span>Họ và tên người nhận hàng:</span>
                            <span><?=$data['user_name']?></span>
                        </div>
                        <div class="form-group flex">
                            <span>Số điện thoại:</span>
                            <span><?=$data['phone_number']?></span>
                        </div>
                        <div class="form-group flex">
                            <span>Địa chỉ nhận hàng:</span>
                            <span><?=$data['address']?></span>
                        </div>
                        <div class="form-group flex">
                            <span>Phương thức thanh toán:</span>
                            <span><?=$data['phuong_thuc']?></span>
                        </div>

                    </div>
                </div>

                <div class="order-footer">
                    <a href="../" class="tag-a">
                        <span>Tiếp tục mua hàng</span>
                    </a>
                </div>
            </div>
            <?php
            include_once('../layouts/success_basic.php');
            ?>
        </div>
    </div>
</div>
<?php
    include_once ($baseUrl.'layouts/footer.php');
?>