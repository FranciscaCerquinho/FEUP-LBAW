<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    /**
     * Shows the administration page
     *
     * @return Response
     */
    public function show()
    {
      $type=2;

      $reported_users_NotBan = DB::table('reportuser')
      ->join('users','users.user_id','=','reportuser.id_userreported')
      ->whereNotIn('id_userreported', function($query) {
        $query->select('id_user')->from('banuser');
      })
      ->orderBy('date','desc')->get();
      
      $reporting_users_NotBan = DB::table('reportuser')
      ->join('users','users.user_id','=','reportuser.id_userreporting')
      ->whereNotIn('id_userreported', function($query) {
        $query->select('id_user')->from('banuser');
      })
      ->orderBy('date','desc')->get();

      $reported_users_Ban = DB::table('reportuser')
      ->join('users','users.user_id','=','reportuser.id_userreported')
      ->whereIn('id_userreported', function($query) {
        $query->select('id_user')->from('banuser');
      })
      ->orderBy('date','desc')->get();
      
      $reporting_users_Ban = DB::table('reportuser')
      ->join('users','users.user_id','=','reportuser.id_userreporting')
      ->whereIn('id_userreported', function($query) {
        $query->select('id_user')->from('banuser');
      })
      ->orderBy('date','desc')->get();
      
      $reported_auctions_NotBan = DB::table('reportauction')
      ->join('auction','auction.auction_id','=','reportauction.id_auction')
      ->join('users','users.user_id','=','reportauction.id_user')
      ->whereNotIn('auction_id', function($query) {
        $query->select('id_auction')->from('banauction');
      })
      ->orderBy('date','desc')
      ->get();

      $reported_auctions_Ban = DB::table('reportauction')
      ->join('auction','auction.auction_id','=','reportauction.id_auction')
      ->join('users','users.user_id','=','reportauction.id_user')
      ->whereIn('auction_id', function($query) {
        $query->select('id_auction')->from('banauction');
      })
      ->orderBy('date','desc')
      ->get();

      return view('pages.administration',['type' => $type, 'reported_users_Ban'=>$reported_users_Ban,  'reporting_users_Ban'=>$reporting_users_Ban,'reported_users_NotBan'=>$reported_users_NotBan,  'reporting_users_NotBan'=>$reporting_users_NotBan, 'reported_auctions_NotBan'=>$reported_auctions_NotBan, 'reported_auctions_Ban'=>$reported_auctions_Ban]);
    }





}
?>
