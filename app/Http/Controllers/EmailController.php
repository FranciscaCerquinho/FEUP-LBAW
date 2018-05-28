<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use App\User;

class EmailController extends Controller
{

  public function emailUser(Request $request,String $emailUser){
    $user = User::where('email', $request->input('email'))->first();

    if($user){
        Mail::to($emailUser)->send($request->input('email'),$request->input('name'),$request->input('subject'),$request->input('message'));

        return redirect('/auctions');
    }
    else{
        return view('auth.email')->withErrors(['email'=> 'We dont have this email in our DB!']);
    }

  }

  public function emailUs(Request $request){
    $user = User::where('email', $request->input('email'))->first();

    if($user){
        Mail::to("pedro21fcp@gmail.com")->send($request->input('email'),$request->input('name'),$request->input('subject'),$request->input('message'));

        return redirect('/auctions');
    }
    else{
        return view('auth.email')->withErrors(['email'=> 'We dont have this email in our DB!']);
    }

  }



}
