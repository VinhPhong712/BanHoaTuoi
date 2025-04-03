<?php
// api/orders.php
header('Content-Type: application/json; charset=utf-8');
// require_once('../config.php'); // Chỉ cần nếu db_helper chưa require
require_once('../db_helper.php');

$results = [];

// --- Lọc dữ liệu đầu vào ---
$temp_conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE); // Mở kết nối tạm để lọc
if (!$temp_conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Không thể kết nối DB để lọc dữ liệu.']);
    exit();
}
mysqli_set_charset($temp_conn, 'utf8mb4'); // Đồng bộ charset

$orderCode = isset($_GET['code']) ? mysqli_real_escape_string($temp_conn, trim($_GET['code'])) : null;
$phoneNumber = isset($_GET['phone']) ? mysqli_real_escape_string($temp_conn, trim($_GET['phone'])) : null;

mysqli_close($temp_conn); // Đóng kết nối tạm
// --- Kết thúc lọc dữ liệu ---


if (empty($orderCode) && empty($phoneNumber)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Vui lòng cung cấp mã đơn hàng (code) hoặc số điện thoại (phone).']);
    exit();
}

// Chỉ lấy thông tin cần thiết
$sql = "SELECT masp, created_at, total, status, user_name, phone_number
        FROM orders
        WHERE 1=1";

if (!empty($orderCode)) {
    $sql .= " AND masp = '$orderCode'"; // Đã escape
} elseif (!empty($phoneNumber)) {
    // Tìm theo SĐT người nhận trong bảng orders
    $sql .= " AND phone_number = '$phoneNumber'"; // Đã escape
}

$sql .= " ORDER BY created_at DESC LIMIT 5"; // Giới hạn số lượng đơn hàng trả về

// Gọi hàm từ db_helper.php
$data = executeResult($sql); // Lấy danh sách (isSingle = false)

if ($data !== null && is_array($data) && !empty($data)) {
    foreach ($data as $row) {
        // Chỉ trả về thông tin cần thiết cho chatbot
        $results[] = [
            'order_code' => $row['masp'],
            'order_date' => $row['created_at'],
            'status' => $row['status'] ?? 'Đang xử lý', // Trạng thái đơn hàng
            'total_amount' => $row['total']
        ];
    }
} elseif ($data === null) {
     http_response_code(500);
     $results = ['error' => 'Lỗi truy vấn đơn hàng.'];
} else {
    // Nếu data là mảng rỗng hoặc không phải mảng
    http_response_code(404); // Not Found
    $results = ['message' => 'Không tìm thấy đơn hàng phù hợp.'];
}

echo json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>