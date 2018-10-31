<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\ProductType;
use App\Slide;
use Illuminate\Http\Request;
use Session;

class PageController extends Controller
{
    /*
     * Slide: Model Slide chứa ảnh cho slide trên trangchu.php
     * $slide: biến chứa đối tượng là 1 mảng các ảnh thông qua truy vấn all()
     * compact('biến'): Đưa biến ra view để hiển thị.
     *
     * Product: Model Product chứa sản phẩm
     * $productNew: biến chứa mảng sản phẩm mới thông qua query
     *
     * */
    public function getIndex()
    {
        $slide = Slide::all();
        $productNew = Product::where('new', 1)->paginate(4);
        $productDiscount = Product::where('promotion_price', '<>', 0)->paginate(8);
        return view("page.trangchu", compact('slide', 'productNew', 'productDiscount'));
    }

    /*
     * $type là param chứa Id sản phẩm truyền vào
     * */

    public function getLoaiSanPham($type)
    {
        $productByType = Product::where('id_type', $type)->get();
        $productNotByType = Product::where('id_type', '<>', $type)->paginate(3);
        $productTypeList = ProductType::all();
        $productType = ProductType::where('id', $type)->first();
        return view('page.loai_san_pham', compact('productByType', 'productNotByType', 'productTypeList', 'productType'));
    }

    public function getChiTietSanPham(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $sameTypeProduct = Product::where('id_type', $product->id_type)->paginate(6);
        return view('page.chi_tiet_san_pham', compact('product', 'sameTypeProduct'));
    }

    public function getLienHe()
    {
        return view('page.lien_he');
    }

    public function getGioiThieu()
    {
        return view('page.gioi_thieu');
    }

    public function getAddToCart($id, Request $request)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }
}
