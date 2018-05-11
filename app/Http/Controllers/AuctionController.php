<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use DateTime;

use App\Auction;
use App\Comment;
use App\Admin;
use App\Owner;
use App\ReportAuction;
use App\Category;

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
      $commentsLikes = array();
      $comment_likes = array();
      $auctionReported=0;

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

        $comment_likes = DB::table('usercommentlike')
        ->join('comment', 'comment.id', '=', 'usercommentlike.id_comment')->where('usercommentlike.id_user','=',Auth::user()->user_id)
        ->join('auction','auction.auction_id','=','comment.id_auction')->where('auction_id', '=', $id)
        ->orderBy('comment.date','asc')
        ->get();
        
        if($comment_likes!=null){
          for($i=0; $i< count($comment_likes);$i++){
          if($comment_likes[$i]->islike==true)
            array_push($commentsLikes,1);
          else
            array_push($commentsLikes,2);
          }
        }
        $auctionReported = ReportAuction::where([['id_auction','=',$id],['id_user','=',Auth::user()->user_id]])
        ->first();
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

   
      if($auctionReported!=null){
        $reported=1;
      }
      else{
        $reported=0;
      }
      return view('pages.item',['auction' => $auction, 'comments'=> $comments,'type' => $type,'like'=>$like, 'commentsLikes'=> $commentsLikes, 'id_comment_likes' => $comment_likes, 'auctionReported'=>$reported]);
    }

    public function myAuctions(){
            
      if(Auth::check()){
        $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        if($user_admin==null)
          $type=1;
        else
          $type=2;
      
      }
      else
        $type=0;
      
        $auctions = DB::table('owner')->where('id_user',Auth::user()->user_id)
        ->join('users', 'users.user_id', '=', 'owner.id_user')
        ->join('auction','auction_id','=','owner.id_auction')
        ->where('auction.active',1)->orderBy('dateend','asc')->get();

        return view('pages.userAuctions', [ 'auctions' => $auctions, 'type' => $type]);
    }

    public function showAddAuction(){
      if(Auth::check()){
        $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        if($user_admin==null)
          $type=1;
        else
          $type=2;
      
      }
      else
        $type=0;
      
      return view('pages.addAuction',['type' => $type]);
    }
    
    /**
     * Creates a new auction.
     *
     * @return Auction The auction created.
     */
    public function create(Request $request)
    {

      $rules = array (
        'name' => 'required|string|max:255',
        'dateEnd' => 'required|date_format:d/m/Y H:i|after:now',
        'description' => 'required|string|max:255',
        'actualPrice' => 'required|regex:/^\d*(\.\d{2})?$/',
        'photo' => 'required|mimes:jpg,png,jpeg,gif,svg',
        'buyNow' => 'required|regex:/^\d*(\.\d{2})?$/',
        'category' => ['required', Rule::in(['Electronics', 'Fashion', 'Home & Garden', 'Motors', 'Music', 'Toys', 'Daily Deals', 'Sporting', 'Others'])]
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()){
        return view('pages.addAuction')->withErrors($validator);
      }
               
      $auction = new Auction();
      $owner = new Owner();
      $category = new Category();

      //$this->authorize('create', $auction);
      //$this->authorize('create', $owner);
      //$this->authorize('create', $category);

      $auction->name = $request->input('name');
      $auction->datebegin = date('Y-m-d H:i:s');
      $auction->dateend = date("Y-m-d H:i:s", DateTime::createFromFormat("d/m/Y H:i", $request->input('dateEnd'))->getTimestamp());
      $auction->description = $request->input('description');
      $auction->actualprice = doubleval($request->input('actualPrice'));

      $imageName= $request->file('photo')->getClientOriginalName();
      $request->file('photo')->move(public_path('images/'),$imageName);
      $auction->auctionphoto = $imageName;
      //$auction->auctionphoto = $request->input('photo');
      $auction->buynow = $request->input('buyNow');
      $auction->active = '1';
      $auction->auction_like = 0;
      $auction->auction_dislike = 0;
      $auction->save();
      
      $owner->id_user = Auth::user()->user_id;
      $owner->id_auction = $auction->auction_id;
      $owner->save();

      $category->id_auction = $auction->auction_id;
      $category->category = $request->input('category');
      $category->save();

      return redirect()->action('AuctionController@show', $auction->auction_id);
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
      if(Auth::check()){
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

      if(Auth::check()){
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
    }      
      return $auction;
    }

    public function auctionTime(Request $request, $auction_id){
    
      $auction = Auction::where('auction_id','=',$auction_id)->where('active','=',1)->first();

      return $auction;
    }

    public function inactiveAuction(Request $request, $auction_id)
    {
      $auction = Auction::find($auction_id);

      $auction->active=0;
      $auction->save();

      return $auction;
    }

}
?>
