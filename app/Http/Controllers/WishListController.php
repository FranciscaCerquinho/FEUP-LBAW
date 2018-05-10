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

    $wishList = WishList::orderBy('dateend','asc')->join('owner', 'owner.id_auction', '=', 'auction_id')->join('users', 'users.user_id', '=', 'owner.id_user')->join('auction', 'auction.auction_id', '=','auction_id')->get();
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
}
