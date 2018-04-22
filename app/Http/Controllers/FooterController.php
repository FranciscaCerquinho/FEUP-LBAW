<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Admin;

//use App\Card;

class FooterController extends Controller
{
    /**
     * Shows the about page
     *
     * @return Response
     */
    public function showAbout()
    {
      if(Auth::check()){
        $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        if($user_admin==null)
          $type=1;
        else
          $type=2;
      }
      else
        $type=0;
      return view('pages.about',['type' => $type]);
    }

    /**
     * Shows the faq page
     *
     * @return Response
     */
    public function showFAQ()
    {
      if(Auth::check()){
        $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        if($user_admin==null)
          $type=1;
        else
          $type=2;
      }
      else
        $type=0;
      return view('pages.faq',['type' => $type]);
    }

    /**
     * Shows the contact page
     *
     * @return Response
     */
    public function showContactUs()
    {
      if(Auth::check()){
        $user_admin=Admin::where('id_user',(Auth::user()->user_id))->first();
        if($user_admin==null)
          $type=1;
        else
          $type=2;
      }
      else
        $type=0;
      return view('pages.contact_us',['type' => $type]);
    }

}

