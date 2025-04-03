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
            <p class="title-page">Xác nhận đặt hàng</p>
        </div>
    </div>
</div>
<div class="order-success">
    <div class="grid wide">
        <div class="row">
            <div class="order-success2col l-7">
                <div class="order-heading">
                    <h2 class="order-head-title flex">
                        Thanh toán trực tuyến
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
                    <span class="order-thank-you">Dịch vụ thanh toán trực tuyến</span>
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

                <div class="container-bank">
            <div class="grid wide">
                <div class="row infor-order">
                    <div class="col l-12 style='position:relative;' ">
                    <div class="wrapper-payment-right">
                        <div class="pr-title">
                            <span class="">Chuyển khoản bằng QR</span>
                        </div>
                        <div class="pr-qr-code">
                            <!-- <div class="pr-img">
                                <img src="https://img.vietqr.io/image/Vietcombank-9353538222-znVvEh.jpg?accountName=Cong%20Ty%20Co%20Phan%20Cong%20Nghe%20Giao%20duc%20F8&amount=1299000&addInfo=F8C1EGPA" alt="" class="">
                            </div> -->
                            <ul class="pr-qr-detail">
                                <li class="tag-li">Bước 1: Mở app Momo và quét mã QR.</li>
                                <li class="tag-li">Bước 2: Đảm bảo nội dung chuyển khoản là:
                                    <?php 
                                    if(isset($_SESSION['email'])) {
                                        $email = $_SESSION['email'];
                                        $sql = "SELECT id FROM users WHERE email = '$email'";
                                        $data = executeResult($sql,true);
                                        $id = $data['id'];
                                        $id2 = "FA6ORG$id";
                                        echo    
                                            '<span class="ma-kh">'.$id2.'</span>
                                            <input hidden value="'.$id2.'" type="text" name="ma"><br>';
                                    }
                                    ?>
                                </li>
                                <li class="tag-li">Bước 3: Thực hiện thanh toán.</li>
                            </ul>
                        </div>
                        <div class="pr-title pr-title-bottom">
                            <span class="">Chuyển khoản thủ công</span>
                        </div>
                        <div class="pr-qr-hand">
                            <div class="pr-qr-box">
                                <div class="pr-qr-item">
                                    <div class="pr-qr-item-tit">
                                        <span class="">Số tài khoản</span>
                                    </div>
                                    <div class="pr-qr-item-content">
                                        <span class="">0123456789</span>
                                    </div>
                                </div>
                                <div class="pr-qr-item">
                                    <div class="pr-qr-item-tit">
                                        <span class="">Tên tài khoản</span>
                                    </div>
                                    <div class="pr-qr-item-content">
                                        <span class="">NGUYỄN VĂN ADMIN</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pr-qr-box">
                                <div class="pr-qr-item">
                                    <div class="pr-qr-item-tit">
                                        <span class="">Nội dung</span>
                                    </div>
                                    <div class="pr-qr-item-content">
                                        <span class=""><?=$id2?></span>
                                    </div>
                                </div>
                                <div class="pr-qr-item">
                                    <div class="pr-qr-item-tit">
                                        <span class="">Chi nhánh</span>
                                    </div>
                                    <div class="pr-qr-item-content">
                                        <span class="">MB BANK Đà nẵng</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pay-attention">
                            <h3 class="" style="font-weight: 600;">Lưu ý</h3>
                            <span class="pa1">Tối đa 60 phút sau thời gian chuyển khoản, nếu hệ thống không phản hồi vui lòng liên hệ ngay bộ phận hỗ trợ của ORGANIC.</span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div> 
            <div class="order-footer">
                <a href="../" class="tag-a">
                    <span>Tiếp tục mua hàng</span>
                </a>
            </div>
            <?php
            include_once('../layouts/success.php');
            ?>
        </div>
    </div>
</div>
<?php
    include_once ($baseUrl.'layouts/footer.php');
?>