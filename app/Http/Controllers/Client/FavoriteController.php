<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class FavoriteController extends Controller
{
    //
    public function addToFavorites($product_id)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Session::has('customer_id')) {
            return redirect()->route('login')->with('message', 'Bạn cần đăng nhập trước để thêm sản phẩm vào yêu thích.');
        }
    
        // Lấy thông tin người dùng từ session
        $customer_id = Session::get('customer_id'); 
    
        // Kiểm tra xem sản phẩm đã có trong mục yêu thích chưa
        $existingFavorite = Favorite::where('customer_id', $customer_id)
                                    ->where('product_id', $product_id)
                                    ->first();
    
        if ($existingFavorite) {
            // Nếu đã có sản phẩm trong mục yêu thích, thông báo và quay lại trang trước
            return redirect()->back()->with('message', 'Sản phẩm đã có trong mục yêu thích');
        }
    
        // Nếu chưa có, thêm sản phẩm vào mục yêu thích
        $favorite = new Favorite();
        $favorite->customer_id = $customer_id;
        $favorite->product_id = $product_id;
        $favorite->save();
        $favorites = Favorite::where('customer_id',  $customer_id)
        ->join('tbl_product', 'tbl_favorites.product_id', '=', 'tbl_product.product_id')
        ->select('tbl_product.product_id', 'tbl_product.product_name', 'tbl_product.product_price', 'tbl_product.product_image')
        ->get();
        Session::put('favorites', $favorites);
        // Thông báo thành công và quay lại trang trước
        return redirect()->back()->with('message', 'Thêm sản phẩm vào yêu thích thành công');
    }
    
    // Xóa sản phẩm khỏi mục yêu thích
    public function removeFromFavorites($product_id)
    {
        // Lấy thông tin người dùng từ session
        $customer_id = Session::get('customer_id');
        
        // Tìm sản phẩm yêu thích của khách hàng
        $favorite = Favorite::where('customer_id', $customer_id)
                            ->where('product_id', $product_id)
                            ->first();
    
        if ($favorite) {
            // Xóa sản phẩm yêu thích
            $favorite->delete();
    
            // Cập nhật lại danh sách sản phẩm yêu thích trong session
            $favorites = Favorite::where('customer_id', $customer_id)
                                 ->join('tbl_product', 'tbl_favorites.product_id', '=', 'tbl_product.product_id')
                                 ->select('tbl_product.product_id', 'tbl_product.product_name', 'tbl_product.product_price', 'tbl_product.product_image')
                                 ->get();
            Session::put('favorites', $favorites);
            
            // Thông báo thành công
            return redirect()->back()->with('message', 'Sản phẩm đã được xóa khỏi mục yêu thích');
        }
    
        // Nếu không tìm thấy sản phẩm yêu thích, trả về thông báo lỗi
        return redirect()->back()->with('message', 'Không tìm thấy sản phẩm yêu thích');
    }
    
}
