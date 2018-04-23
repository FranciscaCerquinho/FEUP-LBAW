<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\Comment;
use App\Admin;

class AuctionController extends Controller
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
      
      $auctions = Auction::where('active', 1)->orderBy('dateend','asc')->join('owner', 'owner.id_auction', '=', 'auction_id')->join('users', 'users.user_id', '=', 'owner.id_user')->get();
      return view('pages.auctions', [ 'auctions' => $auctions, 'type' => $type]);
    }

    public function show($id){
      $like=0;
      if(Auth::check()){
        $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        if($user_admin==null)
          $type=1;
        else
          $type=2;

        $user_like = DB::table('userauctionlike')->where([['id_auction','=', $id],['id_user','=',Auth::user()->user_id]])->first();
        if($user_like!=null){
          if($user_like->islike==true)
            $like=1;
          else
            $like=2;
        }
      }
      else
        $type=0;

      $auction = Auction::where('auction_id',$id)
      ->join('owner', 'owner.id_auction', '=', 'auction_id')
      ->join('users', 'users.user_id', '=', 'owner.id_user')
      ->join('category','category.id_auction','=','auction_id')
      ->first();

      if($auction == null)
        return view('errors.404');
        
      $comments = Comment::where('id_auction',$id)
      ->join('users', 'users.user_id', '=', 'comment.id_user')
      ->orderBy('date','asc')
      ->get();
      return view('pages.item',['auction' => $auction, 'comments'=> $comments,'type' => $type,'like'=>$like]);
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

      $owner->id_user = Auth::user()->user_id;
      $owner->id_auction = $auction->auction_id;
      $owner->save();

      return $auction;
    }

        /**
     * Updates the state of an individual item.
     *
     * @param  int  $auction id
     * @param  Request request containing the new state
     * @return Response
     */
    public function updateLike(Request $request, $auction_id)
    {
      $auction = Auction::find($auction_id);

      $user_like= DB::table('userauctionlike')->where([['id_auction','=', $auction_id],['id_user','=',Auth::user()->user_id]])->first();

      if($user_like==null){
        DB::table('userauctionlike')->insert(['id_user'=> Auth::user()->user_id, 'id_auction'=> $auction_id, 'islike'=>true]);
        $auction->auction_like = $request->input('like');
        $auction->save();
      }
      else {
        if($user_like->islike == false){
          $auction->auction_dislike=$auction->auction_dislike-1;
          $auction->auction_like=$auction->auction_like+1;
          $auction->save();
          DB::table('userauctionlike')->where([['id_auction','=', $auction_id],['id_user','=',Auth::user()->user_id]])->update(['islike'=> true]);
        }

      }
     
      return $auction;
    }

            /**
     * Updates the state of an individual item.
     *
     * @param  int  $auction id
     * @param  Request request containing the new state
     * @return Response
     */
    public function updateUnlike(Request $request, $auction_id)
    {
      $auction = Auction::find($auction_id);

      $user_like= DB::table('userauctionlike')->where([['id_auction','=', $auction_id],['id_user','=',Auth::user()->user_id]])->first();

      if($user_like==null){
        DB::table('userauctionlike')->insert(['id_user'=> Auth::user()->user_id, 'id_auction'=> $auction_id, 'islike'=>true]);
        $auction->auction_dislike = $request->input('unlike');
        $auction->save();

      }
      else {
        if($user_like->islike == true){
          $auction->auction_like=$auction->auction_like-1;
          $auction->auction_dislike=$auction->auction_dislike+1;
          $auction->save();
          DB::table('userauctionlike')->where([['id_auction','=', $auction_id],['id_user','=',Auth::user()->user_id]])->update(['islike'=> false]);
        }

      }
      return $auction;
    }
    

}
?>
