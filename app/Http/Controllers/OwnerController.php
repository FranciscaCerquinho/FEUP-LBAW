<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Owner;
use App\User;
use App\Admin;

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

        $owner = Owner::where('id_auction',$id)
      ->join('users', 'users.user_id', '=', 'owner.id_user')
      ->first();

        if($owner == null)
            return view('errors.404');
      
        return view('pages.ownerProfile',['owner' => $owner, 'type' => $type]);

    }

    

}
?>
