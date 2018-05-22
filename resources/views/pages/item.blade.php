@extends('layouts.app')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-circle helpButton" data-toggle="modal" data-target="#exampleModalCenter">
    ?
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Online Help </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="title">Bid the auction?</p>
		<p>You can bid the auction by writting the price and cliking on <b>"Make Bid"</b>.</p>
		<p>If you want to see the bids that you made, you have to use the navbar button with your username, and then click on <b>"My Bids"</b>.</p>
		<hr>
		<p class="title">Want to buy the item?</p>
        <p>If you want to buy an auction, you have to click on <b> "Buy Now"</b> and then the auction is yours and the user will contact you.</p>
		<hr>
		<p class="title">Want to see the owner information?</p>
        <p>You have to click on owner name. </p>
		<p class="title">Report an auction?</p>
        <p>If you want to report an auction you have to click on <b>"Report"</b> button (that is under the auction image), then write the reason and finally submit by clicking on <b>"Report"</b>. </p>
		<hr>
		<p class="title">Report an user?</p>
        <p>If you want to report an user you have to click on <b>"Report"</b> button on user comments, then write the reason and finally submit by clicking on <b>"Report"</b>. </p>
		<hr>
		<p class="title">Add auction to your wish list?</p>
        <p>You can add the auction to you wish list by clicking on <b>"Wish List"</b>. </p>
		<hr>
		<p class="title">Add a Comment to the auction?</p>
        <p>If you want to add a comment to the auction, you have to write on <b> "Add a comment..."</b>, that is in the end of comments, and then click on <b>"Send"</b> to submit. </p>
      </div>
    </div>
  </div>
