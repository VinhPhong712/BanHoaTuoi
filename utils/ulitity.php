<?php 
// FIx sql injection 
function fixSqlInject($sql) {
    $sql = str_replace('\\','\\\\',$sql);
    $sql = str_replace('\'','\\\'',$sql);
    return $sql;
}

// Lấy dữ liệu bằng phương thức get
function getGet($key) {
    $value = '';
    if (isset($_GET[$key])) {
        $value = $_GET[$key];
        $value = fixSqlInject($value);
    };
    return trim($value);
}
// Lấy dữ liệu bằng phương thức get
function getPost($key) {
    $value = '';
    if (isset($_POST[$key])) {
        $value = $_POST[$key];
        $value = fixSqlInject($value);
    };
    return trim($value);
}
// Lấy dữ liệu bằng phương thức get
function getCookie($key) {
    $value = '';
    if (isset($_COOKIE[$key])) {
        $value = $_COOKIE[$key];
        $value = fixSqlInject($value);
    };
    return trim($value);
}
// Hàm check token để tự động đăng nhập

function getUserToken() {
    if(isset($_SESSION['user'])) {
        return $_SESSION['user'];
    } 
    $token = getCookie('token');
    $sql = "SELECT * FROM tokens WHERE token = '$token'";
    $item = executeResult($sql,true);
    if($item != null) {
        $userId = $item['user_id'];
        $sql = "SELECT * FROM user WHERE id ='$userId' and role_id=1";
        if($item != null) {
            $_SESSION['user'] = $item;
            return $item;
        }
    }
    return null;
}
function moveFile($key,$rootPath="../../") {
    if(!isset($_FILES[$key]) || !isset($_FILES[$key]['name']) || $_FILES[$key]['name']=='') {
        return '';
    }
    $pathTemp = $_FILES[$key]["tmp_name"];
    $filename = $_FILES[$key]['name'];
    $filetarget = basename($filename);
    $x = $rootPath."assets/photos/$filetarget";
    if(file_exists($x)) {
        echo 'ảnh đã tồn tại,vui lòng chọn ảnh khác';
        return '';
    } else {
        $newPath = "assets/photos/".$filename;
        move_uploaded_file($pathTemp,$rootPath.$newPath);
        return $newPath;
    }
}
function fixUrl($thumnail, $rootPath = "../../") {
    if(stripos($thumnail, 'http://') !== false || stripos($thumnail, 'https://') !== false) {
    } else {
        $thumnail = $rootPath.$thumnail;
    }
    return $thumnail;
}

// $filename = $_FILES['anh_phu']['name'];

// Đăng nhập vòa file manage
// epiz_30462757
// kr5xVHdXLYGtC
// ftpupload.net
// 21