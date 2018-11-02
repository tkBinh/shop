<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\ProductType;
use App\Slide;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function getLogin()
    {
        return view('page.dang_nhap');
    }

    public function getSignup()
    {
        return view('page.dang_ki');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email|unique:users,email',
                'passWord' => 'required|min:6|max:20',
                'fullName' => 'required',
                'rePassword' => 'required|same:passWord'
            ],
            [
                'email.required' => 'Mời nhập email',
                'email.email' => 'Email sai định dạng',
                'email.unique' => 'Email đã tồn tại',
                'passWord.required' => 'Mời nhập mật khẩu',
                'rePassword.same' => 'Mật khẩu nhập lại không khớp',
                'passWord.min' => 'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new User();
        $user->full_name = $request->fullName;
        $user->email = $request->email;
        $user->password = Hash::make($request->passWord);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('successAcc', 'Tạo tài khoản thành công');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email',
                'passWord' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Email chưa đúng định dạng',
                'passWord.required' => 'Bạn chưa nhập mật khẩu',
                'passWord.min' => 'Mật khẩu tối thiểu 6 kí tự',
                'passWord.max' => 'Mật khẩu tối đa 20 kí tự'
            ]
        );
        $credentials = array('email' => $request->email, 'password' => $request->passWord);
        if (Auth::attempt($credentials)) {
            return redirect()->route('trang-chu')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
        }
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

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('trang-chu')->with(['message' => 'Đăng xuất thành công']);
    }

    public function getSearch(Request $request)
    {
        $product = Product::where('name', 'like', '%' . $request->key . '%')
            ->orWhere('unit_price', $request->key)
            ->get();
        return view('page.search', compact('product'));
    }

    public function getDelCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceOne($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getCheckOut()
    {
        return view('page.dat_hang');
    }

    public function postCheckOut(Request $request)
    {

    }
}
