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
      if(preg_match('/https:\//',Auth::user()->photo, $matches, PREG_OFFSET_CAPTURE))
        $comment->url= $comment->user->photo;
      else
        $comment->url= '/images/'.($comment->user->photo=='perfil_blue.png'?'commentImage.jpg' : $comment->user->photo);
      return $comment;
    }

         /**
     * Updates the state of an individual item.
     *
     * @param  int  $auction id
     * @param  Request request containing the new state
     * @return Response
     */
    public function updateLike(Request $request, $comment_id)
    {
      $comment = Comment::find($comment_id);
      if(Auth::check()){
      $user_like= DB::table('usercommentlike')->where([['id_comment','=', $comment_id],['id_user','=',Auth::user()->user_id]])->first();

      if($user_like==null){
        DB::table('usercommentlike')->insert(['id_user'=> Auth::user()->user_id, 'id_comment'=> $comment_id, 'islike'=>true]);
        $comment->like = $request->input('like');
        $comment->save();
      }
      else {
        if($user_like->islike == false){
          $comment->dislike=$comment->dislike-1;
          $comment->like=$comment->like+1;
          $comment->save();
          DB::table('usercommentlike')->where([['id_comment','=', $comment_id],['id_user','=',Auth::user()->user_id]])->update(['islike'=> true]);
        }

      }
    } 
      return $comment;
    
    }

            /**
     * Updates the state of an individual item.
     *
     * @param  int  $auction id
     * @param  Request request containing the new state
     * @return Response
     */
    public function updateUnlike(Request $request, $comment_id)
    {
      $comment = Comment::find($comment_id);
      if(Auth::check()){
      $user_like= DB::table('usercommentlike')->where([['id_comment','=', $comment_id],['id_user','=',Auth::user()->user_id]])->first();

      if($user_like==null){
        DB::table('usercommentlike')->insert(['id_user'=> Auth::user()->user_id, 'id_comment'=> $comment_id, 'islike'=>true]);
        $comment->dislike = $request->input('unlike');
        $comment->save();

      }
      else {
        if($user_like->islike == true){
          $comment->like=$comment->like-1;
          $comment->dislike=$comment->dislike+1;
          $comment->save();
          DB::table('usercommentlike')->where([['id_comment','=', $comment_id],['id_user','=',Auth::user()->user_id]])->update(['islike'=> false]);
        }

      }
    }
      return $comment;
    }
    
}
?>
