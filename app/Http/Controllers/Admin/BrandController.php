<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function index()
    {
        $brands = Brand::all();
        return view('manager/brand_product/index', compact('brands'));
    }
    public function show()
    {
        $brands = Brand::all();
        return view('manager/brand_product/index', compact('brands'));
    }

    public function create()
    {
        return view('manager/brand_product/add_brand');
    }

    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'brand_name' => 'required|string|max:255', // Tên thương hiệu
        'brand_description' => 'nullable|string|max:500', // Mô tả
        'brand_status' => 'required|in:0,1', // Trạng thái (0: ẩn, 1: hiện)
    ]);

    // Lấy tất cả dữ liệu từ form
    $data = $request->only(['brand_name', 'brand_description', 'brand_status']);

    // Tạo mới thương hiệu
    Brand::create($data);

    // Quay lại trang danh sách thương hiệu với thông báo thành công
    return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được thêm thành công.');
}


    public function edit($id)
    {
        $brand=Brand::FindOrFail($id);
        return view('manager/brand_product/edit_brand', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_description' => 'nullable|string|max:500',
            'brand_status' => 'required|in:0,1',
        ]);

        $data = $request->all();

        $brand->update($data);

        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được cập nhật.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Thương hiệu đã được xóa.');
    }
}
