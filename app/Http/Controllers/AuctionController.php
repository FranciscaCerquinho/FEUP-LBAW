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

      $auctions = Auction::where('active', 1)->orderBy('dateend', 'asc')->join('owner', 'owner.id_auction', '=', 'id')->join('users', 'users.id', '=', 'owner.id_user')->get();
      return view('pages.auctions', [ 'auctions' => $auctions]);
    }
 
    /**
     * Creates a new auction.
     *
     * @return Auction The auction created.
     */
    public function create(Request $request)
    {
      $auction = new Auction();
      $owner = new Owner();

      $this->authorize('create', $auction);
      $this->authorize('create', $owner);

      $auction->name = $request->input('name');
      $auction->dateEnd = $request->input('dateEnd');
      $auction->description = $request->input('description');
      $auction->actualPrice = $request->input('actualPrice');
      $auction->photo = $request->input('photo');
      $auction->buyNow = $request->input('buyNow');
      $auction->active = 1;
      $auction->save();

      $owner->id_user = Auth::user()->id;
      $owner->id_auction = $auction->id;
      $owner->save();

      return $auction;
    }

}
?>
