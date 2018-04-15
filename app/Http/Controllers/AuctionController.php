<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;


class AuctionController extends Controller
{

    public function list()
    {

      $auctions = Auction::where('active', 1)->orderBy('dateend', 'asc')->get();
      return view('pages.auctions', [ 'auctions' => $auctions]);
    }



}
?>
