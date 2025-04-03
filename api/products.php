<?php
// api/products.php
header('Content-Type: application/json; charset=utf-8');
// require_once('../config.php'); // Chỉ cần nếu db_helper chưa require
require_once('../db_helper.php'); // Đường dẫn tới file db_helper.php

$results = [];

// --- Lọc dữ liệu đầu vào ---
$temp_conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE); // Mở kết nối tạm để lọc
if (!$temp_conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Không thể kết nối DB để lọc dữ liệu.']);
    exit();
}
mysqli_set_charset($temp_conn, 'utf8mb4'); // Đồng bộ charset

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($temp_conn, trim($_GET['search'])) : null;
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null; // Ép kiểu int
$productId = isset($_GET['id']) ? (int)$_GET['id'] : null; // Ép kiểu int
$productSlug = isset($_GET['slug']) ? mysqli_real_escape_string($temp_conn, trim($_GET['slug'])) : null;

mysqli_close($temp_conn); // Đóng kết nối tạm
// --- Kết thúc lọc dữ liệu ---


$sql = "SELECT p.id, p.name, p.slug, p.price, p.img, p.description, c.name as category_name
        FROM product p
        LEFT JOIN category c ON p.category_id = c.id
        WHERE 1=1"; // Luôn đúng để dễ dàng thêm điều kiện AND

$isSingle = false; // Mặc định lấy nhiều kết quả

// 1. Lấy chi tiết một sản phẩm cụ thể (Ưu tiên ID hoặc Slug)
if ($productId > 0) {
    $sql .= " AND p.id = $productId"; // Đã ép kiểu int nên an toàn hơn
    $isSingle = true; // Chỉ lấy 1 sản phẩm
} elseif ($productSlug !== null && $productSlug !== '') {
    $sql .= " AND p.slug = '$productSlug'"; // Đã escape
    $isSingle = true; // Chỉ lấy 1 sản phẩm
}
// 2. Lọc theo danh mục (Nếu không lấy chi tiết)
elseif ($categoryId > 0) {
    $sql .= " AND p.category_id = $categoryId"; // Đã ép kiểu int
}
// 3. Tìm kiếm theo tên (Nếu không lấy chi tiết hoặc theo category)
elseif ($searchTerm !== null && $searchTerm !== '') {
    $sql .= " AND p.name LIKE '%$searchTerm%'"; // Đã escape
}

// Nếu không lấy chi tiết, giới hạn số lượng
if (!$isSingle) {
    $sql .= " ORDER BY p.id DESC LIMIT 10"; // Sắp xếp và giới hạn
}

// Gọi hàm từ db_helper.php
$data = executeResult($sql, $isSingle);

// Xử lý kết quả trả về
if ($data !== null) {
    // Nếu là danh sách (không phải isSingle), xử lý từng phần tử
    if (!$isSingle && is_array($data)) {
        foreach ($data as &$row) { // Sử dụng tham chiếu để sửa trực tiếp
             // Tạo URL ảnh đầy đủ (thay yourdomain.com)
            $row['img_url'] = 'https://yourdomain.com/' . $row['img'];
            // Rút gọn description cho danh sách
            $row['description'] = mb_substr(strip_tags($row['description'] ?? ''), 0, 100, 'UTF-8') . '...';
        }
        unset($row); // Hủy tham chiếu sau vòng lặp
        $results = $data;
    }
    // Nếu là chi tiết sản phẩm (isSingle) và có dữ liệu
    elseif ($isSingle && is_array($data)) {
         $data['img_url'] = 'https://yourdomain.com/' . $data['img'];
         // Giữ nguyên description cho chi tiết
         $results = $data;
    }
    // Trường hợp isSingle nhưng không tìm thấy
    elseif ($isSingle && $data === null) {
        http_response_code(404);
        $results = ['message' => 'Không tìm thấy sản phẩm.'];
    }
     // Trường hợp danh sách rỗng
    elseif (!$isSingle && empty($data)) {
         $results = []; // Trả về mảng rỗng
    }

} else {
    // Xử lý trường hợp executeResult trả về null (có thể do lỗi SQL)
    // Hàm executeResult hiện tại không báo lỗi cụ thể, nên khó biết nguyên nhân
    http_response_code(500);
    $results = ['error' => 'Có lỗi xảy ra khi truy vấn sản phẩm.'];
}

echo json_encode($results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); // Thêm flag để hiển thị tiếng Việt đẹp

?>