@extends('layouts.app')

@section('content')
<section id="item" data-id="{{$auction->auction_id}}">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-9">
							<h2 class="item_name">{{$auction->name}}</h2>
						</div>
						<div class="col-lg-3">
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
								<a href="./index.html">
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
						<a  data-popup-reportAuction-open="popup-1" type="button" class="btn btn-default btn-sm" id="reportA"><span class="reportAuctionButton fas fa-bullhorn"></span> Report</a>
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
											<div class="col-lg-5 col-sm-6 " id="buttonReport">
												<div class="text-center">
													<a role="button" target="_blank" id="btn" class="btn btn-primary btn-lg btn-block">Report</a>
												</div>
											</div>
										</div>
      								<a class="popup-close-reportAuction" data-popup-close-reportAuction="popup-1">X</a>
    							</div>
  							</div>
						<button type="button" class="btn btn-default btn-sm">
							<span class="fas fa-shopping-cart"></span> Wish List
						</button>
					</div>
				</div>
				<div class="col-lg-6" id ="item_information">
					<div class="row" id="info">
						<h2 class="information">Information</h2>
					</div>
					<div class="row">
						<div class="row col-lg-12" id="owner">
							<div class="col-sm-4" id="title">
								<p class="owner" id="description">Owner:</p>
							</div>
							<div class="col-sm-8" id="user_information">
								<a class="owner_name" href="{{route('ownerProfile', ['id'=>$auction->auction_id])}}">{{$auction->firstname}} {{$auction->lastname}}</a>
							</div>
						</div>
						<div class="row col-lg-12" id="category">
							<div class="col-sm-4" id="title">
								<p class="category" id="description">Category:</p>
							</div>
							<div class="col-sm-8" id="user_information">
								<p class="category_name">{{$auction->category}}</p>
							</div>
						</div>
						<div class="row col-lg-12" id="time">
							<div class="col-sm-4" id="title">
								<p class="time" id="description">Time:</p>
							</div>
							<div class="col-sm-8" id="user_information">
								<p class="time_left"><script>SplitDate("{{$auction->dateend}}",1);</script> left</p>
							</div>
						</div>
						<div class="row col-lg-12" id="object_description">
							<div class="col-sm-4" id="title">
								<p class="object_description" id="description">Description:</p>
							</div>
							<div class="col-sm-8" id="user_information">
								<p class="object_description_inf">{{$auction->description}}</p>
							</div>
						</div>
						<div class="row col-lg-12" id="object_actualprice">
							<div class="col-sm-4" id="title">
								<p class="object_actualprice" id="description">Actual Price:</p>
							</div>
							<div class="col-sm-8" id="user_information">
								<p class="object_actualprice" id ="item_price">EUR {{$auction->actualprice}}</p>
							</div>
						</div>
					</div>
					<div class="row justify-content-start" id="bid_buttons">
						<div class="col-lg-3" id="price">
                            <?php $bid = $auction->actualprice + 0.01; ?>
							<input class="form-control" type="number" value="{{$bid}}" id="price_button" step="0.01">
						</div>
						<div class="col-12 col-md-auto" id="bid">
							<button class="btn" type="submit" style="background-color:#437ab2; color:white">Make Bid</button>
						</div>
					</div>
					<div class="row justify-content-start" id="buy_now_button">
						<div class="col-4">
							<button class="btn btn-success" type="submit" style="font-size:17px;background-color:#73b566;color:white ">Buy Now ({{$auction->buynow}}€)</button>
						</div>
					</div>
				</div>
			</div>
		
		<div class="row" id="first">
			<div class="row"> 
				<div id="comments">
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
							<div class="row" id="addComment">
								<div class="leave_comment">
									<div class="container">
										<div class="row">
											<div class="col-sm-8">
												<div class="panel panel-white post panel-shadow">
													<div class="status-upload">
														<textarea placeholder="Add a comment..." cols="60" rows="2" name="comment"></textarea>
														<button class="btn" type="submit">Send</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
@endsection