<?php
    $baseUrl = '../';
    include_once $baseUrl.'layouts/header.php';

    // Lấy `category_id` từ URL hoặc gán giá trị mặc định (ví dụ: 1)
    
    // Lấy `title` từ URL hoặc gán giá trị mặc định
   

    // Lấy tham số 'sort' từ URL
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

    // Xây dựng câu lệnh ORDER BY dựa trên tham số 'sort'
    $orderBy = '';
    switch ($sort) {
        case 'az':
            $orderBy = 'ORDER BY name ASC';
            break;
        case 'za':
            $orderBy = 'ORDER BY name DESC';
            break;
        case 'price_asc':
            $orderBy = 'ORDER BY price ASC';
            break;
        case 'price_desc':
            $orderBy = 'ORDER BY price DESC';
            break;
        default:
            $orderBy = ''; // Không sắp xếp
    }

    // Truy vấn dữ liệu sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM product WHERE category_id = $category_id $orderBy";
    $data = executeResult($sql); // Thực thi truy vấn và lấy dữ liệu
?>
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/category-main.css">
<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_blog.jpg" alt="Hình nền danh mục">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page"><?=$title?></p>
        </div>
    </div>
</div>
<div class="category-main">
    <div class="grid wide">
        <div class="category-header">
            <h1><?=$title?></h1>
            <div class="arrange">
                <div class="sort-cate">
                    <div class="sort-cate-left">
                        <h3>Sắp xếp theo:</h3>
                        <ul class="sort-cate-list">
                            <li class="sort-cate-item tag-li">
                                <a href="?category_id=<?=$category_id?>&sort=az"><span><i class="fa-solid fa-check"></i></span> A → Z</a>
                            </li>
                            <li class="sort-cate-item tag-li">
                                <a href="?category_id=<?=$category_id?>&sort=za"><span><i class="fa-solid fa-check"></i></span> Z → A</a>
                            </li>
                            <li class="sort-cate-item tag-li">
                                <a href="?category_id=<?=$category_id?>&sort=price_asc"><span><i class="fa-solid fa-check"></i></span> Giá tăng dần</a>
                            </li>
                            <li class="sort-cate-item tag-li">
                                <a href="?category_id=<?=$category_id?>&sort=price_desc"><span><i class="fa-solid fa-check"></i></span> Giá giảm dần</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-tab content-tab-block">
            <div class="row">
                <?php
                // Duyệt qua danh sách sản phẩm và hiển thị
                foreach ($data as $item) {
    // Loại bỏ ký tự không phải số (như ký hiệu tiền tệ)
    $price = preg_replace('/[^0-9.]/', '', $item['price']);
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
                        <td>'.$item['price'].' <sup>đ</sup></td>
                    </div>
                </div>
            </div>
        </div>';
    }

                ?>
            </div>
        </div>
    </div>
</div>
<script>
    // Đánh dấu mục sắp xếp đang chọn
    const urlParams = new URLSearchParams(window.location.search);
    const sortParam = urlParams.get('sort');
    const sortItems = document.querySelectorAll('.sort-cate-item a');

    sortItems.forEach(item => {
        if (item.href.includes(`sort=${sortParam}`)) {
            item.classList.add('active'); // Thêm class 'active' để làm nổi bật
        }
    });
</script>
<?php
    include_once $baseUrl.'layouts/footer.php';
?>
