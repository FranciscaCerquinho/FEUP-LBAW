<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Owner;
use App\Admin;
use App\Auction;

class OwnerController extends Controller
{

    
    public function show($id){
        if(Auth::check()){
            $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
            if($user_admin==null)
              $type=1;
            else
              $type=2;
          }
          else
            $type=0;

        $owner = Owner::where('user_id',$id)
        ->join('users', 'users.user_id', '=', 'id_user')
        ->first();

     
       
        if($owner == null)
            return view('errors.404');
      
        return view('pages.ownerProfile',['owner' => $owner, 'type' => $type]);

    }

    

}
?>
