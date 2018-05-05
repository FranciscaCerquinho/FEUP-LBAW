@extends('layouts.app',['type'=>$type])

@section('content')
<div class="container-fluid" id="newAuctions">
<?php
$elems_per_row = 4;
$num_elems = count($auctions);
$num_rows = ceil($num_elems / $elems_per_row);
?>
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