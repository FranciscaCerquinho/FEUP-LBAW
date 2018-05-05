@extends('layouts.app')

@section('content')
<div  id="searchPage">
	<div class="row">
		<div class="col-12">
			<div id="searchTitle">
				<h1>Search</h1>
				<hr class="style17" style="color:grey;">
			</div>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="./index.html">
							<i class="fas fa-home"></i>
							Home
						</a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Search</li>
				</ol>
			</nav>
		</div>
		<div class="col-lg-3 col-md-4">
			<div  id="category_filter">
				<label for="select_category">Category</label>
				<form action="" mathod="GET">
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off"  @if($auctions[0]->category=='Electronics')checked @endif>
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Electronics</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" @if($auctions[0]->category=='Fashion')checked @endif />
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Fashion</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" @if($auctions[0]->category=='Home & Garden')checked @endif/>
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Home & Garden</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" @if($auctions[0]->category=='Motors')checked @endif/>
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Motors</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" @if($auctions[0]->category=='Music')checked @endif/>
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Music</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" @if($auctions[0]->category=='Toys')checked @endif/>
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Toys</span>
						</div>
					<div class="padding-v-xs" data-toggle="buttons">
						<label class="btn btn-default btn-xs ico">
							<input type="checkbox" name="" value="" autocomplete="off" @if($auctions[0]->category=='Daily Deals')checked @endif/>
							<span class="icon glyphicon glyphicon-ok"></span>
						</label>
						<span>Daily Deals</span>
					</div>
					<div class="padding-v-xs" data-toggle="buttons">
						<label class="btn btn-default btn-xs ico">
							<input type="checkbox" name="" value="" autocomplete="off" @if($auctions[0]->category=='Sporting')checked @endif />
							<span class="icon glyphicon glyphicon-ok"></span>
						</label>
						<span>Sporting</span>
					</div>
					<div class="padding-v-xs" data-toggle="buttons">
						<label class="btn btn-default btn-xs ico">
							<input type="checkbox" name="" value="" autocomplete="off" @if($auctions[0]->category=='Others')checked @endif/>
							<span class="icon glyphicon glyphicon-ok"></span>
						</label>
						<span>Others</span>
					</div>
					<label for="owner_filter">Owner</label>
					<input class="col-12" type="text" placeholder="User name">
				</form>
			</div>
		</div>
		<?php
			$elems_per_row = 3;
			$num_elems = count($auctions);
			$num_rows = ceil($num_elems / $elems_per_row);
		?>
		<div class="col-lg-9 col-md-8 searchResults">
			<?php for($i = 0; $i < $num_rows; $i++) {?>
        	<div class="row">
        	<?php for($j = 0; $j < $elems_per_row && $num_elems > 0; $j++, $num_elems--) {
              $actual_elem = $i*$elems_per_row + $j; 
              ?>
        	@include('partials.auctionSearch',['auction'=>$auctions[$actual_elem]])
        	<?php } ?>
          <!-- auction -->
        	</div>
    	<?php } ?>
		</div>
</div>
@endsection