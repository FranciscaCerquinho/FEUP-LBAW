<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\BanUser;

class BanUserController extends Controller
{

    protected function banUser($id_user)
    {
      $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        return BanUser::create([
            'id_user' => $id_user,
            'id_admin' => $user_admin->id,
            'date' => date('Y-m-d H:i:s'),
        ]);
    }





}
?>
