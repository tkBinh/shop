<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex() {
    	return view("page.trangchu");
    }

    public function getLoaiSanPham() {
        return view('page.loai_san_pham');
    }

    public function getChiTietSanPham() {
        return view('page.chi_tiet_san_pham');
    }

    public function getLienHe() {
        return view('page.lien_he');
    }

    public function getGioiThieu() {
        return view('page.gioi_thieu');
    }
}
