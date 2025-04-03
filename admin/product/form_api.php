<?php
session_start();
require_once('../../utils/ulitity.php');
require_once('../../database/dbhelper.php');
// $user = getUserToken();
// if($user == null) {
//     die();
// }
if(!empty($_POST)) {
    $action = getPost('action');
    switch ($action) {
        case 'delete':
            deletepProduct();
            break;
    }
}
function deletepProduct() {
    $id = getPost('id');
    $sql = "SELECT img FROM product WHERE id = $id";
    $data = executeResult($sql,true);
    $thumnail_file = fixUrl($data['img']);
    unlink("$thumnail_file");
    $sql = "SELECT img_desct FROM img_desct WHERE product_id = $id";
    $data = executeResult($sql);
    // var_dump($data);
    foreach ($data as $a => $b) {
        foreach ($b as $c => $d) {
            $e = fixUrl($d);
            unlink($e);
        }
    }
    $sql = "DELETE FROM img_desct WHERE product_id = $id";
    execute($sql);
    $sql = "DELETE FROM product WHERE id = $id";
    execute($sql);
    if(isset($_SESSION['email'])) {
        $email =  $_SESSION['email'];
        $sql = "SELECT id FROM users WHERE email ='$email'";
        $data = executeResult($sql,true);
        $user_id = $data['id'];
        // var_dump($user_id);
        // var_dump($id);
    }
    // $sql = "DELETE FROM cart WHERE product_id = $id AND  user_id = $user_id";
    // execute($sql);
}