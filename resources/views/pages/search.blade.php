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
								<input type="checkbox" name="" value="" autocomplete="off" />
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Electronics</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" />
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Fashion</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" />
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Home & Garden</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" />
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Motors</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" />
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Music</span>
						</div>
						<div class="padding-v-xs" data-toggle="buttons">
							<label class="btn btn-default btn-xs ico">
								<input type="checkbox" name="" value="" autocomplete="off" />
								<span class="icon glyphicon glyphicon-ok"></span>
							</label>
							<span>Toys</span>
						</div>
					<div class="padding-v-xs" data-toggle="buttons">
						<label class="btn btn-default btn-xs ico">
							<input type="checkbox" name="" value="" autocomplete="off" />
							<span class="icon glyphicon glyphicon-ok"></span>
						</label>
						<span>Daily Deals</span>
					</div>
					<div class="padding-v-xs" data-toggle="buttons">
						<label class="btn btn-default btn-xs ico">
							<input type="checkbox" name="" value="" autocomplete="off" />
							<span class="icon glyphicon glyphicon-ok"></span>
						</label>
						<span>Sporting</span>
					</div>
					<div class="padding-v-xs" data-toggle="buttons">
						<label class="btn btn-default btn-xs ico">
							<input type="checkbox" name="" value="" autocomplete="off" />
							<span class="icon glyphicon glyphicon-ok"></span>
						</label>
						<span>Others</span>
					</div>
					<label for="owner_filter">Owner</label>
					<input class="col-12" type="text" placeholder="User name">
				</form>
			</div>
		</div>
		<div class="col-lg-9 col-md-8 searchResults">
			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="card h-100 auctionCard searchCard">
						<a href="#">
							<img class="card-img-top searchResultImage" src="images/music.jpg" alt="">
						</a>
						<div class="card-body searchResultBody">
							<h5 class="card-title searchResultTitle">
								<a href="#">New Album David Bowie</a>
							</h5>
							<h4 class="auctionPrice">EUR 20.90</h5>
								<h6 class="auctionTimeLeft">1 day left</h1>
									<p class="card-text searchResultText">
										Dinis Lopes
									</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="card h-100 auctionCard searchCard">
						<a href="#">
							<img class="card-img-top searchResultImage" src="images/music2.jpg" alt="">
						</a>
						<div class="card-body">
							<h5 class="card-title">
								<a href="#">Vinyl Mike Evans</a>
							</h5>
							<h4 class="auctionPrice">EUR 25.90</h5>
								<h6 class="auctionTimeLeft">5 min left</h1>
									<p class="card-text searchResultText">Teresa Ramos</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="card h-100 auctionCard ">
						<a href="#">
							<img class="card-img-top searchResultImage" src="images/music3.jpg" alt="">
						</a>
						<div class="card-body">
							<h5 class="card-title">
								<a href="#">Vinyl</a>
							</h5>
							<h4 class="auctionPrice">EUR 30.90</h5>
								<h6 class="auctionTimeLeft">1 hour left</h1>
									<p class="card-text searchResultText">Eduardo Azevedo</p>
						</div>
					</div>
				</div>
			</div>
			<div id="searchNav" class="text-center">
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item">
							<a class="page-link" href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
								<span class="sr-only">Previous</span>
							</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#">1</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#">2</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#">3</a>
						</li>
						<li class="page-item">
							<a class="page-link" href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
								<span class="sr-only">Next</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection