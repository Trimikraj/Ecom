<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin', 'as'=> 'admin','middleware'=> ['auth']],function(){
	Route::resource('banners','AdminBannerController');
	Route::resource('brands','AdminBrandController');
	Route::resource('categories','AdminCategoryController');
	Route::resource('contacts','AdminContactController');
	Route::resource('coupons','AdminCouponController');
	Route::resource('customers','AdminCustomerController');
	Route::resource('customers_groups','AdminCustomerGroupController');
	Route::resource('pages','AdminPageController');
	Route::resource('products','AdminProductController');	
});