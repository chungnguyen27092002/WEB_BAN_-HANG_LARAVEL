<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Session;
use App\Models\custommer;
use App\Models\category;
use App\Models\coupon;
use App\Models\CatePost;
use App\Models\chinhsach;
use App\Models\Favorite;
use DB;
use App\Models\shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use PDF;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use Exception;

class  CheckoutController extends Controller
{

    public function vnpay_payment(Request $request)
    {
        if ($request->input('order_coupon') != 'no') {
            $coupon = coupon::where('coupon_code', $request->input('order_coupon'))->first();
            $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
            $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon_email = $coupon->coupon_code;
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            $coupon->save();
        } else {
            $coupon_email = "Không sử dụng";
            $coupon_condition = null;
            $coupon_number = null;
        }
        $shippingInfo = [
            'name' => $request->input('shipping_name'),
            'email' => $request->input('shipping_email'),
            'phone' => $request->input('shipping_phone'),
            'address' => $request->input('shipping_address'),
            'address1' => $request->input('shipping_address1'),
            'notes' => $request->input('shipping_notes'),
            'order_coupon' => $request->input('order_coupon'),
            'order_fee' => $request->input('order_fee'),
            'method' => $request->input('shipping_method'),
            'coupon_email' => $coupon_email,
            'coupon_condition' => $coupon_condition,
            'coupon_number' => $coupon_number,
        ];
        Session::put('shipping_info', $shippingInfo);

        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = config('vnpay.vnp_Url');
        $vnp_Returnurl = config('vnpay.vnp_ReturnUrl');

        $vnp_TxnRef = time() . "_" . rand(10000, 99999); // Thêm random để tránh trùng
        $vnp_OrderInfo = $request->orderInfo;
        $vnp_OrderType = 'bill';
        $vnp_Amount = $request->amount * 23083 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->bank_code ?? ''; // Thêm bank_code nếu có
        $vnp_IpAddr = $request->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => (int)$vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return response()->json(['url' => $vnp_Url]);
    }

    public function returnPayment(Request $request)
    {
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $inputData = $request->all();

        // Log input data để debug
        \Log::info('VNPay Return Data:', $inputData);

        if (!isset($inputData['vnp_SecureHash'])) {
            \Log::error('VNPay Return: Missing secure hash');
            return redirect()->route('cli_index')->with('error', 'Dữ liệu không hợp lệ!');
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];

        // Loại bỏ các trường không cần thiết
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);

        // Sắp xếp dữ liệu theo key
        ksort($inputData);

        // Tạo chuỗi query để check hash
        $hashData = [];
        foreach ($inputData as $key => $value) {
            if ($value != "" && !is_array($value)) {
                $hashData[] = $key . "=" . urlencode($value);
            }
        }
        $query = implode('&', $hashData);

        // Tính toán secure hash
        $secureHash = hash_hmac('sha512', $query, $vnp_HashSecret);

        \Log::info('Hash Comparison:', [
            'Generated' => $secureHash,
            'Received' => $vnp_SecureHash
        ]);

