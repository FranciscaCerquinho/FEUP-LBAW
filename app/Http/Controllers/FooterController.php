<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//use App\Card;

class FooterController extends Controller
{
    /**
     * Shows the card for a given id.
     *
     * @return Response
     */
    public function showAbout()
    {

      return view('pages.about');
    }

    public function showFAQ()
    {

      return view('pages.faq');
    }

    public function showContactUs()
    {

      return view('pages.contact_us');
    }

}

