<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use App\User;
use App\ResetPassword;

class ForgotPasswordController extends Controller
{
  
    public function showLinkRequestForm(){
        return view('auth.resetPassword');
    }

    public function sendResetLinkEmail(Request $request){
        $user = User::where('email', $request->input('email'))->first();

        if($user){
            Mail::to($user->email)->send(new ResetPassword($user->remember_token,$user));

            return redirect('/auctions');
        }
        else{
            return view('auth.email')->withErrors(['email'=> 'We dont have this email in our DB!']);
        }
    }
}
