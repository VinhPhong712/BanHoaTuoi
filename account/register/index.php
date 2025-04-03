<?php
    $title = 'Đăng ký';
    $baseUrl = '../../';
    include_once $baseUrl.'layouts/header.php';
    include_once 'process_login.php';
?>
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/account.css">
<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="<?=$baseUrl?>assets/img/bg_blog.jpg" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Tài khoản</p>
        </div>
    </div>
</div>
<div class="login-main">
    <div class="login-container">
        <div class="login-title">
            <h3>Đăng ký</h3>
            <div style="color: red;text-align:center;"><?=$msg?></div>
        </div>
        <div class="login-chu-y">
            <span>Nếu bạn chưa có tài khoản, đăng ký tại đây.</span>
        </div>
        <div class="container-form">
            <form action="" method="post" class="form-account">
                <div class="form-group">
                    <label for="">Họ và tên:</label>
                    <input require name="fullname" type="text" placeholder="Họ và tên...">
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <input require name="email"  type="email" placeholder="Email...">
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại:</label>
                    <input require name="phone_user"  type="tel" placeholder="Số điện thoại..." pattern="[0-9]{10}" title="Số điện thoại phải có 10 chữ số">
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ:</label>
                    <input require name="address_user"  type="text" placeholder="Địa chỉ...">
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu:</label>
                    <input require type="password" id="pwd" name="password" placeholder="Mật khẩu..." minlength="6">
                </div>
                <div class="form-group" onkeyup="validateForm()">
                    <label for="">Nhập lại mật khẩu:</label>
                    <input require type="password"  id="confirmation_pwd"   placeholder="Nhập lại mật khẩu...">
                    <label for="" style="color: red; display:none;" class="warning_pwd">Mật khẩu không khớp</label>
                </div>
                <div class="group-btn">
                    <button type="submit" class="btn-account">Đăng ký</button>
                    <a href="../login" class="tag-a">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const pwd = document.querySelector('#pwd').value
        const confirm_pwd = document.querySelector('#confirmation_pwd').value
        if(pwd != confirm_pwd) {
            document.querySelector('.warning_pwd').style.display = 'block'
            document.querySelector('.btn-account').style.cursor = 'not-allowed'
        }else {
            document.querySelector('.warning_pwd').style.display = 'none'
            document.querySelector('.btn-account').style.cursor = 'pointer'
        }
    }
</script>

<?php
    include_once $baseUrl.'layouts/footer.php';
?>