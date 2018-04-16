<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\User;

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
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
      echo $request->input('firstName');
      
      Auth::user()->firstname = $request->input('firstName');
      Auth::user()->lastname = $request->input('lastName');
      Auth::user()->address = $request->input('address');
      Auth::user()->contact = $request->input('contact');
      Auth::user()->password = bcrypt($request->input('password'));
      if($request->input('confirmPassword')== $request->input('password')) {
        Auth::user()->save();
      }
      
      // redirect
      //Session::flash('message', 'Successfully updated your profile!');
      return redirect('editProfile');
    }
}