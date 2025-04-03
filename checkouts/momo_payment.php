<?php
function createPayment($model)
{
    // Cấu hình các thông số MoMo
    $momoOption = [
        'MomoApiUrl' => 'https://test-payment.momo.vn/gw_payment/transactionProcessor',  // API endpoint của MoMo
        'PartnerCode' => 'MOMO',  // Thay bằng PartnerCode của bạn
        'AccessKey' => 'F8BBA842ECF85',  // Thay bằng AccessKey của bạn
        'SecretKey' => 'K951B6PE1waDMi640xX08PD3vg6EkVlz',  // Thay bằng SecretKey của bạn
        'ReturnUrl' => 'YOUR_RETURN_URL',  // URL mà MoMo sẽ gửi thông tin sau khi thanh toán
        'NotifyUrl' => 'YOUR_NOTIFY_URL',  // URL để nhận thông báo khi thanh toán hoàn tất
    ];

    $partnerCode = $momoOption['PartnerCode'];
    $accessKey = $momoOption['AccessKey'];
    $secretKey = $momoOption['SecretKey'];
    $orderInfo = $model['OrderInfo'];
    $returnUrl = $momoOption['ReturnUrl'];
    $notifyUrl = $momoOption['NotifyUrl'];
    $amount = $model['Amount'];
    $orderId = $model['OrderId'];
    $requestId = $model['OrderId']; // Mỗi yêu cầu cần có requestId duy nhất
    $extraData = '';

    // Tạo dữ liệu thô để tính toán chữ ký
    $rawHash = "partnerCode=$partnerCode&accessKey=$accessKey&requestId=$requestId&amount=$amount&orderId=$orderId&orderInfo=$orderInfo&returnUrl=$returnUrl&notifyUrl=$notifyUrl&extraData=$extraData";
    $signature = calculateSignature($rawHash, $secretKey);

    // Dữ liệu yêu cầu gửi lên API MoMo
    $requestBody = [
        'partnerCode' => $partnerCode,
        'accessKey' => $accessKey,
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'returnUrl' => $returnUrl,
        'notifyUrl' => $notifyUrl,
        'extraData' => $extraData,
        'requestType' => 'captureMoMoWallet',
        'signature' => $signature
    ];

    // Gửi yêu cầu POST tới MoMo API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $momoOption['MomoApiUrl']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    // Enable detailed error output for debugging
    curl_setopt($ch, CURLOPT_VERBOSE, true);  // In ra thông tin chi tiết

    // Nhận phản hồi từ MoMo API
    $response = curl_exec($ch);

    // Kiểm tra lỗi cURL và hiển thị trực tiếp nếu có lỗi
    if (curl_errno($ch)) {
        // echo 'cURL Error: ' . curl_error($ch) . "<br>";
    }

    curl_close($ch);

    // Kiểm tra phản hồi
    if ($response === false) {
        return "Error: cURL request failed.";
    }

    // In ra phản hồi để debug
    // echo "Response from MoMo: " . $response . "<br>";

    // Chuyển đổi dữ liệu phản hồi từ JSON sang array
    $momoResponse = json_decode($response, true);
// Kiểm tra xem phản hồi có chứa khóa 'payUrl' không
    if (isset($momoResponse['payUrl'])) {
        return $momoResponse['payUrl'];
    } else {
        return "Error: " . (isset($momoResponse['message']) ? $momoResponse['message'] : 'Unknown error');
    }
}

function calculateSignature($data, $secretKey)
{
    return hash_hmac('sha256', $data, $secretKey);
}

// Ví dụ sử dụng
$model = [
    'OrderId' => 'order123',
    'Amount' => '100000',
    'OrderInfo' => 'Thanh toán đơn hàng'
];

$payUrl = createPayment($model);
echo "URL thanh toán MoMo: $payUrl";