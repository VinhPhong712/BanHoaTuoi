<?php
// api/categories.php
header('Content-Type: application/json; charset=utf-8');
// require_once('../config.php'); // Chỉ cần nếu db_helper chưa require
require_once('../db_helper.php');

$results = [];
$sql = "SELECT id, name FROM category ORDER BY name ASC";

// Gọi hàm từ db_helper.php
$data = executeResult($sql); // isSingle mặc định là false

if ($data !== null && is_array($data)) {
    $results = $data;
} elseif($data === null) {
     http_response_code(500);
     $results = ['error' => 'Lỗi truy vấn danh mục.'];
} else {
    $results = []; // Trả về mảng rỗng nếu không có danh mục
}

echo json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>