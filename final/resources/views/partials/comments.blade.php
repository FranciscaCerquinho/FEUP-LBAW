<div class="col-sm-12 comment"  data-id="{{$comment->id}}">
    <div class="panel panel-white post panel-shadow">
        <div class="post-heading">
            <div class="pull-left image">
                @if($comment->photo=='perfil_blue.png')
                    <img src="/images/commentImage.jpg" class="img-circle avatar" alt="userphoto">
                @else
                    @if(preg_match('/https:\//',$comment->photo, $matches, PREG_OFFSET_CAPTURE))
                        <img src="{{$comment->photo}}" class="img-circle avatar" alt="userphoto">
                    @else
                        <img src="/images/{{$comment->photo}}" class="img-circle avatar" alt="userphoto">
                    @endif
                @endif
            </div>
            <div class="pull-left meta">
                <div class="title h5">
                    <b>{{$comment->firstname}} {{$comment->lastname}}</b>
                </div>
                <h6 class="text-muted time"><script>SplitDate("{{$comment->date}}",0);</script> ago</h6>
            </div>
            @if($type==2)
            <div class="pull-right meta">
                <div class="title h5 deleteComment">
                    <i class="fas fa-times" style="color:black"></i>
                </div>
            </div>
           @endif 
        </div> 
        <div class="post-description"> 
            <p>{{$comment->comment}}</p>
            <div class="stats">
                @if(isset($commentsLikes))
                    <a  @if($commentsLikes==1) class="btn stat-item-blue commentLike" @endif @if($commentsLikes!=1) class="btn stat-item commentLike" @endif>
                        <span class="fa fa-thumbs-up icon likeCommentHand"></span>
                        <span class="likeComment">{{$comment->like}}</span>
                    </a>    
                @endif
                @if(!isset($commentsLikes))
                    <a class="btn stat-item commentLike">
                        <span  class="fa fa-thumbs-up icon likeCommentHand"></span>
                        <span  class ="likeComment">{{$comment->like}}</span>
                    </a>
                @endif
                @if(isset($commentsLikes))
                    <a @if($commentsLikes==2) class="btn stat-item-blue commentUnlike" @endif @if($commentsLikes!=2) class="btn stat-item commentUnlike" @endif>
                        <span class="fa fa-thumbs-down icon unlikeCommentHand"></span>
                        <span class ="unlikeComment">{{$comment->dislike}}</span>
                    </a>        
                @endif
                @if(!isset($commentsLikes))
                    <a class="btn stat-item commentUnlike">
                        <span class="fa fa-thumbs-down icon unlikeCommentHand"></span>
                        <span  class ="unlikeComment">{{$comment->dislike}}</span>
                    </a>
                @endif
                <button  data-popup-reportUser-open="popup-1" type="button" class="reportA"><span class="reportUserButton fas fa-bullhorn"></span> Report</button>
                <div class="popup-reportUser" data-popup-reportUser="popup-1" data-id="{{$comment->user_id}}">
                    <div class="popup-inner-reportUser" data-id="{{$comment->id}}">
                        <div class="form-group userForm" >
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-comment-alt" aria-hidden="true"></i>
                                </span>
                                <input type="text" class="form-control reportUserText" name="reason" placeholder="Reason" />
                            </div>
                        </div>
                        <div class="row reportUserButton" >
                                <div class="col-6 col-xl-5 col-lg-6 col-sm-6 col-md-8 buttonReport" >
                                    <div class="text-center">
                                        <a role="button" target="_blank"  class="btn btn-primary btn-lg btn-block">Report</a>
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