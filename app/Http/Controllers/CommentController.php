<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Auction;
use App\Comment;

class CommentController extends Controller
{

    /**
     * Creates a new comment.
     *
     * @param  int  $auction_id
     * @return comment The auction comment.
     */
    public function create(Request $request, $auction_id)
    {
      
      $comment = new Comment();
      $comment->id_auction = $auction_id;

      //$this->authorize('create', $comment);
     
      $comment->comment = $request->input('comment');
      $comment->like = 0;
      $comment->dislike = 0;
      $comment->id_user = Auth::user()->user_id;
      $comment->date= date('Y-m-d H:i:s');
      $comment->save();
      $comment->load('user');
      $comment->url= '/images/'.($comment->user->photo=='perfil_blue.png'?'perfil-icon_grey.png' : $comment->user->photo);
      return $comment;
    }

    /**
     * Updates the state of an individual item.
     *
     * @param  int  $comment_id
     * @param  Request request containing the new state
     * @return Response
     */
    public function updateLike(Request $request, $comment_id)
    {
      $comment = Auction::find($comment_id);

      $this->authorize('update', $comment);

      $comment->like = $request->input('done');
      $comment->save();

      return $comment;
    }

      /**
     * Updates the state of an individual item.
     *
     * @param  int  $comment_id
     * @param  Request request containing the new state
     * @return Response
     */
    public function updateDislike(Request $request, $comment_id)
    {
      $comment = Auction::find($comment_id);

      $this->authorize('update', $comment);

      $comment->dislike = $request->input('done');
      $comment->save();

      return $comment;
    }

}
?>
