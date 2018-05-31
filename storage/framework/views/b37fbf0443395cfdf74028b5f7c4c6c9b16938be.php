<?php $__env->startSection('title', 'Administration'); ?>
<?php $__env->startSection('content'); ?>
<!-- Button trigger modal -->
<button id="messageModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<section id="middle">
		<div class="user_report">
			<h2 class="users">Users Reported </h2>
			<hr class="style17" style="color:grey;">
			<div class="row">
				<div class="col-md-2 col-sm-3">
					<p>User</p>
				</div>
				<div class="col-md-2 col-sm-3">
					<p>Reported by</p>
				</div>
				<div class="col-md-4 col-sm-3">
					<p>Reason</p>
				</div>
				<div class="col-md-2 col-sm-3">
					<p>Date</p>
				</div>
				<div class="col-md-1 col-sm-3">
					<p>Action</p>
				</div>
			</div>
			<hr class="style17" style="color:grey;">
		<?php for($j = 0; $j < count($reported_users_Ban); $j++) { ?>
			<?php echo $__env->make('partials.usersReport',['reported_users'=>$reported_users_Ban[$j],'reporting_users'=>$reporting_users_Ban[$j], 'ban' => 1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php } ?>
		<?php for($j = 0; $j < count($reported_users_NotBan); $j++) { ?>
			<?php echo $__env->make('partials.usersReport',['reported_users'=>$reported_users_NotBan[$j],'reporting_users'=>$reporting_users_NotBan[$j], 'ban' => 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php } ?>
		</div>

		<div class="auctions_report" style="margin-top:50px;">
			<h2 class="users">Auctions Reported </h2>
			<hr class="style17" style="color:grey;">
			<div class="row">
				<div class="col-md-2 col-sm-2">
					<p>Auctions</p>
				</div>
				<div class="col-md-2 col-sm-2">
					<p>Reported by</p>
				</div>
				<div class="col-md-4 col-sm-6">
					<p>Reason</p>
				</div>
				<div class="col-md-2 col-sm-1">
					<p>Date</p>
				</div>
				<div class="col-md-1 col-sm-1">
					<p>Action</p>
				</div>
			</div>
			<hr class="style17" style="color:grey;">
			<?php for($j = 0; $j < count($reported_auctions_Ban); $j++) { ?>
				<?php echo $__env->make('partials.auctionsReport',['reported_auctions'=>$reported_auctions_Ban[$j], 'ban' => 1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        	<?php } ?>
			<?php for($j = 0; $j < count($reported_auctions_NotBan); $j++) { ?>
				<?php echo $__env->make('partials.auctionsReport',['reported_auctions'=>$reported_auctions_NotBan[$j], 'ban' => 0], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        	<?php } ?>
		</div>

		<!--<ul id="auctionsPag" style="margin-top:50px" class="pagination col-lg-12"></ul>-->

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app',['type'=>$type], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>