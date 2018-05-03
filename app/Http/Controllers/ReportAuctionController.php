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
     * Creates a new report Auction.
     *
     * @param  int  $auction_id
     * @return reportAuction The auction reported.
     */
    public function create(Request $request, $auction_id)
    {
      
      $reportAuction = new ReportAuction();
        
      $reportAuction->reason = $request->input('reason');
      $reportAuction->id_auction = $auction_id;
      $reportAuction->id_user = Auth::user()->user_id;
      $reportUser->date= date('Y-m-d H:i:s');
      $reportAuction->save();

      return $reportAuction;

    }
}
?>