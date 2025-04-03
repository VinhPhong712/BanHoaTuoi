<?php
$title = 'Blog';
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
        .lien-he {
            padding: 0 15px;
        }
    }
</style>

<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_blog.jpg" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Blog</p>
        </div>
    </div>
</div>
<div class="lien-he">
    <div class="grid wide">
        <div class="row">
            <div class="col l-12">
                <div class="page-title category-title">
                    <h1 class="title-head"><a href="#" class="tag-a">Blog</a></h1>
                </div>
                <main>
                    <section class="blog-posts">                        
                        <article class="blog-post">
                            <h2>Tiêu đề bài viết</h2>
                            <p class="post-info">Đăng bởi Admin vào ngày 25/11/2023</p>
                            <p>Nội dung bài viết...</p>
                            <a href="single_post.php">Đọc thêm</a><br>
                        </article><br>
                        <article class="blog-post">
                            <h2>Nghệ thuật cắm hoa tươi</h2>
                            <p class="post-info">Đăng bởi Admin vào ngày 10/10/2023</p>
                            <img src="../assets/img/NghethuatCamHoaTuoi.jpg" width="1280" height="760" alt="Nghệ thuật cắm hoa tươi">
                            <p>Nghệ thuật cắm hoa không chỉ đơn thuần là việc sắp xếp các loại hoa một cách ngẫu nhiên. Đó là một quá trình kỹ thuật, sáng tạo và tâm huyết để tạo ra những bức tranh hoa tươi tuyệt vời.</p>
                            <a href="single_post.php">Đọc thêm</a>
                        </article>

                        <article class="blog-post">
                            <h2>Chăm sóc hoa trong mùa đông</h2>
                            <p class="post-info">Đăng bởi Admin vào ngày 15/11/2023</p>
                            <img src="../assets/img/chamsochoamuadong.jpg" width="1280" height="760" alt="Chăm sóc hoa trong mùa đông">
                            <p>Mùa đông đến, là lúc mà việc chăm sóc hoa cần được chú ý đặc biệt. Bằng cách bảo vệ chúng khỏi lạnh, cung cấp đủ ánh sáng và nước, bạn có thể giữ cho hoa của mình tươi tắn qua mùa này.</p>
                            <a href="single_post.php">Đọc thêm</a>
                        </article>

                        <article class="blog-post">
                            <h2>Hoa làm quà tặng ý nghĩa</h2>
                            <p class="post-info">Đăng bởi Admin vào ngày 20/12/2023</p>
                            <img src="../assets/img/hopquahoatuoi.jpg" width="1280" height="760" alt="Hoa làm quà tặng ý nghĩa">
                            <p>Những bó hoa tươi không chỉ là một món quà đẹp mắt mà còn chứa đựng nhiều ý nghĩa tinh tế. Chúng là cách tuyệt vời để thể hiện tình cảm, sẻ chia và gửi đi những thông điệp ý nghĩa đến người thân yêu.</p>
                            <a href="single_post.php">Đọc thêm</a>
                        </article>

                    </section>
                </main>
            </div>
        </div>
    </div>
</div>




<?php
include_once($baseUrl . 'layouts/footer.php');
?>