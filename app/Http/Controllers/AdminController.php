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
      $reported_users = DB::table('reportuser')->join('users','users.user_id','=','reportuser.id_userreported')->orderBy('id','asc')->get();
      $reporting_users = DB::table('reportuser')->join('users','users.user_id','=','reportuser.id_userreporting')->orderBy('id','asc')->get();
      $reported_auctions = DB::table('reportauction')
      ->join('auction','auction.auction_id','=','reportauction.id_auction')
      ->join('users','users.user_id','=','reportauction.id_user')->get();

      return view('pages.administration',['type' => $type, 'reported_users'=>$reported_users,  'reporting_users'=>$reporting_users, 'reported_auctions'=>$reported_auctions]);
    }





}
?>
