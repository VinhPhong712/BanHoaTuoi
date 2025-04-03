<?php
require_once('config.php');
// Câu lệnh chèn dữ liệu(insert)
function execute($sql) {
    // Mở kết nổi
    $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    // mysqli_set_charset($conn,'utf-8');
    // mysqli_set_charset('utf8');
    // Câu truy vấn
    mysqli_query($conn, $sql);
    // Đóng kết nối
    mysqli_close($conn);
}

// Hàm tiện ích để lấy kết nối tạm thời cho việc lọc
function get_temp_connection_for_escaping() {
    require_once('../config.php'); // Đảm bảo config được load
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if ($conn) {
        mysqli_set_charset($conn, 'utf8mb4'); // Quan trọng: phải cùng charset với db
        return $conn;
    }
    return null;
}
?>

<?php
function executeResult($sql, $isSingle= false) {
    $data = null;
    // mở kết nối
    $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    // Câu truy vấn
    $resultset = mysqli_query($conn,$sql);
    if($isSingle) {
        $data = mysqli_fetch_array($resultset,1);
    } else {
        $data = [];
        while(($row = mysqli_fetch_array($resultset,1)) != null) {
            $data[]=$row;
        }
    }
    // Đóng kết nối
    mysqli_close($conn);
    return $data;
}

function executeCountTotal($sql){
    $data = null;
    // mở kết nối
    $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    // Câu truy vấn
    $resultset = mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($resultset);
    return $rows;
}

// Hàm mã hóa thông tin MD5
// Mã hóa mật khẩu
// Mã hóa mật khẩu
function getSecurityMD5($pwd) {
    return password_hash($pwd, PASSWORD_DEFAULT);  // Thay thế MD5 bằng password_hash()
}
// Kiểm tra mật khẩu


