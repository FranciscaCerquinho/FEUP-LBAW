<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

use App\User;

class ResetPasswordController extends Controller
{


     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }
  
    public function showResetForm(){
        return view('auth.resetForm');
    }

    public function  reset(Request $request){
        $this->validate($request, ['password' => 'required|confirmed|min:6']);

        $credentials = $request->only('password', 'password_confirmation');


        $user = User::where('email', $request->input('email'))->first();

        if($user) {
          if($user->remember_token == $request->input('token')) {
            $user->update(['password' => bcrypt($credentials['password'])]);
            return view('auth.login');
          }
          else {
            return view('auth.resetForm')->withErrors(['email' => 'INVALID TOKEN']);
          }
        }
        else {
          return view('auth.resetForm')->withErrors(['email' => 'We dont have this email in your DB!']);
        }
    }
}
