<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\EndAuction;


class EndAuctionController extends Controller
{


    public function endAuction(Request $request,$id)
    {
        $endAuction = EndAuction::where('id',$id)->first();

        if($endAuction!=null){
            $endAuction->status='0';
            $endAuction->save();
        }
       
        return $endAuction;
    }

}
?>
