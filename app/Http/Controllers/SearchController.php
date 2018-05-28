<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\Admin;

class SearchController extends Controller
{

    public function search() {
      $type=0;
      if(Auth::check()){
        $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        if($user_admin==null)
          $type=1;
        else
          $type=2;
      }

      $name = Input::get('q');

      $auctions = Self::searchByName($name);

      return view('pages.searchName', [ 'auctions' => $auctions, 'type' => $type]);
    }

    public function searchByCategory($category)  {
        $type=0;
       if(Auth::check()){
         $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
         if($user_admin==null)
           $type=1;
         else
           $type=2;
       }
   
      $auctions =DB::table('category')->where('category', $category)
       ->join('auction','auction.auction_id','=', 'category.id_auction')->where('active',1)
       ->join('owner', 'owner.id_auction', '=', 'auction_id')
       ->join('users', 'users.user_id', '=', 'owner.id_user')->get();
 
       
       return view('pages.search', [ 'auctions' => $auctions, 'type' => $type]);
   
     }


    public function showCategory(Request $request)  {

       $auctions=[];

       $arrayCategories = $request->input('categoryChecked');
       $categories = explode(',', $arrayCategories);

       foreach($categories as $category){
            $array =DB::table('category')->where('category', $category)
            ->join('auction','auction.auction_id','=', 'category.id_auction')->where('active',1)
            ->join('owner', 'owner.id_auction', '=', 'auction_id')
            ->join('users', 'users.user_id', '=', 'owner.id_user')->get()->toArray();
            $auctions = array_merge($auctions, $array);
        }
        
       return $auctions;
   
     }

     public function searchResults(Request $request) {
      $searchValue = $request->input('searchValue');

      return Self::searchByName($searchValue);
    }

    public function searchByName($name) {
      $resultsArray = DB::table('auction')
      ->join('owner','owner.id_auction', '=', 'auction_id')
      ->join('users','users.user_id', '=', 'owner.id_user')
      ->whereRaw('to_tsvector(\'english\',auction.description) @@ plainto_tsquery(\'english\',?)',[$name])
      ->orWhereRaw('to_tsvector(\'english\',auction.name) @@ plainto_tsquery(\'english\',?)',[$name])->get()->toArray();

      return $resultsArray;
    }

    public function getSearchResults() {

    }

}

?>