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
                                <h6 class="text-muted time"> <script>SplitDate("{{$comment->date}}",0);</script> ago</h6>
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
                                <a  data-popup-reportUser-open="popup-1" type="button" class="btn btn-default btn-sm" id="reportA"><span class="reportAuctionButton fas fa-bullhorn"></span> Report</a>
							<div class="popup-reportUser" data-popup-reportUser="popup-1">
    							<div class="popup-inner-reportUser">
									 <div class="form-group" id="auctionForm">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fas fa-comment-alt" aria-hidden="true"></i>
											</span>
												<input type="text" class="form-control" id="reportUserText" name="reason" placeholder="Reason" />
											</div>
									</div>
									<div class="row" id="reportButton">
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
            </div>
        </div>
    </div>
</div>
