@extends('layouts.app',['type'=>$type])

@section('content')
<?php
$elems_per_row = 4;
$num_elems = count($auctions);
$num_rows = ceil($num_elems / $elems_per_row);
$num_endAuctions = count($endAuctions);
?>
@if($num_endAuctions>0)
<div class="row endAuctions container-fluid align-items-center" id="newAuctions">
<?php for($i = 0; $i < $num_endAuctions; $i++) {?>
  <div class="endAuctionAlert" data-id='{{$endAuctions[$i]->endauction_id}}'>
    <div class="alert alert-info alert-dismissable" role="alert">
      <a class="panel-close close" data-dismiss="alert">x</a>
      The Auction {{$endAuctions[$i]->name}} has been sell! Contact the user    &nbsp   &nbsp
      <input class="btn btn-primary endAuction" type="submit"value="Done">
      &nbsp   &nbsp
    </div>
  </div>
<?php } ?>
</div>
@endif
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
        <p>Welcome to TopBid!</p>
        <p>If you are a visitor, you can´t bid or buy an auction, you can just see the auction products. </p>
        <p class="title">Search for auctions?</p>
        <p>You can search for auctions using the navbar. If you want to search for auctions by category, you can use the dropdown button <b>"Category"</b>.</p>
        <hr >
        <p>If you want to have premissions to do the follow things you have to <b>Sign In </b>or <b>Register</b>.</p>
        <p>You can do that by clicking on <b>"Sign In"</b>.</p>
        <p class="title">Want to add an auction?</p>
        <p>If you want to add an auction, you have to click on <b> "Add Auction"</b> that is on navbar. </p>
        <p class="title">Edit your profile?</p>
        <p>You can edit your profile by using the navbar button with your username, and then click on <b>"Edit your Profile"</b>. </p>
        <p class="title">Your Auctions?</p>
        <p>You can see the auctions that you want to sell by using the navbar button with your username, and then click on <b>"My Auctions"</b>. </p>
        <p class="title">Your Bids?</p>
        <p>If you want to see the bids that you made, you have to use the navbar button with your username, and then click on <b>"My Bids"</b>. </p>
        <p class="title">Want to Logout?</p>
        <p>If you want to logout, you have to use the navbar button with your username and then ckick on <b> "Logout"</b>. </p>
        <p class="title">Want to see your shopping cart?</p>
        <p>If you want to see your shooping cart you have to click on <b> <i class="fa fa-shopping-cart" aria-hidden="true"></i></b>. </p>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" id="newAuctions">
<div class="new_auctions">
<?php for($i = 0; $i < $num_rows; $i++) {?>
        <div class="row  align-items-center">
        <?php for($j = 0; $j < $elems_per_row && $num_elems > 0; $j++, $num_elems--) {
              $actual_elem = $i*$elems_per_row + $j; 
              ?>
        @include('partials.auction',['auction'=>$auctions[$actual_elem]])
        <?php } ?>
          <!-- auction -->
        </div>
    <?php } ?>
</div>
</div>

<ul id="pag" class="pagination col-lg-12"></ul>

<!-- pagination -->  

@endsection