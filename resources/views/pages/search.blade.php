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
        <p>Search Page</p>
        <p class="title">Search for auctions?</p>
        <p>You can search for auctions using the navbar.</p>
        <hr>
        <p class="title">Want to search by category?</p>
        <p>If you want to search for another auction category you can select them using the checklist on the left.</p>
        <p class="title">Want to search for an auction by the owner ?</p>
		<p>On the left, you can write the owner name under the title <b>"Owner"</b>. </p>
		<p class="title">Want to go to the home page?</p>
		<p>You have to click on <b>Home</b>.</p>  
      </div>
    </div>
  </div>
</div>
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
				<input class="col-12" id="owner-input" type="text" placeholder="User name">
			</div>
		</div>
		<?php
			$elems_per_row = 3;
			$num_elems = count($auctions);
			$num_rows = ceil($num_elems / $elems_per_row);
		?>
		<div class="col-lg-9 col-md-8 searchResults">
			<div class="row">
			<?php for($i = 0; $i < $num_rows; $i++) {?>
        	<?php for($j = 0; $j < $elems_per_row && $num_elems > 0; $j++, $num_elems--) {
              $actual_elem = $i*$elems_per_row + $j; 
              ?>
        	@include('partials.auctionSearch',['auction'=>$auctions[$actual_elem]])
        	<?php } ?>
          <!-- auction -->
    	<?php } ?>
			</div>
		</div>
</div>
@endsection