<div class="row">
    <div id="comments">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="panel panel-white post panel-shadow">
                        <div class="post-heading">
                            <div class="pull-left image">
                            @if($comment->photo=='perfil_blue.png')
                                <img src="/images/perfil-icon_grey.png" class="img-circle avatar" alt="user profile image">
                            @endif
                            @if($comment->photo!='perfil_blue.png')
                                <img src="/images/{{$comment->photo}}" class="img-circle avatar" alt="user profile image">
                            @endif
                            </div>
                            <div class="pull-left meta">
                                <div class="comment_owner">
                                    <a href="#">
                                        <b>{{$comment->firstname}} {{$comment->lastname}}</b>
                                    </a>
                                </div>
                                <h6 class="text-muted time"> <script>SplitDate("{{$comment->date}}");</script> ago</h6>
                            </div>
                        </div>
                        <div class="post-description">
                            <p>{{$comment->comment}}</p>
                            <div class="buttonsComments" data-id="{{$comment->id}}">
                                <a  id="commentLike" class="btn">
                                @if(isset($commentsLikes))
                                    <span @if($commentsLikes==1) style="color:#437ab2"@endif id ="likeCommentHand" class="far fa-thumbs-up"></span>
                                    <span @if($commentsLikes==1) style="color:#437ab2"@endif id ="likeComment">{{$comment->like}}</span>
                                @endif
                                @if(!isset($commentsLikes))
                                    <span  id ="likeCommentHand" class="far fa-thumbs-up"></span>
                                    <span  id ="likeComment">{{$comment->like}}</span>
                                @endif
                                </a>
                                <a id="commentUnlike" href="#" class="btn">
                                @if(isset($commentsLikes))
                                    <span @if($commentsLikes==2) style="color:#437ab2"@endif id ="unlikeCommentHand" class="far fa-thumbs-down"></span>
                                    <span @if($commentsLikes==2) style="color:#437ab2"@endif id ="unlikeComment">{{$comment->dislike}}</span>
                                @endif
                                @if(!isset($commentsLikes))
                                    <span  id ="unlikeCommentHand" class="far fa-thumbs-down"></span>
                                    <span  id ="unlikeComment">{{$comment->dislike}}</span>
                                @endif
                                </a>
                                <a id="commentReport" class="btn btn-sm stat-item" style="padding:6px;">
                                    <span id ="reportComment" class="fas fa-bullhorn"></span>
                                    <span>&nbsp; Report</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
