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
  <div class="col-md-4 endAuctionAlert" data-id='{{$endAuctions[$i]->id}}'>
    <div class="alert alert-info alert-dismissable" role="alert">
      <a class="panel-close close" data-dismiss="alert">x</a>
      The Auction {{$endAuctions[$i]->name}} has been sell! Contact the user 
      <input class="btn btn-primary endAuction" type="submit"value="Done">
    </div>
  </div>
<?php } ?>
</div>
@endif
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