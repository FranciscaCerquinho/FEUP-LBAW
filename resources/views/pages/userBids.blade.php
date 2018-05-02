@extends('layouts.app')

@section('content')

<div class="container-fluid" id="newAuctions">
    <h1>My Bids</h1>
    <hr class="style17" style="color:grey;">
<?php
$elems_per_row = 4;
$num_elems = count($auctions);
$num_rows = ceil($num_elems / $elems_per_row);
?>
<div class="new_auctions" @if(count($auctions)==0)) style="padding-top:500px" @endif>
<?php for($i = 0; $i < $num_rows; $i++) {?>
        <div class="row">
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

@endsection