<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\ReportAuction;

class ReportAuctionController extends Controller
{


    /**
     * Creates a new report User.
     *
     * @param  int  $auction_id
     * @return comment The auction comment.
     */
    public function create(Request $request, $auction_id)
    {
      
      $reportAuction = ReportAuction::create();

      $reportAuction->reason = $request->input('reason');
      $reportAuction->id_auction = $auction_id;
      $reportAuction->id_user = Auth::user()->user_id;
      $reportAuction->save();

      return $reportAuction;

    }
}
?>