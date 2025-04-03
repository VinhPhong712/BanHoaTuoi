<?php
    include_once '../database/dbhelper.php';
    include_once '../utils/ulitity.php';
    if(isset($_GET['delete_cart'])) {
        session_start();
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $data = executeResult($sql,true);
        $user_name = $data['fullname'];
        $product_id = $_GET['delete_cart'];
        $sql = "DELETE  FROM cart WHERE product_id = '$product_id' AND user_name = '$user_name'";
        execute($sql);
        header('Location: ./');
    }
?>