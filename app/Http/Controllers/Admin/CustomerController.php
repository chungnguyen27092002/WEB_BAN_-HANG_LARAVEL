<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\custommer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = custommer::all();
        return view('manager.customer.index', compact('customers'));
    }

    // Xử lý lưu thông tin khách hàng mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
        ]);

        $customer = new custommer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    // Hiển thị thông tin chi tiết khách hàng
    public function show($id)
    {
        $customer = custommer::findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    // Hiển thị form chỉnh sửa thông tin khách hàng
    public function edit($id)
    {
        $customer = custommer::findOrFail($id);
        return view('manager.customer.update_customer', compact('customer'));
    }

    // Xử lý cập nhật thông tin khách hàng
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'numeric', // Kiểm tra số điện thoại
            'customer_password' => 'nullable|min:6', // Mật khẩu có thể bỏ trống nhưng nếu có thì ít nhất 6 ký tự
        ]);
    
        // Tìm khách hàng theo ID
        $customer = custommer::findOrFail($id);
    
        // Cập nhật các trường không phải mật khẩu
        $customer->customer_name = $request->customer_name;
        $customer->customer_email = $request->customer_email;
        $customer->customer_phone = $request->customer_phone;
    
        // Cập nhật mật khẩu nếu có
        if ($request->has('customer_password') && $request->customer_password) {
            $customer->customer_password = bcrypt($request->customer_password); // Mã hóa mật khẩu
        }
    
        // Lưu thông tin khách hàng
        $customer->save();
        $customers = custommer::all();
        // Chuyển hướng lại trang danh sách khách hàng với thông báo thành công
        return view('manager.customer.index', compact('customers'))->with('message', 'Chỉnh sửa thành công.');
    }
    

    // Xóa khách hàng
    public function destroy($id)
    {
        $customer = custommer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('message', 'Xóa thành công.');
    }
}
