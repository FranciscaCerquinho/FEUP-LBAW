<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\BuyNow;
use App\Auction;


class BuyNowController extends Controller
{


    protected function buyNow(Request $request,$auction_id)
    {
        $findBuyNow= BuyNow::where('id_auction',$auction_id);
        $buyNow;
        if($findBuyNow!=null){
        $buyNow = new BuyNow();
        $auction = Auction::find($auction_id);


        $buyNow->id_user = Auth::user()->user_id;
        $buyNow->id_auction = $auction_id;
        $buyNow->save();

        $auction->active = 0;
        $auction->save();
        }

        return $buyNow;
    }





}
?>