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
				<div class="col-md-3 col-sm-3">
					<p>Reason</p>
				</div>
				<div class="col-md-3 col-sm-3">
					<p>Action</p>
				</div>
			</div>
			<hr class="style17" style="color:grey;">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<a href="#pedromirada">Pedro Miranda</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<a href="#anavieira">Ana Vieira</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<a href="#comment">Offensive comment</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<input class="check" type="checkbox"> Ban </input>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<a href="Roberto Dias">Roberto Dias</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<a href="#martamaciel">Marta Maciel</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<a href="#message">Offensive message</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<input class="check" type="checkbox" checked> Ban </input>
				</div>
			</div>


		</div>
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
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<a href="#auction">Revolver</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<a href="#josecastro">José Castro</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<input class="check" type="checkbox" checked> Ban </input>
				</div>
			</div>
		</div>

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
</section>
@endsection