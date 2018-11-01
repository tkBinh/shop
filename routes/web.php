<?php

Route::get('/', ['as' => 'trang-chu', 'uses' => 'PageController@getIndex']);

Route::get('loai-san-pham/{type}', ['as' => 'loaisanpham', 'uses' => 'PageController@getLoaiSanPham']);

Route::get('chi-tiet-san-pham/{id}', ['as' => 'chitietsanpham', 'uses' => 'PageController@getChiTietSanPham']);

Route::get('gioi-thieu', ['as' => 'gioithieu', 'uses' => 'PageController@getGioiThieu']);

Route::get('lien-he', ['as' => 'lienhe', 'uses' => 'PageController@getLienHe']);

Route::get('add-to-cart/{id}', ['as' => 'themgiohang', 'uses' => 'PageController@getAddToCart']);

Route::get('dang-nhap', [ 'as' => 'login', 'uses' => 'PageController@getLogin' ]);

Route::post('dang-nhap', [ 'as' => 'login', 'uses' => 'PageController@postLogin' ]);

Route::get('dang-ki', [ 'as' => 'signup', 'uses' => 'PageController@getSignup' ]);

Route::post('dang-ki', [ 'as' => 'signup', 'uses' => 'PageController@postSignup' ]);

Route::get('dang-xuat', ['as' => 'logout', 'uses' => 'PageController@getLogout']);

Route::get('search', ['as' => 'search', 'uses' => 'PageController@getSearch']);

Route::get('del-cart/{id}', ['as' => 'xoagiohang', 'uses' => 'PageController@getDelCart']);


