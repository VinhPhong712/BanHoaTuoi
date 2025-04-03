<?php
    $title = 'Tất cả sản phẩm';
    $baseUrl = '../';
    include_once $baseUrl.'layouts/header.php';
?>

<link rel="stylesheet" href="<?=$baseUrl?>assets/css/category-main.css">

<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_breadcrumb.jpg" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Tất cả sản phẩm</p>
        </div>
    </div>
</div>

<div class="category-main">
    <div class="grid wide">
        <!-- Phần Sắp Xếp -->
        <div class="category-header">
            <h1>Tất cả sản phẩm</h1>
            <div class="arrange">
                <div class="sort-cate">
                    <h3>Sắp xếp theo:</h3>
                    <ul class="sort-cate-list">
                        <li><a href="?sort=az&page=1" class="btn-quick-sort">A → Z</a></li>
                        <li><a href="?sort=za&page=1" class="btn-quick-sort">Z → A</a></li>
                        <li><a href="?sort=price_asc&page=1" class="btn-quick-sort">Giá tăng dần</a></li>
                        <li><a href="?sort=price_desc&page=1" class="btn-quick-sort">Giá giảm dần</a></li>
                    </ul>
                    
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="content-tab content-tab-block">
            <div class="row">
                <?php
                    // Xử lý tham số sắp xếp
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
                    $orderBy = "ORDER BY id DESC";

                    switch ($sort) {
                        case 'az':
                            $orderBy = "ORDER BY name ASC";
                            break;
                        case 'za':
                            $orderBy = "ORDER BY name DESC";
                            break;
                        case 'price_asc':
                            $orderBy = "ORDER BY price ASC";
                            break;
                        case 'price_desc':
                            $orderBy = "ORDER BY price DESC";
                            break;
                    }

                    // Phân trang
                    $sql = "SELECT count(id) as number FROM product";
                    $data = executeResult($sql, true);
                    $number = ($data != null && count($data) > 0) ? $data['number'] : 0;

                    $limit = 12;
                    $page = ceil($number / $limit);
                    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $index = ($current_page - 1) * $limit;

                    // Lấy dữ liệu sản phẩm theo sắp xếp và phân trang
                    $sql = "SELECT * FROM product $orderBy LIMIT $index, $limit";
                    $products = executeResult($sql);

                    foreach ($products as $item) {
                        $formatted_price = number_format((float)$item['price'], 0, ',', '.');
                        echo '
                        <div class="col l-3 c-6">
                            <div class="content-tab-item">
                                <div class="product-thumnail">
                                    <a href="'.$baseUrl.'sanpham/?slug='.$item['slug'].'">
                                        <img src="'.$baseUrl.$item['img'].'" alt="">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <div class="product-name">
                                        <h3>'.$item['name'].'</h3>
                                    </div>
                                    <div class="product-price">
                                        <span>'.$item['price'].' <sup>đ</sup></span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                ?>
            </div>

            <!-- Phân trang -->
            <?php
                if ($page > 1) {
                    echo '<div class="pagination">
                            <div class="total-page"><span>Trang '.$current_page.' trên '.$page.'</span></div>';
                    for ($i = 1; $i <= $page; $i++) {
                        $active = ($i == $current_page) ? 'page-current' : '';
                        echo '<a href="?sort='.$sort.'&page='.$i.'" class="tag-a page-items '.$active.'">'.$i.'</a>';
                    }
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</div>

<?php include_once $baseUrl.'layouts/footer.php'; ?>