        // So sánh mã hash
        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                try {
                    // Lấy thông tin shipping từ session
                    $shipping_info = Session::get('shipping_info');
                    \Log::info('Shipping Info:', $shipping_info);
                    if (!$shipping_info) {
                        throw new \Exception('Không tìm thấy thông tin shipping');
                    }

                    \DB::beginTransaction();

                    // Tạo shipping record
                    $shipping = new shipping();
                    $shipping->shipping_name = $shipping_info['name'];
                    $shipping->shipping_email = $shipping_info['email'];
                    $shipping->shipping_phone = $shipping_info['phone'];
                    $shipping->shipping_address = $shipping_info['address'];
                    $shipping->shipping_address2 = $shipping_info['address1'];
                    $shipping->shipping_notes = $shipping_info['notes'];
                    $shipping->shipping_method = $shipping_info['method'];
                    $shipping->save();

                    // Tạo order record
                    $order = new Order();
                    $order->customer_id = Session::get('customer_id');
                    $order->shipping_id = $shipping->shipping_id;
                    $order->order_status = 1;
                    $order->order_code = $inputData['vnp_TxnRef'];
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                    $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                    $order->order_date = $order_date;
                    $order->created_at = $today;
                    $order->save();
                    $order_id = $order->order_id;
                    \DB::commit();

                    // Xóa session data
                    if (Session::get('cart') == true) {
                        foreach (Session::get('cart') as $key => $cart) {
                            $order_details = new OrderDetail();
                            $order_details->order_code = $inputData['vnp_TxnRef'];
                            $order_details->product_id = $cart['pro_id'];
                            $order_details->product_name = $cart['name'];
                            if ($cart['price_pro'] != "") {
                                $order_details->product_price = $cart['price'] - $cart['price_pro'];
                            } else {
                                $order_details->product_price = $cart['price'];
                            }
                            $order_details->product_sales_quantity = $cart['quantity'];
                            $order_details->product_size = $cart['size'];
                            $order_details->product_coupon =  $shipping_info['order_coupon'];
                            $order_details->product_feeship =  $shipping_info['order_fee'];
                            $order_details->order_id = $order_id;
                            $order_details->save();
                        }
                    }
                    $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
                    $title_email = "Đơn hàng xác nhận ngày" . ' ' . $now;
                    $cus =  custommer::find(Session::get('customer_id'));
                    $data['email'][] = $cus->customer_email;
                    if (Session::get('cart') == true) {
                        foreach (Session::get('cart') as $key => $cart_email) {
                            $cart_array[] = array(
                                'product_km' => $cart_email['price_pro'],
                                'product_size' => $cart_email['size'],
                                'product_name' => $cart_email['name'],
                                'product_price' => $cart_email['price'],
                                'product_qty' => $cart_email['quantity'],
                            );
                        }
                    }  //Lấy  shipping
                    $shipping_array = array(
                        'customer_name' => $cus->customer_name,
                        'shipping_name' => $shipping_info['name'],
                        'shipping_email' => $shipping_info['email'],
                        'shipping_phone' => $shipping_info['phone'],
                        'shipping_address' => $shipping_info['address'],
                        'shipping_address2' => $shipping_info['address1'],
                        'shipping_notes' => $shipping_info['notes'],
                        'shipping_method' => $shipping_info['method'],
                        'fee_ship' => $shipping_info['order_fee']
                    );
                    //Lấy mã giảm giá
                    $ordercode_mail = array(
                        'coupon_code' => $shipping_info['coupon_email'],
                        'order_code' => $inputData['vnp_TxnRef'],
                        'coupon_condition' => isset($shipping_info['oupon_condition']) ? $shipping_info['oupon_condition'] : null,
                        'coupon_number' => isset($shipping_info['coupon_number']) ? $shipping_info['coupon_number'] : null,
                    );
                    Mail::send('admin.mail.email_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_email, $data) {
                        $message->to($data['email'])->subject($title_email);
                        $message->from($data['email'], $title_email);
                    });
                    Session::forget('coupon');
                    Session::forget(['shipping_info', 'cart']);
                    Session::flash('thank', 'Cảm ơn bạn đã mua sản phẩm của chúng tôi, chúng tôi sẽ giao hàng sớm nhất cho bạn');
                    return redirect()->route('thank');
                } catch (\Exception $e) {
                    \DB::rollBack();
                    \Log::error('VNPay Return Error: ' . $e->getMessage());
                    return redirect()->route('cli_index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
                }
            } else {
                \Log::warning('VNPay Return: Transaction failed with code ' . $inputData['vnp_ResponseCode']);
                return redirect()->route('cli_index')->with('error', 'Giao dịch thất bại!');
            }
        } else {
            \Log::error('VNPay Return: Invalid hash');
            return redirect()->route('cli_index')->with('error', 'Chữ ký không hợp lệ!');
        }
    }

    public function print_order($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));

        return $pdf->stream();
    }

    public function print_order_convert($checkout_code)
    {
        $order = Order::where('order_code', $checkout_code)->get();

        $customer_id = null;
        $shipping_id = null;
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }

        $customer = custommer::where('customer_id', $customer_id)->first();
        $shipping = shipping::where('shipping_id', $shipping_id)->first();

        $order_details = OrderDetail::where('order_code', $checkout_code)->get();

        $product_coupon = null;
        $coupon_condition = 2;
        $coupon_number = 0;
        $coupon_echo = '0';

        if (!$order_details->isEmpty()) {
            $product_coupon = $order_details->first()->product_coupon; // Assuming all items have the same coupon
            if ($product_coupon != 'no') {
                $coupon = coupon::where('coupon_code', $product_coupon)->first();
                $coupon_condition = $coupon->coupon_condition;
                $coupon_number = $coupon->coupon_number;
                if ($coupon_condition == 1) {
                    $coupon_echo = $coupon_number . '%';
                } elseif ($coupon_condition == 2) {
                    $coupon_echo = number_format($coupon_number, 0, ',', '.') . 'đ';
                }
            }
        }

        $output = '<style>body{ font-family: DejaVu Sans; } .tieu{ font-size: 15px; font-weight: bold; } .table-bordered{ border:0.5px solid #000; width:100%; margin-top:30px; } .table-bordered tbody tr td{ border:0.5px solid #000; } .table-bordered th{ background:grey; color:white; } .bold{ font-weight:bold; width:50px; } .mart{ margin-top:20px; } .day{ text-align:right; margin-top:20px; } .center{ text-align:center; }</style>';

        $output .= '<h4><center style="font-size:18px">HÓA ĐƠN</center></h4>';
        $output .= '<div class="khah"><div class="heade"><span class="panel-heading1">THÔNG TIN KHÁCH HÀNG</span></div>';
        $output .= '<ul style="list-style-type: none; ">';
        $output .= '<li><span class="tieu">Tên khách hàng:</span> ' . $shipping->shipping_name . '</li>';
        $output .= '<li><span class="tieu">Địa chỉ:</span> ' . $shipping->shipping_address . '</li>';
        $output .= '<li><span class="tieu">Tỉnh/TP: </span>' . $shipping->shipping_address2 . '</li>';
        $output .= '<li><span class="tieu">Số điện thoại:</span>' . $shipping->shipping_phone . '</li>';
        $output .= '<li><span class="tieu">Email: </span>' . $shipping->shipping_email . '</li>';
        $output .= '<li><span class="tieu">Ghi chú: </span>' . $shipping->shipping_notes . '</li>';
        $output .= '<li><span class="tieu">Hình thức thanh toán: </span>';
        if ($shipping->shipping_method == 0) {
            $output .= '<span class="online">Chuyển khoản qua PayPal</span>';
        } elseif ($shipping->shipping_method == 2) {
            $output .= '<span class="online">Chuyển khoản VNPay</span>';
        } else {
            $output .= '<span class="offline">Tiền mặt</span>';
        }

        $output .= '</ul></div>';

        $output .= '<table class="table table-bordered"><thead><tr><th>Tên</th><th>Size</th><th>Số lượng</th><th>Giá</th><th>Tổng tiền</th></tr></thead><tbody>';

        $total = 0;

        foreach ($order_details as $key => $product) {
            if ($product->product_size == "L") {
                $_price = ($product->product_price + (($product->product_price * 20) / 100)); // Add 20% for "L"
            } elseif ($product->product_size == "S") {
                $_price = ($product->product_price - (($product->product_price * 20) / 100)); // Subtract 20% for "S"
            } else {
                $_price = $product->product_price; // Regular price
            }

            $subtotal = $_price * $product->product_sales_quantity;
            $total += $subtotal;

            $product_coupon = $product->product_coupon != 'no' ? $product->product_coupon : 'không mã';

            $output .= '<tr><td class="center">' . $product->product_name . '</td>';
            $output .= '<td class="center">' . $product->product_size . '</td>';
            $output .= '<td class="center">' . $product->product_sales_quantity . '</td>';
            $output .= '<td class="center">' . number_format($_price, 0, ',', '.') . 'đ' . '</td>';
            $output .= '<td class="center">' . number_format($subtotal, 0, ',', '.') . 'đ' . '</td></tr>';
        }

        $output .= '</tbody></table>';

        if ($coupon_condition == 1) {
            $total_after_coupon = ($total * $coupon_number) / 100;
            $total_coupon = $total - $total_after_coupon;
        } else {
            $total_coupon = $total - $coupon_number;
        }

        $output .= '<div class="phiship">';
        $output .= '<p><span class="bold">Tổng giảm</span>:<span class="sp"> ' . $coupon_echo . '</span></p>';
        $output .= '<p><span class="bold">Phí ship</span>:<span class="sp"> ' . number_format($product->product_feeship, 0, ',', '.') . 'đ' . '</span></p>';
        $output .= '<p><span class="bold">Thanh toán</span> :<span class="sp"> ' . number_format($total_coupon + $product->product_feeship, 0, ',', '.') . 'đ' . '</span></p>';
        $output .= '</div>';

        $output .= '<div class="day">Hà Nội, ngày ' . Carbon::now()->day . ', tháng ' . Carbon::now()->month . ', năm ' . Carbon::now()->year . '</div>';
        $output .= '<table class="mart"><thead><tr><th width="200px">Người lập phiếu</th><th width="800px">Người nhận</th></tr></thead><tbody></tbody></table>';

        return $output;
    }


    public function confirm_order1(Request $request)
    {
        $url_canonical = $request->url();
        $cate = category::all();
        $com = '';
        $data = $request->all();
        if ($data['order_coupon'] != 'no') {
            $coupon = coupon::where('coupon_code', $data['order_coupon'])->first();
            $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
            $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon_email = $coupon->coupon_code;
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            $coupon->save();
        } else {
            $coupon_email = "Không sử dụng";
        }

        //vận chuyển
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_address2 = $data['shipping_address1'];
        $shipping->shipping_notes = $data['shipping_notes'];

        $shipping->shipping_method = $data['payment_select']??'1';
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);

        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->order_date = $order_date;
        $order->created_at = $today;
        $order->save();
        $order_id = $order->order_id;


        //send email comfirm

        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart) {
                $order_details = new OrderDetail();
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['pro_id'];
                $order_details->product_name = $cart['name'];
                if ($cart['price_pro'] != "") {
                    $order_details->product_price = $cart['price'] - $cart['price_pro'];
                } else {
                    $order_details->product_price = $cart['price'];
                }
                $order_details->product_sales_quantity = $cart['quantity'];
                $order_details->product_size = $cart['size'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->order_id = $order_id;
                $order_details->save();
            }
        }
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_email = "Đơn hàng xác nhận ngày" . ' ' . $now;
        $cus =  custommer::find(Session::get('customer_id'));
        $data['email'][] = $cus->customer_email;

        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart_email) {
                $cart_array[] = array(
                    'product_km' => $cart_email['price_pro'],
                    'product_size' => $cart_email['size'],
                    'product_name' => $cart_email['name'],
                    'product_price' => $cart_email['price'],
                    'product_qty' => $cart_email['quantity'],
                );
            }
        }
        //Lấy  shipping
        $shipping_array = array(
            'customer_name' => $cus->customer_name,
            'shipping_name' => $data['shipping_name'],
            'shipping_email' => $data['shipping_email'],
            'shipping_phone' => $data['shipping_phone'],
            'shipping_address' => $data['shipping_address'],
            'shipping_address2' => $data['shipping_address1'],
            'shipping_notes' => $data['shipping_notes'],
            'shipping_method' => $data['payment_select'],
            'fee_ship' => $data['order_fee']
        );
        //Lấy mã giảm giá
        $ordercode_mail = array(
            'coupon_code' => $coupon_email,
            'order_code' => $checkout_code,
            'coupon_condition' => isset($coupon_condition) ? $coupon_condition : null,
            'coupon_number' => isset($coupon_number) ? $coupon_number : null,
        );
        Mail::send('admin.mail.email_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_email, $data) {
            $message->to($data['email'])->subject($title_email);
            $message->from($data['email'], $title_email);
        });

        Session::forget('coupon');
        // Session::forget('fee');
        Session::forget('cart');
        Session::flash('thank', 'Cảm ơn bạn đã mua sản phẩm của chúng tôi, chúng tôi sẽ giao hàng sớm nhất cho bạn');
        return redirect()->route('thank');
    }
    public function confirm_order(Request $request)
    {
        $url_canonical = $request->url();
        $cate = category::all();
        $com = '';
        $data = $request->all();
        if ($data['order_coupon'] != 'no') {
            $coupon = coupon::where('coupon_code', $data['order_coupon'])->first();
            $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
            $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon_email = $coupon->coupon_code;
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            $coupon->save();
        } else {
            $coupon_email = "Không sử dụng";
        }

        //vận chuyển
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_address2 = $data['shipping_address1'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);


        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ha_Noi');
        $today = Carbon::now('Asia/Ha_Noi')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ha_Noi')->format('Y-m-d');
        $order->order_date = $order_date;
        $order->created_at = $today;
        $order->save();
        $order_id = $order->order_id;


        //send email comfirm



        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart) {
                $order_details = new OrderDetail();
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['pro_id'];
                $order_details->product_name = $cart['name'];
                if ($cart['price_pro'] != "") {
                    $order_details->product_price = $cart['price'] - $cart['price_pro'];
                } else {
                    $order_details->product_price = $cart['price'];
                }
                $order_details->product_sales_quantity = $cart['quantity'];
                $order_details->product_size = $cart['size'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->order_id = $order_id;
                $order_details->save();
            }
        }
        $now = Carbon::now('Asia/Ha_Noi')->format('d-m-Y H:i:s');
        $title_email = "Đơn hàng xác nhận ngày" . ' ' . $now;
        $cus =  custommer::find(Session::get('customer_id'));
        $data['email'][] = $cus->customer_email;

        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart_email) {
                $cart_array[] = array(
                    'product_km' => $cart_email['price_pro'],
                    'product_size' => $cart_email['size'],
                    'product_name' => $cart_email['name'],
                    'product_price' => $cart_email['price'],
                    'product_qty' => $cart_email['quantity'],
                );
            }
        }
        //Lấy  shipping
        $shipping_array = array(
            'customer_name' => $cus->customer_name,
            'shipping_name' => $data['shipping_name'],
            'shipping_email' => $data['shipping_email'],
            'shipping_phone' => $data['shipping_phone'],
            'shipping_address' => $data['shipping_address'],
            'shipping_address2' => $data['shipping_address1'],
            'shipping_notes' => $data['shipping_notes'],
            'shipping_method' => $data['shipping_method'],
            'fee_ship' => $data['order_fee']
        );
        //Lấy mã giảm giá
        $ordercode_mail = array(
            'coupon_code' => $coupon_email,
            'order_code' => $checkout_code,
            'coupon_condition' => isset($coupon_condition) ? $coupon_condition : null,
            'coupon_number' => isset($coupon_number) ? $coupon_number : null,
        );
        Mail::send('admin.mail.email_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_email, $data) {
            $message->to($data['email'])->subject($title_email);
            $message->from($data['email'], $title_email);
        });

        Session::forget('coupon');
        // Session::forget('fee');
        Session::forget('cart');
        // return view('client/thankyou');
        // Session::flash('thank','Cảm ơn bạn đã mua sản phẩm của chúng tôi, chúng tôi sẽ giao hàng sớm nhất cho bạn');
        // return redirect()->route('cli_index');
        // Session::flash('thank', 'Cảm ơn bạn đã mua sản phẩm của chúng tôi, chúng tôi sẽ giao hàng sớm nhất cho bạn');
        // return redirect()->route('thank');
    }
    public function dangky(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'email' => 'required|email|unique:tbl_customers,customer_email',
            'sdt' => 'required|regex:/(0)[0-9]{9}/|unique:tbl_customers,customer_phone',
            'password' => 'required|min:8|max:32',
            're_password' => 'required|same:password'
        ], [
            'name.required' => '+Ban chưa nhập tên',
            'email.required' => '+Ban chưa nhập email',
            'email.email' => '+Email chưa đúng định dạng',
            'email.unique' => '+Email đã tồn tại',
            'password.required' => '+Bạn chưa nhập password',
            'sdt.required' => '+Bạn chưa nhập số điện thoạt',
            'sdt.regex' => '+Số Điện thoại chưa đúng định dạng',
            'sdt.unique' => '+Số điện thoại đã tồn tại',
            're_password.required' => '+Bạn chưa nhập lại password',
            'password.min' => '+password lớn hơn 8',
            'password.max' => '+Password lớn hơn 32',
            're_password.same' => '+Password chưa đúng'
        ]);

        // $cus=array();
        // $cus['customer_name']=$req->name;
        // $cus['customer_email']=$req->email;
        // $cus['customer_password']=md5($req->password);
        // $cus['customer_phone']=$req->sdt;
        // $cus_id=DB::table('tbl_customers')->insertGetId($cus);
        // Session::put('customer_id',$cus_id);
        // Session::put('customer_name',$req->customer_name);
        // return redirect()->route('cli_index');
        $email = $req->email;
        $code = bcrypt(md5(time() . $email));
        $url = route('xacnhanTK', ['name' => $req->name, 'email' => $req->email, 'phone' => $req->sdt, 'password' => md5($req->password), 'code_active' => $code]);
        $data = [
            'route' => $url
        ];
        Mail::send('email.xacnhantk', $data, function ($message) use ($email) {
            $message->to($email, 'Verify password')->subject('Xác nhận mật khẩu!!');
            $message->from($email);
        });
        return redirect()->route('cli_index')->with('message', 'XIN BẠN HÃY CHECK MAIL ĐỂ XÁC NHẬN TÀI KHOẢN!!');;
    }
    public function xacnhanTK(Request $req)
    {
        //dd($req->name);
        //dd($req->all());
        $email = $req->email;
        $name = $req->name;
        $phone = $req->phone;
        $password = $req->password;
        $code_active = $req->code_active;
        //$time_active = $req->time_active;
        //dd($email);

        $cus = array();
        $cus['customer_name'] = $name;
        $cus['customer_email'] = $email;
        $cus['customer_password'] = $password;
        $cus['customer_phone'] = $phone;
        $cus['code_active'] = $code_active;
        $cus_id = DB::table('tbl_customers')->insertGetId($cus);
        Session::put('customer_id', $cus_id);
        Session::put('customer_name', $name);
        $favorites = Favorite::where('customer_id',  $cus_id)
            ->join('tbl_product', 'tbl_favorites.product_id', '=', 'tbl_product.product_id')
            ->select('tbl_product.product_id', 'tbl_product.product_name', 'tbl_product.product_price', 'tbl_product.product_image')
            ->get();
        Session::put('favorites', $favorites);
        return redirect()->route('cli_index')->with('message', 'XÁC NHẬN TÀI KHOẢN THÀNH CÔNG!!');
    }
    // public function getdoimk(){
    //     return view('email.layout_doimk');
    // }
    public function dangnhap(Request $req)
    {
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required|min:8|max:32',
            'g-recaptcha-response' => 'required',
        ], [
            'email.required' => '+Ban chưa nhập email',
            'email.email' => '+Email chưa đúng định dạng',
            'password.required' => '+Bạn chưa nhập password',
            'password.min' => 'password phải ít nhất 8 ký tự',
            'g-recaptcha-response.required' => 'Bạn chưa xác nhận CAPTCHA',
        ]);
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $req->input('g-recaptcha-response'),
            'remoteip' => $req->ip(),
        ]);
        // Kiểm tra kết quả CAPTCHA
        $captchaResult = $response->json();
        if (!$captchaResult['success']) {
            return redirect()->route('cli_index')->with('error', 'Xác thực CAPTCHA thất bại. Vui lòng thử lại.');
        }
        $email = $req->email;
        $password =  md5($req->password);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();

        if ($result) {
            Session::put('fee', 15000);
            Session::save();
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            Session::flash('message', 'ĐĂNG NHẬP THÀNH CÔNG');

            $favorites = Favorite::where('customer_id', $result->customer_id)
                ->join('tbl_product', 'tbl_favorites.product_id', '=', 'tbl_product.product_id')
                ->select('tbl_product.product_id', 'tbl_product.product_name', 'tbl_product.product_price', 'tbl_product.product_image')
                ->get();
            Session::put('favorites', $favorites);
            return redirect()->route('cli_index');
        } else {
            return redirect()->route('cli_index')->with('error', 'ĐĂNG NHẬP THẤT BẠI');
        }
    }
    //lấy lại mật khẩu
    public function postSendcoderesetpassowrd(Request $req)
    {
        $email = $req->email;
        $checkUser = DB::table('tbl_customers')->Where('customer_email', $email)->first();

        if (!$checkUser) {
            return redirect()->back()->with('message', 'Không có email này');
            //return dd("khp6g tồn tại");
        }
        $code = bcrypt(md5(time() . $email));
        $checkUser->code = $code;
        $checkUser->code_time = Carbon::now();
        DB::table('tbl_customers')->where('customer_email', $email)->update(['code' => $code]);
        //$checkUser->save();

        $url = route('getdoimk', ['code' => $checkUser->code, 'email' => $email]);

        $data = [
            'route' => $url
        ];
        //dd($data);
        Mail::send('email.reset_password', $data, function ($message) use ($email) {
            $message->to($email, 'Reset password')->subject('lấy lại mật khẩu!!');
            $message->from($email);
        });

        return redirect()->route('cli_index')->with('message', 'BẠN VUI LÒNG VÀO CHECK MAIL ĐỂ LẤY LẠI MẬT KHẨU');
    }

    public function getdoimk(Request $req)
    {
        $code = $req->code;
        $email = $req->email;
        $checkUser = DB::table('tbl_customers')->where([
            'code' => $code,
            'customer_email' => $email
        ])->first();
        if (!$checkUser) {
            return redirect('cli_index')->with('danger', 'Xin lổi, đường dẩn không dúng, bạn vui lòng thử lại sao');
        }
        return view("email.layout_doimk");
    }

    public function postdoimk(Request $req)
    {
        $this->validate($req, [
            'password' => 'required|min:8|max:32',
            're_password' => 'required|same:password'
        ], [
            'password.required' => '+Bạn chưa nhập password',
            're_password.required' => '+Bạn chưa nhập lại password',
            'password.min' => '+password lớn hơn 8',
            'password.max' => '+Password lớn hơn 32',
            're_password.same' => '+Password chưa đúng'
        ]);
        $data = $req->all();
        $code = $req->code;
        $email = $req->email;
        //dd($data);
        $checkUser = DB::table('tbl_customers')->where([
            'code' => $code,
            'customer_email' => $email
        ])->first();

        if (!$checkUser) {
            return redirect('cli_index')->with('error', 'Xin lổi, đường dẩn không dúng, bạn vui lòng thử lại sao');
        }

        DB::table('tbl_customers')->where('customer_email', $email)->update(['customer_password' => md5($req->password)]);
        return redirect()->route('cli_index')->with('message', 'ĐỔI MẬT KHẨU THÀNH CÔNG, MỜI BẠN ĐĂNG NHẬP');
    }

    //end doi may khau

    public function del_fee()
    {
        Session::forget('fee');
        return redirect()->back();
    }
    public function payment(Request $request)
    {
        $url_canonical = $request->url();
        $meta_desc = "thanh toán";
        // $meta_keywords = $value->product_slug;
        $cate_post1 = CatePost::orderBy('cate_post_id', 'DESC')->get();
        $meta_title = "thanh toán";
        $chinh = chinhsach::limit(3)->get();
        $share_images = url('images/' . $request->product_image);
        $cate = category::all();
        $com = '';
        $bra = Brand::all();
        return view('client.payment', compact('cate', 'com', 'bra', 'url_canonical', 'meta_title', 'meta_desc', 'share_images', 'cate_post1', 'chinh'));
    }

    public function checkout(Request $request)
    {

        $url_canonical = $request->url();
        $meta_desc = "giỏ hàng";
        $cate_post1 = CatePost::orderBy('cate_post_id', 'DESC')->get();
        // $meta_keywords = $value->product_slug;
        $chinh = chinhsach::limit(3)->get();
        $meta_title = "giỏ hàng";
        $share_images = url('images/' . $request->product_image);
        $cate = category::all();
        $com = '';
        $bra = Brand::all();
        return view('client/cart', compact('cate', 'com', 'bra', 'url_canonical', 'meta_desc', 'meta_title', 'share_images', 'cate_post1', 'chinh'));
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback_google()
    {
        $users = Socialite::driver('google')->stateless()->user();

        $authUser = $this->findOrCreateUser($users, 'google');

        if ($authUser) {
            $account_name = custommer::where('google_id', $authUser->id)->first();
            if ($account_name) {
                if ($users->avatar) {
                    $account_name->avatar = $users->avatar;
                    $account_name->save();
                }
                Session::put('customer_name', $account_name->customer_name);
                Session::put('customer_id', $account_name->customer_id);
                Session::put('fee', 15000);
            }
        } else {
            $account_name = new custommer();
            $account_name->customer_name = $authUser->name;
            $account_name->customer_email = $authUser->email;
            $account_name->google_id = $authUser->id;
            $account_name->avatar = $users->avatar ?? '';
            $account_name->customer_phone = $authUser->phone ?? '';
            $account_name->save();

            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_id', $account_name->customer_id);
            Session::put('fee', 15000);
        }
        $favorites = Favorite::where('customer_id', $account_name->customer_id)
            ->join('tbl_product', 'tbl_favorites.product_id', '=', 'tbl_product.product_id')
            ->select('tbl_product.product_id', 'tbl_product.product_name', 'tbl_product.product_price', 'tbl_product.product_image')
            ->get();
        Session::put('favorites', $favorites);
        return redirect()->route('cli_index')->with('message', 'ĐĂNG NHẬP BẰNG TÀI KHOẢN GOOGLE THÀNH CÔNG');
    }

    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if ($authUser) {

            return $authUser;
        } else {
            $customer_new = new Social([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);
            $customer = custommer::where('customer_email', $users->email)->first();

            if (!$customer) {
                $customer = custommer::create([
                    'customer_name' => $users->name,
                    'customer_email' => $users->email,
                    'customer_password' => '',
                    'customer_phone' => ''
                ]);
            }
            $customer_new->login()->associate($customer);
            $customer_new->save();
            return $customer_new;
        }
    }
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        dd($provider);
        // $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        // if($account){
        //     //login in vao trang quan tri  
        //     $account_name = Login::where('admin_id',$account->user)->first();
        //     Session::put('admin_login',$account_name->admin_name);
        //     Session::put('admin_id',$account_name->admin_id);
        //     return redirect('/admin/dashboard')->with('message', 'Đăng nhập Admin thành công');
        // }else{

        //     $hieu = new Social([
        //         'provider_user_id' => $provider->getId(),
        //         'provider' => 'facebook'
        //     ]);

        //     $orang = Login::where('admin_email',$provider->getEmail())->first();

        //     if(!$orang){
        //         $orang = Login::create([
        //             'admin_name' => $provider->getName(),
        //             'admin_email' => $provider->getEmail(),
        //             'admin_password' => '',
        //             'admin_status' => 1

        //         ]);
        //     }
        //     $hieu->login()->associate($orang);
        //     $hieu->save();

        //     $account_name = Login::where('admin_id',$account->user)->first();

        //     Session::put('admin_login',$account_name->admin_name);
        //      Session::put('admin_id',$account_name->admin_id);
        //     return redirect('/admin/dashboard')->with('message', 'Đăng nhập Admin thành công');
        // } 
    }
}
