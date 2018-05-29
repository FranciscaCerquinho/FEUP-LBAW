@extends('layouts.app')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-circle helpButton" data-toggle="modal" data-target="#exampleModalCenter">
    ?
</button>
<!-- Button trigger modal -->
<button id="messageModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
 
	<div class="row">
		<div class="col-lg-12" style="margin-top:30px;">
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
	<!-- Left Column / Headphones Image -->
	<div class="col-lg-6">
		<img  class="active product_image" src="/images/{{$auction->auctionphoto}}" alt="Play" >
		 <!-- Cable Configuration -->
		 
		 <div class="cable-config">
			<div class="cable-choose">
				<button  id="likeButton" @if($like==1) style="border: 2px solid #86939E; outline: none;" @endif>
					<span class="far fa-thumbs-up" id="like_hand"></span>
					<span id="likeAuction">{{$auction->auction_like}} </span>
				</button>
				<button  id="unlikeButton"  @if($like==2) style="border: 2px solid #86939E; outline: none;"@endif>
					<span class="far fa-thumbs-down" id="unlike_hand" ></span>
					<span id="unlikeAuction" >{{$auction->auction_dislike}}</span>
				</button>
				@if($type==1)
				<button id="addToWishList" @if($wishList==1) style="border: 2px solid #86939E; outline: none;"@endif>
					<span class="fas fa-shopping-cart"  ></span>&nbsp;  
					<strong>Wish List</strong>
				</button>
				<button  data-popup-reportAuction-open="popup-1" type="button"  class="buttonReport" @if($auctionReported==1) style="border: 2px solid #86939E; outline: none;"@endif><span class="reportAuctionButton fas fa-bullhorn"></span> &nbsp; Report</button>
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
					@endif
				</div>
			</div>
		</div>
 
 
  <!-- Right Column -->
  <div  class="col-lg-6">
 
    <!-- Product Description -->
    <div class="product-description">
      <span class="info">Available</span>
      <h1>{{$auction->name}}</h1>
	  <p>{{$auction->description}}</p>
	  <span class="time_left" ><script>SplitDate("{{$auction->dateend}}",1);</script> left</span>
    </div>
 
    <!-- Product Configuration -->
    <div class="product-configuration">
 
      <!-- Product Color -->
      <div class="product-style row col-12">
	  	<div class="col-sm-4" >
			<p class="owner description" >Owner</p>
		</div>
		<div class="col-sm-8 user_information" >
			<a class="owner_name" href="{{route('ownerProfile', ['id'=>$auction->user_id])}}">{{$auction->firstname}} {{$auction->lastname}}</a>
		</div>
	  </div>
	  
	  <div class="product-style row col-12">
	  	<div class="col-sm-4" >
			<p class="owner description" >Category</p>
		</div>
		<div class="col-sm-8 user_information" >
			<p class="category_name">{{$auction->category}}</p>
		</div>
	  </div>
	 
	   <hr>
	   @if($type==1)
	  <div class="product-style" id="bid_buttons">
		<div class="input-group mb-3">
			<input type="number" class="form-control" id="price_button"  placeholder="Make a Bid" aria-describedby="basic-addon2">
			<div class="input-group-append" id="bid">
				<button class="btn btn-outline-secondary" type="button">Submit</button>
			</div>
		</div>
	  </div>  
	  <hr>
	  @endif
    <!-- Product Pricing -->
    <div class="product-price" id="buy_now_button">
	  <span  id ="item_price">EUR {{$auction->actualprice}}</span>
	  @if($type==1)
	  <button class="cart-btn" id="buyNow" >Buy Now ({{$auction->buynow}}€)</button>
	  @endif
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
			@include('partials.comments',['comment'=>$comment, 'commentsLikes'=>$commentsLikes[$j], 'type' => $type])	<?php }
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
