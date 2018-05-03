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

Route::get('/', function () {
    return redirect('auctions');
});



//User
Route::get('editProfile', 'UserController@show')->name('editProfile');
Route::post('editProfile', 'UserController@update');
Route::get('administration', 'AdminController@show')->name('administration');
Route::get('owner/{id}', 'OwnerController@show')->name('ownerProfile');

// WishList

Route::get('wishList ','WishListController@list')->name("wishList");
Route::get('listAuction ','WishListController@show')->name("listAuction");

// Authentication

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Auctions

Route::get('auctions', 'AuctionController@list')->name('auction');
Route::get('auction/{id}', 'AuctionController@show')->name('item');
Route::post('likeAuction/{id}', 'AuctionController@updateLike');
Route::post('unlikeAuction/{id}', 'AuctionController@updateUnlike');

//Auctions comments

Route::post('comment/{id}', 'CommentController@create');
//Footer

Route::get('about', 'FooterController@showAbout')->name('about');
Route::get('faq', 'FooterController@showFAQ')->name('faq');
Route::get('contact_us', 'FooterController@showContactUs')->name('contact_us');
