<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    /**
     * Shows the administration page
     *
     * @return Response
     */
    public function show()
    {
      $type=2;
      return view('pages.administration',['type' => $type]);
    }


}
?>
