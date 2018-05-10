<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\Admin;

class SearchController extends Controller
{

    public function search($name = null) {
      
        return view('pages.search');
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


}

?>