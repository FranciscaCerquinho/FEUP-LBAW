@extends('layouts.app',['type'=>$type])

@section('content')
<section id="middle">
		<div class="user_report">
			<h2 class="users">Users Reported </h2>
			<hr class="style17" style="color:grey;">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<p>User</p>
				</div>
				<div class="col-md-3 col-sm-3">
					<p>Reported by</p>
				</div>
				<div class="col-md-4 col-sm-3">
					<p>Reason</p>
				</div>
				<div class="col-md-2 col-sm-3">
					<p>Action</p>
				</div>
			</div>
			<hr class="style17" style="color:grey;">
		<?php for($j = 0; $j < count($reported_users); $j++) { ?>
			@include('partials.usersReport',['reported_users'=>$reported_users[$j],'reporting_users'=>$reporting_users[$j]])
        <?php } ?>
		</div>

		<ul id="usersPag" style="margin-top:50px" class="pagination col-lg-12"></ul>

		<div class="auctions_report" style="margin-top:50px;">
			<h2 class="users">Auctions Reported </h2>
			<hr class="style17" style="color:grey;">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<p>Auction</p>
				</div>
				<div class="col-md-3 col-sm-3">
					<p>Reported by</p>
				</div>
				<div class="col-md-3 col-sm-3">
					<p>Action</p>
				</div>
			</div>
			<hr class="style17" style="color:grey;">
			<?php for($j = 0; $j < count($reported_auctions); $j++) { ?>
			@include('partials.auctionsReport',['reported_auctions'=>$reported_auctions[$j]])
        <?php } ?>
		</div>

		<!--<ul id="auctionsPag" style="margin-top:50px" class="pagination col-lg-12"></ul>-->

</section>
@endsection