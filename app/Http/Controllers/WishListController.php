<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Admin;
use App\WishList;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{

  public function list()
  {

    if(Auth::check()){
      $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
      if($user_admin==null)
        $type=1;
      else
        $type=2;
    }
    else
      $type=0;

    $wishList = WishList::where('wishlist.user_id',Auth::user()->user_id)
    ->orderBy('dateend','asc')->join('auction', 'auction.auction_id', '=','wishlist.auction_id')
    ->join('owner', 'owner.id_auction', '=', 'auction.auction_id')
    ->join('users', 'users.user_id', '=','owner.id_user')
    ->where('auction.active','=',1)
    ->get();

    return view('pages.WishList', [ 'wishList' => $wishList, 'type' => $type]);
  }

  public function show($id){
    if(Auth::check()){
      $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
      if($user_admin==null)
        $type=1;
      else
        $type=2;
    }
    else
      $type=0;

    $listAuction = Auction::where('auction_id',$id)
    ->join('owner', 'owner.id_auction', '=', 'auction_id')
    ->join('users', 'users.user_id', '=', 'owner.id_user')
    ->first();

    if($listAuction == null)
      return view('errors.404');

    return view('pages.WishList',['listAuction' => $listAuction,'type' => $type]);
  }

  public function deleteFromWishList(Request $request, $id){
    $deleteAuction = WishList::where('id',$id)->first();

    echo $deleteAuction;
    if($deleteAuction){
      $deleteAuction->delete();
    }

    return $deleteAuction;

  }
}
