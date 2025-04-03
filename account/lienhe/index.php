<?php
     $baseUrl = '../../';
    $title = 'Liên hệ';
    include_once($baseUrl.'layouts/header.php')
?>

<style>
    .lienhe-address {
        padding-bottom: 20px;
        border-bottom: 1px solid #d9cfcf;
    }
    .footer-col1-item {
    display: flex;
    margin: 15px 0;
    }
    .footer-col1-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid #91ad41;
        margin-right: 10px;
        color: #91ad41;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;

    }
    .footer-col1-item span {
        padding-top: 5px;
        display: block;
        font-size: 15px;
    }
    .lienhe-contact {
        padding-top: 20px;
    }
    .lien-he-form {
        margin-top: 15px;
    }
    .lien-he-form input{
        outline: none;
        border-radius: 25px;
        border: 1px solid #ece4e4;
        padding: 10px 20px;
        font-size: 16px;
        width: 100%;
    }
    .lien-he-button {
        margin-top: 20px;
        padding: 10px 30px;
        border: none;
        border-radius: 20px;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
    }
    .gg-map-mobile {
        display: none;
    }
    @media  screen and (max-width:740px) {
        .lienhe-address,.lienhe-contact {
            margin: 0 20px;
        }
        .gg-map-pc {
            display: none;
        }
        .gg-map-mobile {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    }
</style>

<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_breadcrumb.png" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Liên hệ</p>
        </div>
    </div>
</div>
<div class="lienhe-main">
    <div class="grid wide">
        <div class="row">
            <div class="col l-4 c-12">
                <div class="lienhe-address">
                    <div class="footer-col1-item">
                        <div class="footer-col1-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <span>180 cao lỗ, phường 4 , quận 8, TP.HCM</span>
                    </div>
                    <div class="footer-col1-item">
                        <div class="footer-col1-icon">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </div>
                        <span>0933960295</span>
                    </div>
                    <div class="footer-col1-item">
                        <div class="footer-col1-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <span>Votruonggiang264@gmail.com</span>
                    </div>
                </div>
                <div class="lienhe-contact">
                    <div class="lienhe-title">
                        <h2>Liên hệ với chúng tôi</h2>
                    </div>
                    <form action="" method="post">
                        <div class="lien-he-form">
                            <input require type="text" placeholder="Họ và tên" class="name">
                        </div>
                        <div class="lien-he-form">
                            <input require type="email" placeholder="Email" name="email">
                        </div>
                        <div class="lien-he-form">
                            <input require type="text" placeholder="Nội dung" name="content">
                        </div>
                        <button class="button_gradient lien-he-button">Gửi liên hệ</button>
                    </form>
                </div>
            </div>
            <div class="col l-8 c-12 gg-map-pc">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15673.706597297356!2d106.75626331925154!3d10.855118400131115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527994a4e2d9d%3A0xa10a25dfe5ce2e7c!2zTGluaCBDaGnhu4N1LCBUaOG7pyDEkOG7qWMsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1646831641540!5m2!1svi!2s" width="700" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col c-12 gg-map-mobile">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15673.706597297356!2d106.75626331925154!3d10.855118400131115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527994a4e2d9d%3A0xa10a25dfe5ce2e7c!2zTGluaCBDaGnhu4N1LCBUaOG7pyDEkOG7qWMsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1646831641540!5m2!1svi!2s" width="390" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
<?php
    include_once($baseUrl.'layouts/footer.php')
?>