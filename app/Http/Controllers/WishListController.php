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

    $deleteAuction = WishList::where('wishlist_id',$id)->first();
    echo $deleteAuction;

    if($deleteAuction!=null){
      $deleteAuction->delete();
    }

    return $deleteAuction;

  }

  public function addToWishList(Request $request,$id_auction){
    $wishList = new wishList();
    $auction = Auction::find($id_auction);
    if(Auth::check()){
      $CountWishList = WishList::where('wishlist.user_id',Auth::user()->user_id)
      ->orderBy('dateend','asc')->join('auction', 'auction.auction_id', '=','wishlist.auction_id')
      ->join('owner', 'owner.id_auction', '=', 'auction.auction_id')
      ->join('users', 'users.user_id', '=','owner.id_user')
      ->where('auction.active','=',1)
      ->get();
      $num_elems = count($CountWishList);
      for($i = 0;$i < $num_elems; $i++){
        if($CountWishList[$i]->auction_id == $id_auction){
          $wishList->message='Item already on the WishList! &nbsp';
          return $wishList;
        }
      }

      $wishList->user_id = Auth::user()->user_id;
      $wishList->auction_id = $id_auction;
      $wishList->date = date('Y-m-d H:i:s');
      $wishList->save();

  }else{
    $wishList->message='You have to login! &nbsp';
  }

  return $wishList;


  }
}
