<?php
header('Content-Type: application/json');

require_once ('../../database/dbhelper.php');

// Hàm chuyển đổi ngày tháng từ d/m/Y sang Y-m-d
function convertDate($dateString) {
    // Kiểm tra nếu ngày tháng hợp lệ, nếu không trả về null
    $timestamp = strtotime($dateString);
    return $timestamp ? date('Y-m-d', $timestamp) : null;  // Chuyển ngày tháng sang định dạng Y-m-d
}

if (isset($_POST)) {
    // Lấy dữ liệu từ POST và chuyển đổi ngày
    $from = convertDate($_POST['form']);
    $to = convertDate($_POST['to']);

    // Kiểm tra nếu ngày tháng không hợp lệ
    if ($from === null || $to === null) {
        echo json_encode(['error' => 'Invalid date format']);
        exit;
    }

    // Truy vấn để lấy đơn hàng từ cơ sở dữ liệu
    $sql = "SELECT *, DATE_FORMAT(created_at, '%d-%m-%y %H:%i:%s') AS formatted_created_at 
            FROM orders 
            WHERE created_at BETWEEN '$from' AND '$to' 
            AND status = 'Đã thanh toán'";
    $data = executeResult($sql);

    // Xử lý dữ liệu không trùng lặp (dựa trên ID đơn hàng hoặc một thuộc tính duy nhất)
    $list_order = [];
    foreach ($data as $item) {
        // Sử dụng id hoặc một thuộc tính duy nhất để kiểm tra sự trùng lặp
        if (!isset($list_order[$item['id']])) {
            $list_order[$item['id']] = $item;
        }
    }

    // Tính toán tổng số lượng và giá trị theo ngày
    $result = [];
    foreach ($list_order as $item) {
        // Định dạng ngày tháng
        $timestamp = strtotime($item['formatted_created_at']);
        $formattedDate = date('m/d', $timestamp);  // Định dạng ngày theo m/d
        $period = $formattedDate;

        // Lấy số lượng, mặc định là 1 nếu không có num
        $quantity = isset($item['num']) ? $item['num'] : 1;

        // Lấy giá trị total và đảm bảo loại bỏ dấu phẩy, sau đó nhân với số lượng
        $price = floatval(str_replace(',', '', $item['total'])) * floatval($quantity);

        // Cộng dồn số lượng và giá trị cho mỗi ngày
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

    // Re-index kết quả để loại bỏ key ngày
    $result = array_values($result);

    // Trả về kết quả dưới dạng JSON
    echo json_encode($result);
}
?>
