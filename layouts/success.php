<?php
// session_start();
include_once('../layouts/header.php');

// Kiểm tra trạng thái thanh toán (Giả sử MoMo trả về trạng thái qua URL hoặc post)
// $status = $_GET['status']; // Hoặc lấy từ session tùy thuộc vào hệ thống
// $status = isset($_GET['status']) ? $_GET['status'] : null;



// if ($status == 'success') {
//     echo "<h2>Thanh toán thành công!</h2>";
//     // Cập nhật trạng thái đơn hàng, gửi email, v.v.
//     // Cập nhật cơ sở dữ liệu
//     // ...
// } else {
//     echo "<h2>Thanh toán thất bại. Vui lòng thử lại!</h2>";
// } 
?>

<div class=" l-12 c-12">
    <div class="checkout_product" style="background-color: #fafafa;border-radius: 15px;padding: 10px 8px;">
        <div class="title-infor" style="padding: 5px 0;">
            <h2>Thông tin đơn hàng</h2>
        </div>
        <div class="infor-product-order">
            <div class="product-order">
                <?php 
                    $sql2 = "SELECT MAX(stt) as max_stt FROM orders";
                    $data2 = executeResult($sql,true); 
                    $sql = "SELECT id, product_id, phuong_thuc FROM orders WHERE user_name1= '$user_name' AND stt='$max_stt'";
                    $data1 = executeResult($sql);
                    $total_money_main = 0;
                    if(isset($data1)) {
                        foreach($data1 as $item) {
                            $money_detail = 0;
                            $product_id = $item['product_id'];
                            $sql = "SELECT * FROM product WHERE id = '$product_id'";
                            $data = executeResult($sql,true);
                            $sql = "SELECT num FROM orders WHERE user_name1= '$user_name'";
                            $data2 = executeResult($sql,true);
                            $price = intval(preg_replace('/[^\d.]/', '', $data['price']));
                            $money_detail = $data2['num'] * $price;
                            $total_money_main = $total_money_main + $money_detail;
                            echo '
                                <div class="product-item flex">
                                    <div class="product-left flex">
                                        <div class="product-img">
                                            <img src="'.$baseUrl.$data['img'].'" alt="'.$baseUrl.$data['img'].'">
                                            <div class="quantity-product"><span>'.$data2['num'].'</span></div>
                                        </div>
                                        <div class="product-name">
                                            <span>'.$data['name'].'</span>
                                        </div>
                                    </div>
                                    
                                    <div class="product-price"><p>'.number_format($money_detail).' <sup>đ</sup></p></div>
                                </div>
                            ';
                        }  
                    }
                ?>
            </div>
        </div> 
        <div class="detail-text">
            <span class="text-head">Chi tiết thanh toán</span>
            <div class="payment-wrapper">
                <div class="gia-ban">
                   <span class="gia-ban-tit">Giá bán:</span>
                   <div class="gia">
                    <h3 class="gia-chuan"><?=number_format($total_money_main+20000)?> <sup>đ</sup></h3>
                   </div>
                </div>
                <hr class="hr-boder"/>
                <div class="gia-ban tong-tien">
                   <span class="gia-ban-tit">Tổng tiền:</span>
                   <div class="gia">
                    <h3 class="gia-chuan"><?=number_format($total_money_main+20000)?> <sup>đ</sup></h3>
                   </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
        <!-- <form class="mr-2" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                                    action="../checkouts/momo_atm.php">
                                    <li class="tag-li btn-momo">
                                        <input hidden value="<?=$total_money_main+20000?>" type="text" name="price"><br>
                                        <button type="submit" class="btn btn-success" style="font-weight: 600;">Thanh toán ATM MoMo</button>
                                    </li>
                                </form>   -->
                                <form class="mr-2" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                                    action="../checkouts/init_payment.php">
                                    <li class="tag-li btn-momo">
                                        <input hidden value="<?=$total_money_main+20000?>" type="text" name="price"><br>
                                        <button type="submit" class="btn btn-success" style="font-weight: 600;">Quét mã MoMo QR code</button>
                                    </li>
                                </form>  
                                <!-- <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                                    action="../checkouts/init_vnpay.php">
                                    <li class="tag-li btn-momo">
                                        <input hidden value="<?=$total_money_main+20000?>" type="text" name="price"><br>
                                        <button type="submit" class="btn btn-success" style="font-weight: 600;" name="redirect">Thanh toán VNPAY</button>
                                    </li>
                                </form>   -->
        </div>
    </div>
</div>
</div>



<div class=" col l-12 c-12">
<?php
include_once('../layouts/footer.php');
?>

</div>