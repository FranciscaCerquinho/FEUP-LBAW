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
                            <div class="stats">
                                <a href="#" class="btn stat-item">
                                    <i class="far fa-thumbs-up"></i>{{$comment->like}}
                                </a>
                                <a href="#" class="btn stat-item">
                                    <i class="far fa-thumbs-down"></i>{{$comment->dislike}}
                                </a>
                                <a href="#" class="btn btn-sm stat-item" style="padding:6px;">
                                    <i class="fas fa-bullhorn"></i>Report
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
