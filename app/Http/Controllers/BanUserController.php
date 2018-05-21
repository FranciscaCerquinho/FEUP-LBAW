<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\BanUser;
use App\Admin;
use App\User;

class BanUserController extends Controller
{

    protected function banUser(Request $request,$id_user)
    {
      $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
      $ban_user = User::where('user_id',$id_user)->first();

      $ban_user->isbanned=true;
      $ban_user->save();

        return BanUser::create([
            'id_user' => $id_user,
            'id_admin' => $user_admin->id,
            'date' => date('Y-m-d H:i:s'),
        ]);
    }


    protected function unbanUser(Request $request,$id_user)
    {
        $unbanUser = BanUser::where('id_user',$id_user)->first();

        
        if($unbanUser){
            $unbanUser->delete();
            
            $ban_user = User::where('user_id',$id_user)->first();

            $ban_user->isbanned=false;
            $ban_user->save();
        }
  
        return $unbanUser;
    }





}
?>
