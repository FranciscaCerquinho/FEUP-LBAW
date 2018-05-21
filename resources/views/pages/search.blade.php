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
						<a href="/auctions">
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
				<label class="title">Category</label>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Electronics')checked @endif>
						<span>Electronics</span>
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Fashion')checked @endif>
						<span>Fashion</span>
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Home & Garden')checked @endif>
						<span>Home & Garden</span>
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Motors')checked @endif>
						<span>Motors</span>
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Music')checked @endif>
						<span>Music</span>
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Toys')checked @endif>
						<span>Toys</span>
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Daily Deals')checked @endif>
						<span>Daily Deals</span>
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Sporting')checked @endif>
						<span>Sporting</span>
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input class="form-check-input checkCategory" type="checkbox" value=""  @if($auctions[0]->category=='Others')checked @endif>
						<span>Others</span>
					</label>
				</div>
				<label class="title" >Owner</label>
				<input class="col-12" type="text" placeholder="User name">
			
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