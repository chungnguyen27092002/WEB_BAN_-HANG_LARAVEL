<?php
return [
    'vnp_TmnCode' => env('VNP_TMNCODE', 'ZQ5BUD7G'),
    'vnp_HashSecret' => env('VNP_HASHSECRET', '0ZXGMZJ3ZTLLTZZNOUHHJJ4NARENLDZ2'),
    'vnp_Url' => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'vnp_ReturnUrl' => env('VNP_RETURNURL', 'http://127.0.0.1:8000/cli/vnpay-return'), // URL trả về sau khi thanh toán
];
