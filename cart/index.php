<?php
    $baseUrl = '../';
    $title = 'Giỏ hàng';
    include_once ($baseUrl.'layouts/header.php');
?>

<link rel="stylesheet" href="<?=$baseUrl?>assets/css/cart.css">
<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="../assets/img/bg_blog.jpg" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Giỏ hàng của bạn</p>
        </div>
    </div>
</div>
<div class="cart">
    <div class="grid wide">
        <div class="cart-title">
            <?php
                if(isset($cart_List)) {
                    $num = count($cart_List);
                    echo "<h2>Giỏ hàng của bạn ($num sản phẩm)</h2>";
                }else {
                    echo "<h2>Giỏ hàng của bạn (0 sản phẩm)</h2>";
                }
            ?>
            
        </div>
        <form action="" method="post">
            <div class="cart-main">
                <?php
                    $total_money_main = 0;
                    if(isset($cart_List)) {
                        foreach($cart_List as $item) {
                            if(!empty($_POST)) {
                                $a = $item['product_id'];
                                $num_update = $_POST[$a];
                                // echo $a, $num_update;s
                                $sql = "UPDATE cart SET num = '$num_update' WHERE product_id='$a' AND user_name='$user_name'";
                                execute($sql);
                                header('Location: ../cart');
                            }
                            // tính tổng tiền
                            $money_detail = 0;
                            $product_id = $item['product_id'];
                            $sql = "SELECT * FROM product WHERE id = '$product_id'";
                            $data = executeResult($sql,true);
                            //chuyển giá trị sau khi xử lý thành số nguyên
                            $price = intval(preg_replace('/[^\d.]/', '', $item['price']));
                            $money_detail = $item['num'] * $price;
                            $total_money_main = $total_money_main + $money_detail;
                            echo '
                            
                                <div class="cart-item">
                                    <div class="cart-item-left">
                                        <div class="cart-img">
                                            <img src="'.$baseUrl.$data['img'].'" alt="">
                                        </div>
                                        <div class="cart-name-price">
                                            <div class="cart-name">
                                                <span>'.$data['name'].'</span>
                                            </div>
                                            <div class="cart-price" style="margin-top:10px;">
                                                <h3>'.$item['price'].'đ</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-item-right">
                                        <div class="quantity-product">
                                            <div class="box-quantity-product">
                                                <input type="button" value="-" class="tru">
                                                <input type="number" name="'.$item['product_id'].'" id="" class="value-quantity" value="'.$item['num'].'">
                                                <input type="button" value="+" class="cong">
                                            </div>
                                        </div>
                                        <div class="total-item">
                                            <div class="total-title" style="text-align:end;">
                                                <span>Tổng tiền:</span>
                                            </div>
                                            <div class="total-item-main">
                                                <h3 style="text-align:end;">'.number_format($money_detail).'đ</h3>
                                            </div>
                                            <div class="cart-item-delete">
                                                <a href="../cart/delete_cart.php?delete_cart='.$item['product_id'].'" class="tag-a">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Xóa
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            ';
                        }
                    }
                ?>
                <div class="cart-update">
                    <button type="submit">Cập nhật</button>
                </div>
                
                <div class="cart-footer-box">
                    <div class="cart-footer">
                        <div class="total-main">
                            <span>Thành tiền: </span>
                            <h1><?=number_format($total_money_main)?>đ</h1>
                        </div>
                        <div class="cart-footer-main">
                            <div class="continue-buy">
                                <a href="../" class="tag-a">
                                    Tiếp tục mua hàng
                                </a>
                            </div>
                            <div class="dat-hang button_gradient">
                                <a href="../checkouts" class="tag-a">
                                    Đặt hàng ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="cart-empty-main">
    <div class="grid wide">
        <div class="box-img-cart-empty">
            <img src="../assets/img/cart-empty.png" alt="">
        </div>
        <div class="cart-empty-main-title">
            <span>GIỎ HÀNG TRỐNG</span>
        </div>
        <a href="../" class="tag-a">
            <div class="continue_view" style="width:200px;margin-top:40px; margin-left:15px;">
                <i class="fas fa-long-arrow-alt-left"></i>
                <span>QUAY LẠI CỬA HÀNG</span>
            </div>
        </a>
    </div>
</div>
<script>
    const $1 = document.querySelector.bind(document)
    const $2 = document.querySelectorAll.bind(document)
    //duyệt qua các sản phẩm
    for(let i=0;i<$2('.cong').length;i++) {
        let a1 = $2('.value-quantity')[i].value;
        a1 = parseInt(a1)
        $2('.cong')[i].onclick = function() {
            a1= a1+1
            $2('.value-quantity')[i].value = a1
            console.log($1('.cart-update button'))
            $1('.cart-update button').style.backgroundColor  = '#b9b9b9'
        }
        $2('.tru')[i].onclick = function() {
            if(a1<2){
                return 
            }else{
                a1= a1-1
                $2('.value-quantity')[i].value = a1
                $1('.cart-update button').style.backgroundColor  = '#b9b9b9'
            }
        }
    }
    const cart_list = $2('.cart-item')
    if(cart_list.length < 1) {
        $1('.cart').style.display = 'none'
        $1('.cart-empty-main').style.display = 'block'
    }
</script>


<?php
    $baseUrl = '../';
    include_once ($baseUrl.'layouts/footer.php');
?>