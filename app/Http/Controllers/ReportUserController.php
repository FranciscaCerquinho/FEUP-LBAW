<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\ReportUser;

class ReportUserController extends Controller
{


    /**
     * Creates a new report User.
     *
     * @param  int  $id_userReported
     * @return comment The auction comment.
     */
    public function create(Request $request, $id_userReported)
    {
      
      $reportUser = new ReportUser();

      $reportUser->reason = $request->input('reason');
      $reportUser->id_userReported = $id_userReported;
      $reportUser->id_userReporting = Auth::user()->user_id;
      $reportUser->save();
      
      return $reportUser;
    }
}
?>