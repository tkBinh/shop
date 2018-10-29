<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('master');
//});

Route::get('/', [ 'as' => 'trang-chu', 'uses' => 'PageController@getIndex' ]);

Route::get('loai-san-pham',[ 'as' => 'loaisanpham', 'uses' => 'PageController@getLoaiSanPham' ]);

Route::get('chi-tiet-san-pham',[ 'as' => 'chitietsanpham', 'uses' => 'PageController@getChiTietSanPham' ]);

Route::get('gioi-thieu', [ 'as' => 'gioithieu', 'uses' => 'PageController@getGioiThieu' ]);

Route::get('lien-he', [ 'as' => 'lienhe', 'uses' => 'PageController@getLienHe' ]);


