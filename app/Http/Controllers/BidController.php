<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Bid;
use App\Auction;
use App\Admin;

class BidController extends Controller
{

    public function show()
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

        $auctions = Bid::where('bid_id_user', Auth::user()->user_id)->orderBy('date','asc')->join('auction', 'auction.auction_id', '=', 'bid.bid_id_auction')->join('owner', 'owner.id_auction', '=', 'bid.bid_id_auction')
        ->join('users','users.user_id','=','owner.id_user')->get();
        
        return view('pages.userBids', ['auctions'=> $auctions,'type' => $type]);
    }

    protected function makeBid(Request $request, $auction_id)
    {
        $bid = new Bid();
        $auction = Auction::find($auction_id);

        $bid->status = 1;
        $bid->price = $request->input('bid');
        $bid->date = date('Y-m-d H:i:s');
        $bid->bid_id_auction = $auction_id;
        $bid->bid_id_user = Auth::user()->user_id;
        $bid->save();

        $auction->actualprice = $request->input('bid');
        $auction->save();
     

        return $bid;
    }





}
?>
