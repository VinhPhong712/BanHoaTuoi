<div class="col l-5 c-12 " >
    <div class="checkout_product" style="background-color: #fafafa;border-radius: 15px;padding: 10px 8px;">
        <div class="title-infor" style="padding: 5px 0;">
            <h2>Thông tin đơn hàng</h2>
        </div>
        <div class="infor-product-order">
            <div class="product-order">
                <?php
                    $data2 = executeResult($sql2,true);
                    $max_stt = $data2['max_stt'];
                    $sql = "SELECT id,product_id, phuong_thuc FROM orders WHERE user_name1= '$user_name' AND stt='$max_stt'";
                    $data1 = executeResult($sql);
                    $total_money_main = 0;
                    if(isset($data1)) {
                        foreach($data1 as $item) {
                            $money_detail = 0;
                            $product_id = $item['product_id'];
                            $sql = "SELECT * FROM product WHERE id = '$product_id'";
                            $data = executeResult($sql,true);
                            $sql2 = "SELECT num FROM orders WHERE user_name1= '$user_name'";
                            $data2 = executeResult($sql2,true);
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
    </div>
</div>
