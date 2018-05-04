<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\BanAuction;
use App\Admin;

class BanAuctionController extends Controller
{

    protected function banAuction($id_auction)
    {
      $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        return BanAuction::create([
            'id_user' => $user_admin->id,
            'id_auction' => $id_auction,
            'date' => date('Y-m-d H:i:s'),
        ]);
    }

    protected function unbanAuction(Request $request,$id_auction)
    {   
        $unbanAuction = BanAuction::where('id_auction',$id_auction)->first();

        if($unbanAuction)
            $unbanAuction->delete();
      
        return $unbanAuction;
    }





}
?>
