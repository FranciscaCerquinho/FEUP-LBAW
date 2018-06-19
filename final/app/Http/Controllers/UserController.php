<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Admin;


class UserController extends Controller
{

    /**
     * 
     * 
     * @return Response
     */
    public function show()
    {
      if(Auth::check()){
        $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        if($user_admin==null)
          $type=1;
        else
          $type=2;
        return view('pages.editProfile',['type'=>$type]);
      }
      else{
        $type=0;
        return view('errors.404',['type'=>$type]);
      }
    }

   
    /**
     * 
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
      $rules = array (
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'contact' => 'required|string|min:9|max:17',
        'address' => 'required|string|min:6',
        'country' => 'required|string|min:6',
        'photo' => 'mimes:jpg,png,jpeg,gif,svg',
      );
  
      $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
      if($user_admin==null)
        $type=1;
      else
        $type=2;
 
      $validator= Validator::make(Input::all(),$rules);
      if($validator->fails()){
        return view('pages.editProfile',['type'=>$type])->withErrors($validator);
      }
      
      Auth::user()->firstname = $request->input('firstName');
      Auth::user()->lastname = $request->input('lastName');
      Auth::user()->address = $request->input('address');
      Auth::user()->contact = $request->input('contact');
      Auth::user()->password = bcrypt($request->input('password'));

      if($request->hasFile('photo')){
        $imageName= $request->photo->getClientOriginalName();
        $request->photo->move(public_path('images/'),$imageName);
        Auth::user()->photo = $imageName;
      }
      if($request->input('confirmPassword')== $request->input('password')) {
       
        Auth::user()->save();
        return view('pages.editProfile',['success' => 'Modifications made <strong>successfully</strong>.','type'=>$type])->withErrors($validator);
      }
      else{
       
        return view('pages.editProfile',['alert' => 'The <strong>password</strong> does not match. Try again.','type'=>$type])->withErrors($validator);
      }

    }

}