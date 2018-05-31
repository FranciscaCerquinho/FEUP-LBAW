<div class="col-sm-12 comment"  data-id="<?php echo e($comment->id); ?>">
    <div class="panel panel-white post panel-shadow">
        <div class="post-heading">
            <div class="pull-left image">
                <?php if($comment->photo=='perfil_blue.png'): ?>
                    <img src="/images/commentImage.jpg" class="img-circle avatar" alt="userphoto">
                <?php else: ?>
                    <?php if(preg_match('/https:\//',$comment->photo, $matches, PREG_OFFSET_CAPTURE)): ?>
                        <img src="<?php echo e($comment->photo); ?>" class="img-circle avatar" alt="userphoto">
                    <?php else: ?>
                        <img src="/images/<?php echo e($comment->photo); ?>" class="img-circle avatar" alt="userphoto">
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="pull-left meta">
                <div class="title h5">
                    <b><?php echo e($comment->firstname); ?> <?php echo e($comment->lastname); ?></b>
                </div>
                <h6 class="text-muted time"><script>SplitDate("<?php echo e($comment->date); ?>",0);</script> ago</h6>
            </div>
            <?php if($type==2): ?>
            <div class="pull-right meta">
                <div class="title h5 deleteComment">
                    <i class="fas fa-times" style="color:black"></i>
                </div>
            </div>
           <?php endif; ?> 
        </div> 
        <div class="post-description"> 
            <p><?php echo e($comment->comment); ?></p>
            <div class="stats">
                <?php if(isset($commentsLikes)): ?>
                    <a  <?php if($commentsLikes==1): ?> class="btn stat-item-blue commentLike" <?php endif; ?> <?php if($commentsLikes!=1): ?> class="btn stat-item commentLike" <?php endif; ?>>
                        <span class="fa fa-thumbs-up icon likeCommentHand"></span>
                        <span class="likeComment"><?php echo e($comment->like); ?></span>
                    </a>    
                <?php endif; ?>
                <?php if(!isset($commentsLikes)): ?>
                    <a class="btn stat-item commentLike">
                        <span  class="fa fa-thumbs-up icon likeCommentHand"></span>
                        <span  class ="likeComment"><?php echo e($comment->like); ?></span>
                    </a>
                <?php endif; ?>
                <?php if(isset($commentsLikes)): ?>
                    <a <?php if($commentsLikes==2): ?> class="btn stat-item-blue commentUnlike" <?php endif; ?> <?php if($commentsLikes!=2): ?> class="btn stat-item commentUnlike" <?php endif; ?>>
                        <span class="fa fa-thumbs-down icon unlikeCommentHand"></span>
                        <span class ="unlikeComment"><?php echo e($comment->dislike); ?></span>
                    </a>        
                <?php endif; ?>
                <?php if(!isset($commentsLikes)): ?>
                    <a class="btn stat-item commentUnlike">
                        <span class="fa fa-thumbs-down icon unlikeCommentHand"></span>
                        <span  class ="unlikeComment"><?php echo e($comment->dislike); ?></span>
                    </a>
                <?php endif; ?>
                <button  data-popup-reportUser-open="popup-1" type="button" class="reportA"><span class="reportUserButton fas fa-bullhorn"></span> Report</button>
                <div class="popup-reportUser" data-popup-reportUser="popup-1" data-id="<?php echo e($comment->user_id); ?>">
                    <div class="popup-inner-reportUser" data-id="<?php echo e($comment->id); ?>">
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