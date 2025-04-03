<?php
ob_start();
if (session_id() === '') {
    session_start();
}
require_once($baseUrl . './utils/ulitity.php');
require_once($baseUrl . 'database/dbhelper.php');
require_once($baseUrl . 'utils/convert_tv.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="../css/main.css"> -->
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/grid.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/main.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/header.css">

    <link rel="stylesheet" href="<?= $baseUrl ?>chatbox.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
</head>
<div class="header">
    <div class="grid wide">
        <div class="row">
            <label for="nav-mobile-input" class="icon-bar-mobile c-2">
                <i class="fas fa-bars"></i>
            </label>
            <?php
            include_once $baseUrl . 'layouts/nav_mobile.php';
            ?>
            <div class="col l-3 c-6">
                <div class="logo-header">
                    <a href="<?= $baseUrl ?>">
                        <img style="height: 100px; width:100px; object-fit:cover;" src="<?= $baseUrl ?>assets/img/logoshop.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col l-7 header-nav-box">
                <div class="header-nav">
                    <ul class="items-big">
                        <li class="nav-item tag-li ">
                            <a href="<?= $baseUrl ?>" class="tag-a">
                                <span class="danhmuc-trangchu">Trang chủ</span>
                            </a>
                        </li>
                        <li class="nav-item tag-li ">
                            <a href="<?= $baseUrl ?>gioithieu" class="tag-a">
                                <span class="danhmuc-gioithieu">Giới thiệu</span>
                            </a>
                        </li>
                        <li class="nav-item tag-li ">
                            <a href="<?= $baseUrl ?>allproduct/index.php" class="tag-a"><span class="danhmuc-sanpham">Sản phẩm<i class="fa-solid fa-caret-down"></i></span>
                            </a>
                            <ul class="item-small">
                                <li class="tag-li"><a href="<?= $baseUrl ?>hoasinhnhat" class="tag-a">Hoa Sinh Nhật</a></li>
                                <li class="tag-li"><a href="<?= $baseUrl ?>hoatraicay" class="tag-a">Hoa Trái Cây</a></li>
                                <li class="tag-li"><a href="<?= $baseUrl ?>hoabo" class="tag-a">Hoa Bó</a></li>
                                <li class="tag-li"><a href="<?= $baseUrl ?>hoachucmung" class="tag-a">Hoa Chúc Mừng</a></li>
                            </ul>
                        </li>
                        <li class="nav-item tag-li ">
                            <a href="<?= $baseUrl ?>blog" class="tag-a">
                                <span class="danhmuc-blog">Blog</span>
                            </a>
                        </li>
                        <li class="nav-item tag-li ">
                            <a href="<?= $baseUrl ?>account/lienhe/index.php" class="tag-a">
                                <span class="danhmuc-lienhe">Liên hệ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col l-2 c-4">
                <div class="cart-group">
                    <div class="icon-search cart-group-item">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <div class="search-mini">
                            <form action="http://localhost/weborganic/layouts/search.php" method="POST">
                                <input type="text" name="name" placeholder="Tìm kiếm..." class="button_gradient input-header">
                                <button class="btn-search-mini" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="user-icon cart-group-item">
                        <i class="fa-solid fa-user-plus"></i>
                        <div class="user-group">
                            <?php
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];
                                $sql = "SELECT * FROM users WHERE email = '$email'";
                                $data = executeResult($sql, true);
                                echo '
                                        <a href="' . $baseUrl . 'account" class="dang-nhap user-group-item tag-a button_gradient" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;max-width: 180px;">' . $data['fullname'] . '</a>
                                        <a href="' . $baseUrl . 'order" class="dang-nhap your-oder user-group-item tag-a button_gradient" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;max-width: 180px;">Đơn hàng</a>
                                        <a href="' . $baseUrl . 'account/logout.php" class="dang-ki dang-xuat user-group-item tag-a ">Đăng xuất</a>
                                    ';
                            } else {
                                echo '
                                        <a href="' . $baseUrl . 'account/login" class="dang-nhap user-group-item tag-a button_gradient">Đăng nhập</a>
                                        <a href="' . $baseUrl . 'account/register" class="dang-ki user-group-item tag-a ">Đăng ký</a>
                                    ';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="cart-icon cart-group-item">
                        <a href="<?= $baseUrl ?>cart" class="tag-a">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <?php
                            if (isset($_SESSION['email'])) {
                                $email =  $_SESSION['email'];
                                $sql = "SELECT * FROM users WHERE email ='$email'";
                                $data = executeResult($sql, true);
                                $user_name = $data['fullname'];
                                $sql = "SELECT * FROM cart WHERE user_name= '$user_name'";
                                $cart_List = executeResult($sql);
                                echo '
                                    <span class="quanity-icon-cart button_gradient">' . count($cart_List) . '</span>
                                    ';
                            } else {
                                echo '<span class="quanity-icon-cart button_gradient">0</span>';
                            }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-icon">
        <!-- <a href="tel:0334277969" class="tag-a"> -->
        <!-- <div class="icon-item-box">
            <div class="icon-des-item icon-des-phone">
                <span>Gọi ngay cho chúng tôi</span>
            </div>
            <div class="icon-item icon-phone">
                <svg width="45" height="45" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="22" cy="22" r="22" fill="url(#paint2_linear)"></circle>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0087 9.35552C14.1581 9.40663 14.3885 9.52591 14.5208 9.61114C15.3315 10.148 17.5888 13.0324 18.3271 14.4726C18.7495 15.2949 18.8903 15.9041 18.758 16.3558C18.6214 16.8415 18.3953 17.0971 17.384 17.9109C16.9786 18.239 16.5988 18.5756 16.5391 18.6651C16.3855 18.8866 16.2617 19.3212 16.2617 19.628C16.266 20.3395 16.7269 21.6305 17.3328 22.6232C17.8021 23.3944 18.6428 24.3828 19.4749 25.1413C20.452 26.0361 21.314 26.6453 22.2869 27.1268C23.5372 27.7488 24.301 27.9064 24.86 27.6466C25.0008 27.5826 25.1501 27.4974 25.1971 27.4591C25.2397 27.4208 25.5683 27.0202 25.9268 26.5772C26.618 25.7079 26.7759 25.5674 27.2496 25.4055C27.8513 25.201 28.4657 25.2563 29.0844 25.5716C29.5538 25.8145 30.5779 26.4493 31.2393 26.9095C32.1098 27.5187 33.9703 29.0355 34.2221 29.3381C34.6658 29.8834 34.7427 30.5821 34.4439 31.3534C34.1281 32.1671 32.8992 33.6925 32.0415 34.3444C31.2649 34.9323 30.7145 35.1581 29.9891 35.1922C29.3917 35.222 29.1442 35.1709 28.3804 34.8556C22.3893 32.3887 17.6059 28.7075 13.8081 23.65C11.8239 21.0084 10.3134 18.2688 9.28067 15.427C8.67905 13.7696 8.64921 13.0495 9.14413 12.2017C9.35753 11.8438 10.2664 10.9575 10.9278 10.4633C12.0288 9.64524 12.5365 9.34273 12.9419 9.25754C13.2193 9.19787 13.7014 9.24473 14.0087 9.35552Z" fill="white"></path>
                    <defs>
                        <linearGradient id="paint2_linear" x1="22" y1="-7.26346e-09" x2="22.1219" y2="40.5458" gradientUnits="userSpaceOnUse">
                            <stop offset="50%" stop-color="#e8434c"></stop>
                            <stop offset="100%" stop-color="#d61114"></stop>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div> -->
        <!-- </a> -->
        <!-- <a href="<?= $baseUrl ?>https://www.zalo.me/0933960295" class="tag-a"> -->
        <!-- <div class="icon-item-box">
            <!-- Nút tròn mở chatbox -->
            <!-- <div class="icon-item-box">
                <div class="icon-des-item icon-des-chat">
                    <span>Chat với chúng tôi</span>
                </div>
                <div class="icon-item icon-chat" onclick="toggleChatbox()">
                    <svg width="45" height="45" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="22" cy="22" r="22" fill="url(#paint2_linear)"></circle>
                        <path d="M11 15h22v10H15l-4 4V15Z" fill="white"></path>
                    </svg>
                        </div>
            </div>  -->

            <!-- Hộp chat -->
            <!-- <div class="chatbox-container" id="chatbox">
                <div class="chatbox-header">
                    <span>Chat với chúng tôi</span>
                    <button onclick="toggleChatbox()">✖</button>
                </div>
                <div class="chatbox-content" id="chatContent">
                    <p>Xin chào! Bạn cần hỗ trợ gì?</p>
                </div>
                <div class="chatbox-input">
                    <input type="text" id="userMessage" placeholder="Nhập tin nhắn..." onkeypress="handleKeyPress(event)">
                    <button onclick="sendMessage()">Gửi</button>
                </div>
            </div>

        </div> -->
        <!-- </a>
        <a href="<?= $baseUrl ?>https://www.facebook.com/phong.vinh.77964201?mibextid=ZbWKwL
" class="tag-a">
            <div class="icon-item-box">
                <div class="icon-des-item icon-des-messenger">
                    <span>Nhắn tin Messenger cho chúng tôi</span>
                </div>
                <div class="icon-item icon-messenger">
                    <svg width="45" height="45" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="22" cy="22" r="22" fill="url(#paint3_linear)"></circle>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.0026 7.70215C14.1041 7.70215 7.70117 13.6308 7.70117 20.9442C7.70117 25.1115 9.78083 28.8286 13.0309 31.256V36.305L17.9004 33.6325C19.2 33.9922 20.5767 34.1863 22.0026 34.1863C29.9011 34.1863 36.304 28.2576 36.304 20.9442C36.304 13.6308 29.9011 7.70215 22.0026 7.70215ZM23.4221 25.5314L19.7801 21.6471L12.6738 25.5314L20.4908 17.2331L24.2216 21.1174L31.239 17.2331L23.4221 25.5314Z" fill="white"></path>
                        <defs>
                            <linearGradient id="paint3_linear" x1="21.6426" y1="43.3555" x2="21.6426" y2="0.428639" gradientUnits="userSpaceOnUse">
                                <stop offset="50%" stop-color="#1168CF"></stop>
                            <stop offset="100%" stop-color="#2CB7FF"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </a>
        <div class="icon-item-box">
            <div class="icon-des-item icon-des-email">
                <span>Gửi email cho chúng tôi</span>
            </div>
            <div class="icon-item icon-email">
                <svg width="45" height="45" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="22" cy="22" r="22" fill="url(#paint5_linear)"></circle>
					<path d="M22 10C17.0374 10 13 13.7367 13 18.3297C13 24.0297 21.0541 32.3978 21.397 32.7512C21.7191 33.0832 22.2815 33.0826 22.603 32.7512C22.9459 32.3978 31 24.0297 31 18.3297C30.9999 13.7367 26.9626 10 22 10ZM22 22.5206C19.5032 22.5206 17.4719 20.6406 17.4719 18.3297C17.4719 16.0188 19.5032 14.1388 22 14.1388C24.4968 14.1388 26.528 16.0189 26.528 18.3297C26.528 20.6406 24.4968 22.5206 22 22.5206Z" fill="white"></path>
					<defs>
						<linearGradient id="paint5_linear" x1="22" y1="0" x2="22" y2="44" gradientUnits="userSpaceOnUse">
							<stop offset="50%" stop-color="#FECF72"></stop>
							<stop offset="100%" stop-color="#EF9F00"></stop>
						</linearGradient>
					</defs>
				</svg>
            </div>
        </div>-->
        <!-- <div class="icon-item-box">
            <div class="icon-des-item icon-des-address">
                <span>Gửi Email</span>
            </div>
            <div class="icon-item icon-address">
                <svg width="45" height="45" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="22" cy="22" r="22" fill="url(#paint1_linear)"></circle>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4589 11.6667H32.5414C33.1621 11.6667 33.6993 11.8861 34.153 12.3245C34.6062 12.7634 34.8332 13.2904 34.8332 13.9064C34.8332 14.6435 34.599 15.3481 34.1319 16.0197C33.6639 16.6914 33.0816 17.2655 32.3846 17.7413C30.0672 19.3131 28.3185 20.4998 27.1311 21.3061C26.4785 21.7489 25.9931 22.0787 25.6817 22.2905C25.6355 22.3222 25.5634 22.3723 25.4675 22.4396C25.3643 22.5117 25.2337 22.6037 25.0729 22.7174C24.7625 22.9368 24.5048 23.114 24.2994 23.2495C24.0938 23.3846 23.8457 23.5363 23.5545 23.7043C23.2631 23.8724 22.9887 23.9983 22.7309 24.0823C22.4731 24.1661 22.2344 24.2082 22.0148 24.2082H22.0006H21.9863C21.7667 24.2082 21.5281 24.1661 21.2702 24.0823C21.0125 23.9983 20.7378 23.8721 20.4466 23.7043C20.1552 23.5363 19.9068 23.385 19.7017 23.2495C19.4964 23.114 19.2386 22.9368 18.9284 22.7174C18.7672 22.6037 18.6366 22.5118 18.5334 22.4393L18.5233 22.4323C18.4325 22.3688 18.3638 22.3208 18.3195 22.2905C17.9197 22.0157 17.4354 21.6846 16.8739 21.3022C16.2152 20.8532 15.4486 20.3329 14.5671 19.7359C12.9342 18.6303 11.9554 17.9654 11.6308 17.7413C11.0388 17.3494 10.4802 16.8107 9.95513 16.1248C9.43011 15.4387 9.16748 14.8018 9.16748 14.214C9.16748 13.4864 9.36539 12.8796 9.76184 12.3944C10.158 11.9095 10.7234 11.6667 11.4589 11.6667ZM33.4002 19.2392C31.4494 20.5296 29.7913 21.6405 28.4258 22.5725L34.8324 28.8337V18.0213C34.4217 18.4695 33.9443 18.8752 33.4002 19.2392ZM9.1665 18.0214C9.58659 18.4788 10.0691 18.8848 10.6132 19.2393C12.6414 20.5863 14.2935 21.6952 15.5757 22.5701L9.1665 28.8335V18.0214ZM34.0421 30.8208C33.6172 31.1883 33.1173 31.3745 32.5403 31.3745H11.4578C10.8809 31.3745 10.3807 31.1883 9.95575 30.8208L17.2287 23.7122C17.4107 23.8399 17.5789 23.9592 17.7306 24.0679C18.2751 24.4597 18.7165 24.7654 19.0556 24.9845C19.3944 25.2041 19.8455 25.4279 20.4091 25.6564C20.9726 25.8853 21.4976 25.9993 21.9847 25.9993H21.9989H22.0132C22.5002 25.9993 23.0253 25.8852 23.5888 25.6564C24.152 25.4279 24.6032 25.2041 24.9423 24.9845C25.2814 24.7654 25.7231 24.4597 26.2672 24.0679C26.427 23.955 26.5961 23.8362 26.7705 23.7141L34.0421 30.8208Z" fill="white"></path>
                    <defs>
                        <linearGradient id="paint1_linear" x1="22" y1="0" x2="22" y2="44" gradientUnits="userSpaceOnUse">
                            <stop offset="50%" stop-color="#70f3ff"></stop>
                            <stop offset="100%" stop-color="#00dcf0"></stop>
                        </linearGradient>
                    </defs>
                </svg>
            </div>

        </div> -->

    </div>
    <a href="#" id="backtop" class="tag-a backtop" title="Lên đầu trang">
        <div class="border-backtop">
            <i class="fas fa-arrow-up"></i>
        </div>
    </a>
</div>
<script>
    document.onscroll = function(e) {
        if (window.pageYOffset > 500) {
            console.log(123)
            document.querySelector('#backtop').style.bottom = '10px'
        } else {
            document.querySelector('#backtop').style.bottom = '-55px'
        }
    }
    const logout = document.querySelector('.dang-xuat')
    logout.onclick = () => {
        alert('Đăng xuất thành công')
    }
</script>
<!-- <script src="chatbox.js"></script> -->