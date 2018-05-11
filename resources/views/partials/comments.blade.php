<div class="col-sm-12 comment"  data-id="{{$comment->id}}">
    <div class="panel panel-white post panel-shadow">
        <div class="post-heading">
            <div class="pull-left image">
                @if($comment->photo=='perfil_blue.png')
                    <img src="/images/commentImage.jpg" class="img-circle avatar" alt="user profile image">
                @endif
                @if($comment->photo!='perfil_blue.png')
                    <img src="/images/{{$comment->photo}}" class="img-circle avatar" alt="user profile image">
                @endif
            </div>
            <div class="pull-left meta">
                <div class="title h5">
                    <a href="#"><b>{{$comment->firstname}} {{$comment->lastname}}</b></a>
                </div>
                <h6 class="text-muted time"><script>SplitDate("{{$comment->date}}",0);</script> ago</h6>
            </div>
        </div> 
        <div class="post-description"> 
            <p>{{$comment->comment}}</p>
            <div class="stats">
                @if(isset($commentsLikes))
                    <a  id="commentLike" @if($commentsLikes==1) class="btn stat-item-blue" @endif @if($commentsLikes!=1) class="btn stat-item" @endif>
                        <span id ="likeCommentHand" class="fa fa-thumbs-up icon"></span>
                        <span id ="likeComment">{{$comment->like}}</span>
                    </a>    
                @endif
                @if(!isset($commentsLikes))
                    <a id="commentLike" class="btn stat-item">
                        <span  id ="likeCommentHand" class="fa fa-thumbs-up icon"></span>
                        <span  id ="likeComment">{{$comment->like}}</span>
                    </a>
                @endif
                @if(isset($commentsLikes))
                    <a id="commentUnlike" href="#" @if($commentsLikes==2) class="btn stat-item-blue" @endif @if($commentsLikes!=2) class="btn stat-item" @endif>
                        <span id ="unlikeCommentHand" class="fa fa-thumbs-down icon"></span>
                        <span id ="unlikeComment">{{$comment->dislike}}</span>
                    </a>        
                @endif
                @if(!isset($commentsLikes))
                    <a id="commentUnlike" href="#" class="btn stat-item">
                        <span  id ="unlikeCommentHand" class="fa fa-thumbs-down icon"></span>
                        <span  id ="unlikeComment">{{$comment->dislike}}</span>
                    </a>
                @endif
                <button  data-popup-reportUser-open="popup-1" type="button" id="reportA"><span class="reportUserButton fas fa-bullhorn"></span> Report</button>
                <div class="popup-reportUser" data-popup-reportUser="popup-1" data-id="{{$comment->user_id}}">
                    <div class="popup-inner-reportUser" data-id="{{$comment->id}}">
                        <div class="form-group" id="userForm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-comment-alt" aria-hidden="true"></i>
                                </span>
                                <input type="text" class="form-control reportUserText" name="reason" placeholder="Reason" />
                            </div>
                        </div>
                        <div class="row" id="reportUserButton">
                                <div class="col-6 col-xl-5 col-lg-6 col-sm-6 col-md-8" id="buttonReport">
                                    <div class="text-center">
                                        <a role="button" target="_blank" id="btn" class="btn btn-primary btn-lg btn-block">Report</a>
                                    </div>
                                </div>
                            </div>
                        <a class="popup-close-reportUser" data-popup-close-reportUser="popup-1">X</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>