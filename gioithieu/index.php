<?php
$title = 'Giới thiệu';
$baseUrl = '../';
include_once($baseUrl . 'layouts/header.php');
?>
<style>
    .content-page {
        padding: 15px 0;
    }

    .title-head a {
        color: #000;
    }

    @media screen and (max-width:740px) {
        .gioi-thieu {
            padding: 0 15px;
        }
    }

    main {
        padding: 20px;
    }

    .intro {
        text-align: center;
        margin-bottom: 30px;
    }

    .info {
        margin-bottom: 20px;
    }

    .mission {
        background-color: #f4f4f4;
        padding: 20px;
        margin-top: 30px;
        text-align: center;
    }

    .contact-info {
        background-color: #e9e9e9;
        padding: 20px;
        margin-top: 30px;
    }

    .contact-info h4 {
        margin-bottom: 10px;
    }
</style>

<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_blog.jpg" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Giới thiệu</p>
        </div>
    </div>
</div>
<div class="gioi-thieu">
    <div class="grid wide">
        <div class="row">
            <div class="col l-12">
                <div class="page-title category-title">               
                </div>
                <main>
                    <div class="intro">
                        <h2>Chào mừng bạn đến với Shop Hoa Tươi!</h2>
                        <p>Chúng tôi cung cấp những bó hoa tươi đẹp nhất và dịch vụ tốt nhất cho bạn.</p>
                    </div>
                    <div class="info">
                        <h3>Giới thiệu về shop</h3>
                        <p>Shop Hoa Tươi là nơi bạn có thể tìm thấy những bó hoa tươi đẹp nhất với nhiều loại hoa phong phú. Chúng tôi cam kết cung cấp những sản phẩm chất lượng nhất và dịch vụ tận tâm nhất đến với khách hàng.</p>
                    </div>
                    <div class="info">
                        <h3>Dịch vụ của chúng tôi</h3>
                        <p>- Bó hoa tươi</p>
                        <p>- Giao hàng nhanh chóng và đúng hẹn</p>
                        <p>- Dịch vụ chăm sóc khách hàng 24/7</p>
                    </div>

                    <!-- Thêm phần sứ mệnh -->
                    <div class="mission">
                        <h3>Sứ Mệnh Của Chúng Tôi</h3>
                        <p>Chúng tôi luôn cam kết mang đến cho khách hàng những bó hoa tươi đẹp, những sản phẩm chất lượng vượt trội, cùng dịch vụ giao hàng nhanh chóng và chuyên nghiệp. Sự hài lòng của bạn là ưu tiên hàng đầu của chúng tôi.</p>
                    </div>

                    <!-- Thêm phần cam kết chất lượng -->
                    <div class="info">
                        <h3>Cam Kết Chất Lượng</h3>
                        <p>Chúng tôi chỉ sử dụng hoa tươi chất lượng cao, được nhập khẩu từ những nguồn đáng tin cậy. Mỗi bó hoa đều được cắm tỉ mỉ và chăm sóc cẩn thận để đảm bảo sự tươi mới, đẹp mắt trong suốt thời gian sử dụng.</p>
                    </div>

                    <!-- Thêm phần thông tin liên hệ -->
                    <div class="contact-info">
                        <h4>Thông Tin Liên Hệ</h4>
                        <p><strong>Địa chỉ:</strong> 123 Đường Hoa, Thành Phố Xinh Đẹp</p>
                        <p><strong>Số điện thoại:</strong> 0123456789</p>
                        <p><strong>Email:</strong> info@shophoatuoi.com</p>
                        <p><strong>Website:</strong> www.shophoatuoi.com</p>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

<?php
include_once($baseUrl . 'layouts/footer.php');
?>
