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

Route::get('wishList','WishListController@list')->name("wishList");
Route::get('listAuction','WishListController@show')->name("listAuction");
Route::delete('deleteFromWishList/{id}','WishListController@deleteFromWishList')->name("deleteFromWishList");
Route::post('addToWishList/{id_auction}','WishListController@addToWishList')->name("addToWishList");

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'ResetPasswordController@reset')->name('resetPassword');

//Auctions
Route::get('auctions', 'AuctionController@list')->name('auction');
Route::get('auction/{id}', 'AuctionController@show')->name('item');
Route::post('likeAuction/{id}', 'AuctionController@updateLike');
Route::post('unlikeAuction/{id}', 'AuctionController@updateUnlike');

Route::get('myAuctions', 'AuctionController@myAuctions')->name('myAuctions');
Route::get('addAuction','AuctionController@showAddAuction')->name('addAuction');
Route::post('addAuction', 'AuctionController@create');
Route::post('auctionTime/{id}', 'AuctionController@auctionTime')->name('auctionTime');
Route::post('inactiveAuction/{id}', 'AuctionController@inactiveAuction')->name('inactiveAuction');

Route::post('endAuction/{id}', 'EndAuctionController@endAuction')->name('endAuction');

//Auctions comments
Route::post('comment/{id}', 'CommentController@create');
Route::post('likeComment/{id}', 'CommentController@updateLike');
Route::post('unlikeComment/{id}', 'CommentController@updateUnlike');

//User bids
Route::get('myBids', 'BidController@show')->name('myBids');
Route::post('makeBid/{id}', 'BidController@makeBid')->name('makeBid');

//BuyNow Auctions
Route::post('buyNow/{id}', 'BuyNowController@buyNow')->name('buyNow');

//Search
Route::get('category/{id}', 'SearchController@searchByCategory')->name('searchByCategory');
Route::get('search/{name?}','SearchController@search')->name('search');
Route::post('showCategory','SearchController@showCategory')->name('showCategory');

//Report Auction
Route::post('reportAuction/{id}', 'ReportAuctionController@create')->name('reportAuction');

//Report User
Route::post('reportUser/{id}', 'ReportUserController@create')->name('reportUser');
Route::post('reportOwner/{id}', 'ReportUserController@reportOwner')->name('reportOwner');

//Ban User
Route::post('banUser/{id}', 'BanUserController@banUser')->name('banUser');
Route::delete('unbanUser/{id}', 'BanUserController@unbanUser')->name('unbanUser');

//Ban Auction
Route::post('banAuction/{id}', 'BanAuctionController@banAuction')->name('banAuction');
Route::delete('unbanAuction/{id}', 'BanAuctionController@unbanAuction')->name('unbanAuction');

//Footer
Route::get('about', 'FooterController@showAbout')->name('about');
Route::get('faq', 'FooterController@showFAQ')->name('faq');
Route::get('contact_us', 'FooterController@showContactUs')->name('contact_us');
