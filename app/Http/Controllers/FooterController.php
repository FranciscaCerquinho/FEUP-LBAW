<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

      return view('pages.about');
    }

    /**
     * Shows the faq page
     *
     * @return Response
     */
    public function showFAQ()
    {

      return view('pages.faq');
    }

    /**
     * Shows the contact page
     *
     * @return Response
     */
    public function showContactUs()
    {

      return view('pages.contact_us');
    }

}

