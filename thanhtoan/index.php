<?php
    $baseUrl = '../';
    $title = 'PHƯƠNG THỨC THANH TOÁN';
    include_once $baseUrl.'layouts/header.php';
?>
<style>
    .ul {
        margin-top: 10px;
        margin-left: 15px;
        margin-bottom:20px
    }
    .ul li {
        font-size: 17px;
        margin: 4px 0;
    }
</style>
<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_blog.jpg" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page"><?=$title?></p>
        </div>
    </div>
</div>
<div class="grid wide">
    <div style="display: flex;font-size: 19px;"><p style="font-weight:600;">1</p>. Mua hàng và thanh toán trực tiếp tại cửa hàng:</div>
    <ul class="ul">
        <li class="tag-li">- Địa chỉ: 180 Đường Cao Lỗ - Phường 4 - Quận 8 - Thành Phố HCM</li>
        <li class="tag-li">- Thời gian: Mở cửa từ 7h00 – 20h00.</li>
        <li class="tag-li">- Hình thức thanh toán: Chúng tôi nhận thanh toán bằng thẻ VISA, MasterCard, VNPAYQR, MOMO và các thẻ nội địa khác.</li>
    </ul>
    <div style="display: flex;font-size: 19px;"><p style="font-weight:600;">2</p>. Giao hàng trong ngày và thu tiền tận nơi:</div>
    <ul class="ul">
        <li class="tag-li">- Website: <a href="../../oars.epizy.com" class="tag-a">oars.epizy.com</a></li>
        <li class="tag-li">- Thời gian: Mở cửa từ 7h00 – 20h00.</li>
        <li class="tag-li">- Hình thức thanh toán: Chúng tôi nhận thanh toán bằng thẻ VISA, MasterCard, VNPAYQR, MOMO và các thẻ nội địa khác.</li>
    </ul>
    <p class="head" style="font-size: 20px;font-weight: 600;margin:7px 0;">HƯỚNG DẪN ĐẶT HÀNG</p>
    <div style="display: flex;font-size: 19px;margin-top:20px;"><p style="font-weight:600;">Bước 1</p>: Chọn sản phẩm muốn mua:</div>
    <img style="margin-top: 10px;width:100%;" src="../assets/img/b1.png" alt="">
    <div style="display: flex;font-size: 19px;margin-top:20px;"><p style="font-weight:600;">Bước 2</p>: Vào kiểm tra giỏ hàng:</div>
    <img style="margin-top: 10px;width:100%;" src="../assets/img/b2.png" alt="">
    <div style="display: flex;font-size: 19px;margin-top:20px;"><p style="font-weight:600;">Bước 3</p>: Nhấn nút đặt hàng:</div>
    <img style="margin-top: 10px;width:100%;" src="../assets/img/b3.png" alt="">
    <div style="display: flex;font-size: 19px;margin-top:20px;"><p style="font-weight:600;width:130px;">Bước 4</p>: Xem lại danh sách sản phẩm đã chọn và số tiền cần thanh toán. nội dung liên quan đến các chi phí như chi phí giao hàng….Nhập họ tên, địa chỉ, số điện thoại, địa chỉ, email (hay số điện thoại di động). Và chọn phương thức thanh toán.:</div>
    <img style="margin-top: 10px;width:100%;" src="../assets/img/b4.png" alt="">
</div>
<?php
    include_once $baseUrl.'layouts/footer.php';
?>
