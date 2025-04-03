<?php
header('Content-Type: application/json');

require_once('../../database/dbhelper.php');

$sql = "SELECT * FROM orders WHERE status = 'Đã thanh toán'";
$data = executeResult($sql);

$list_order = [];
foreach ($data as $item) {
    // Loại bỏ bản ghi trùng lặp
    if (!in_array($item, $list_order)) {
        array_unshift($list_order, $item);
    }
}

$result = [];
foreach ($list_order as $item) {
    $timestamp = strtotime($item['created_at']);
    $formattedDate = date('d/m', $timestamp);
    $period = $formattedDate;

    // Kiểm tra xem có số lượng không, nếu không thì mặc định là 1
    $quantity = isset($item['num']) ? $item['num'] : 1;

    // Xử lý giá trị 'total' có thể có dấu phẩy
    $price = floatval(str_replace(',', '', $item['total'])) * $quantity;

    // Cập nhật kết quả
    if (!isset($result[$period])) {
        $result[$period] = [
            'period' => $period,
            'quantity' => $quantity,
            'price' => $price
        ];
    } else {
        $result[$period]['quantity'] += $quantity;
        $result[$period]['price'] += $price;
    }
}

// Re-index the result array to remove the date keys
$result = array_values($result);

echo json_encode($result);
?>
