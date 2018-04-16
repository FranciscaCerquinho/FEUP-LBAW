<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//use App\Card;

class UserController extends Controller
{
    /**
     * 
     * 
     * @return Response
     */
    public function show()
    {
      return view('pages.editProfile');
    }

    /**
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $user = User::where('email',$request->input('email')) -> first();
      
      $user->firstname = $request->input('firstName');
      $user->lastname = $request->input('lastName');
      $user->address = $request->input('address');

      // redirect
      Session::flash('message', 'Successfully updated your profile!');
      return Redirect::to('editProfile');
    }
}