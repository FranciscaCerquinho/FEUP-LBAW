<?php $__env->startSection('title', 'Owner Seach Page'); ?>
<?php $__env->startSection('content'); ?>
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
		<?php
			$elems_per_row = 4;
			$num_elems = count($auctions);
			$num_rows = ceil($num_elems / $elems_per_row);
		?>
		<div class="col-12 searchResults">
		<?php if($num_elems ==1) {?>
  <?php echo $__env->make('partials.auctionsFullSearch',['auction'=>$auctions[0]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php } else{ ?>
<?php for($i = 0; $i < $num_rows; $i++) {?>
      <div class="row">
      <?php for($j = 0; $j < $elems_per_row && $num_elems > 0; $j++, $num_elems--) {
            $actual_elem = $i*$elems_per_row + $j; 
            ?>
      <?php echo $__env->make('partials.auction',['auction'=>$auctions[$actual_elem]], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php } ?>
        <!-- auction -->
      </div>
  <?php }} ?>
		</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>