</div>
<section class="container" id="item" data-id="{{$auction->auction_id}}">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-6">
							<h2 class="item_name">{{$auction->name}}</h2>
						</div>
						<div class="col-6">
							<h3 class="auction_status">
                            @if($auction->active==1)
                            Winning
                            @endif
                            @if($auction->active==0)
                            Losing
                            @endif
                            </h3>
						</div>
					</div>
					<hr class="style17" style="color:grey;">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="/auctions">
									<i class="fas fa-home"></i>
									Home
								</a>
							</li>
							<li class="breadcrumb-item" aria-current="page">Item</li>
							<li class="breadcrumb-item active" aria-current="page">{{$auction->name}}</li>
						</ol>
					</nav>
				</div>
				<div class="col-lg-6">
					<img class="product_image" src="/images/{{$auction->auctionphoto}}" alt="Play">
					<div id="buttons">
						<button type="button" id="likeButton" class="btn btn-default btn-sm">
							<span class="far fa-thumbs-up" id="like_hand" @if($like==1) style="color:#437ab2"@endif></span>
							<span id="likeAuction" @if($like==1) style="color:#437ab2"@endif>{{$auction->auction_like}}</span>
						</button>
						<button type="button" id="unlikeButton" class="btn btn-default btn-sm">
							<span class="far fa-thumbs-down" id="unlike_hand" @if($like==2) style="color:#437ab2"@endif></span>
							<span id="unlikeAuction"  @if($like==2) style="color:#437ab2"@endif>{{$auction->auction_dislike}}</span>
						</button>
						<button>
						<button  data-popup-reportAuction-open="popup-1" type="button"  class="buttonReport" @if($auctionReported==1) style="color:rgb(204,68,74)"@endif><span class="reportAuctionButton fas fa-bullhorn" @if($auctionReported==1) style="color:rgb(204,68,74)"@endif></span> &nbsp; Report</button>
						</button>
							<div class="popup-reportAuction" data-popup-reportAuction="popup-1">
    							<div class="popup-inner-reportAuction">
									<div class="form-group" id="auctionForm">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fas fa-comment-alt" aria-hidden="true"></i>
											</span>
												<input type="text" class="form-control" id="reportAuctionText" name="reason" placeholder="Reason" />
										</div>
									</div>
									<div class="row" id="reportButton">
											<div class="col-6 col-xl-5 col-lg-6 col-sm-6 col-md-8 buttonReport" >
												<div class="text-center">
													<a role="button" target="_blank"  class="btn btn-primary btn-lg btn-block"><strong>Report</strong></a>
												</div>
											</div>
										</div>
      								<a class="popup-close-reportAuction" data-popup-close-reportAuction="popup-1">X</a>
    							</div>
							  </div>
						<button type="button" class="btn btn-default btn-sm" id="addToWishList" @if($wishList==1) style="color:#437ab2"@endif>
							<span class="fas fa-shopping-cart" @if($wishList==1) style="color:#437ab2"@endif ></span>&nbsp;  <strong>Wish List</strong>
						</button>
					</div>
				</div>
				<div class="col-lg-6" id ="item_information">
					<div class="row" id="info">
						<h2 class="information">Information</h2>
					</div>
					<div class="row">
						<div class="row col-12" id="owner">
							<div class="col-sm-4" >
								<p class="owner description" >Owner:</p>
							</div>
							<div class="col-sm-8 user_information" >
								<a class="owner_name" href="{{route('ownerProfile', ['id'=>$auction->user_id])}}">{{$auction->firstname}} {{$auction->lastname}}</a>
							</div>
						</div>
						<div class="row col-12" id="category">
							<div class="col-sm-4" >
								<p class="category description" >Category:</p>
							</div>
							<div class="col-sm-8 user_information">
								<p class="category_name">{{$auction->category}}</p>
							</div>
						</div>
						<div class="row col-12" id="time">
							<div class="col-sm-4" >
								<p class="time description">Time:</p>
							</div>
							<div class="col-sm-8 user_information">
								<p class="time_left" ><script>SplitDate("{{$auction->dateend}}",1);</script> left</p>
							</div>
						</div>
						<div class="row col-12" id="object_description">
							<div class="col-sm-4" >
								<p class="object_description description" >Description:</p>
							</div>
							<div class="col-sm-8 user_information" >
								<p class="object_description_inf">{{$auction->description}}</p>
							</div>
						</div>
						<div class="row col-12" id="object_actualprice">
							<div class="col-sm-4" >
								<p class="object_actualprice description">Actual Price:</p>
							</div>
							<div class="col-sm-8 user_information">
								<p class="object_actualprice" id ="item_price">EUR {{$auction->actualprice}}</p>
							</div>
						</div>
					</div>
					<div class="row justify-content-start" id="bid_buttons">
						<div class="col-sm-3" id="price">
                            <?php $bid = $auction->actualprice + 1; ?>
							<input class="form-control" type="number" value="{{$bid}}" id="price_button" step="0.01">
						</div>
						<div class="col-sm-3" id="bid">
							<button class="btn" type="submit" style="background-color:#437ab2; color:white">Make Bid</button>
						</div>
						<div id="buy_now_button" class="col-sm-3">
						<div class="col-12">
							<button class="btn btn-success" type="submit" style="font-size:17px;background-color:#73b566;color:white ">Buy Now ({{$auction->buynow}}€)</button>
						</div>
					</div>
					</div>

				</div>
			</div>

			<div class="container comments">
				<div class="row">
					<?php foreach($comments as $comment) {
						$j = -1;
						for($i = 0; $i < count($commentsLikes); $i++){

							if($id_comment_likes[$i]->id_comment == $comment->id)
								$j = $i;
							}
						if($j != -1)  { ?>
						@include('partials.comments',['comment'=>$comment, 'commentsLikes'=>$commentsLikes[$j]])	<?php }
						else { ?>
						@include('partials.comments',['comment'=>$comment])
					<?php }} ?>
					@if (Auth::check())
						@if($type==1)
							<div class="leave_comment col-sm-12" id="addComment">
								<div class="panel panel-white post panel-shadow">
									<div class="status-upload">
										<textarea placeholder="Add a comment..." cols="60" rows="2" name="comment"></textarea>
										<div class="row">
											<span class="col-sm-10"></span>
											<button class="btn col-sm-1" style="background-color:#437ab2; color:white" type="submit">Send</button>
										</div>
									</div>
								</div>
							</div>
						@endif
					@endif
				</div>
			</div>
</section>
@endsection
