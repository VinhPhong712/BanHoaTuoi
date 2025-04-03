<?php
    $baseUrl = '../';
    $title = 'SẢN PHẨM';
    include_once $baseUrl.'layouts/header.php';

    if(isset($_POST)){
        $name = $_POST['name'] ??  '';
    }

?>
<link rel="stylesheet" href="<?=$baseUrl?>assets/css/category-main.css">
<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_breadcrumb.png" alt="">
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
        <div class="content-tab content-tab-block">
            <div class="row">
                <?php
                $sql = "SELECT * FROM product WHERE name LIKE '%$name%'";
                $data = executeResult($sql);
                       foreach($data as $item) {
                           echo '
                           <div class="col l-3 ">
                               <div class="content-tab-item">
                                   <div class="product-thumnail">
                                       <a href="'.$baseUrl.'sanpham/'.$item['slug'].'">
                                           <img src="'.$baseUrl.$item['img'].'" alt="">
                                       </a>
                                   </div>
                                   <div class="product-info">
                                       <div class="product-name">
                                           <h3>'.$item['name'].'</h3>
                                       </div>
                                       <div class="product-price">
                                           <h3>'.$item['price'].'</h3>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           ';
                       }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
    include_once $baseUrl.'layouts/footer.php';
?>