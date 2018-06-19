@extends('layouts.app')

@section('title', 'My Auctions')
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
        <p class="title">What means <b>"My Auctions"</b> ?</p>
        <p>This page was created for the user, allowing him to know which auctions he has created and better follow the auction.</p>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" id="newAuctions">
    <div class="row" style="margin-left:50px; margin-right:50px;">
		<div class="col-sm-12 sb-4">
		<h2 class="users">My Auctions</h2>
		<hr class="style17" style="color:grey;">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="/auctions">
				<i class="fas fa-home"></i>
				Home
				</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">My Auctions</li>
			</ol>
		</nav>
	</div>
<?php
$elems_per_row = 4;
$num_elems = count($auctions);
$num_rows = ceil($num_elems / $elems_per_row);

?>
<div class="new_auctions" @if(count($auctions)==0)) style="padding-top:500px" @endif>
<?php if($num_elems ==1) {?>
  @include('partials.auctionsFullSearch',['auction'=>$auctions[0]])
<?php } else{ ?>
<?php for($i = 0; $i < $num_rows; $i++) {?>
        <div class="row">
        <?php for($j = 0; $j < $elems_per_row && $num_elems > 0; $j++, $num_elems--) {
              $actual_elem = $i*$elems_per_row + $j; 
              ?>
       @include('partials.auction',['auction'=>$auctions[$actual_elem]])
        <?php } }?>
          <!-- auction -->
        </div>
    <?php } ?>
</div>
</div>

@endsection