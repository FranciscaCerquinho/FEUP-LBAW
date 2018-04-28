<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\BanUser;

class BanUserController extends Controller
{

    /**
     * Shows the administration page
     *
     * @return Response
     */
    public function show()
    {
      //{{ Form::checkbox('agree') }}

      if($input == true)
      {
          $news->active = 'false';
          $news->update($input);
      }
      else{
          $news->active = 'true';
          $news->update($input);
}
    }

    protected function banUser(array $data)
    {
      $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        return BanUser::create([
            'id_user' => $data['firstName'],
            'id_admin' => $user_admin->id,
            'isbanned' => 'true',
            'datebegin' => date('Y-m-d H:i:s'),
        ]);
    }





}
?>
