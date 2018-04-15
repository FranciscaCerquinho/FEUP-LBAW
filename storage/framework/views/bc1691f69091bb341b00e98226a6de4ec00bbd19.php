<?php $__env->startSection('content'); ?>
<div class="faq">
		<div class="panel-group container-fluid bg-1" id="accordion" style="margin-top:50px;">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
							Top Bid ? What can I use for ?</a>
					</h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse in">
					<div class="panel-body">Top Bid is a site designed for online auctions. An online auction is a service in which auction users or participants
						sell or bid for products or services via the Internet. Virtual auctions facilitate online activities between buyers
						and sellers in different locations or geographical areas. </div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
							How can I add an auction ?</a>
					</h4>
				</div>
				<div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">You can add an auction by clicking on "Add Auction" which is in navbar. Then you just have to fill in the requested
						fields. </div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
							How can I be banned ?</a>
					</h4>
				</div>
				<div id="collapse3" class="panel-collapse collapse">
					<div class="panel-body">The system will ban a user that use offensive messages or comments in auctions and excessive reports.</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
							How can I contact the owner ?</a>
					</h4>
				</div>
				<div id="collapse4" class="panel-collapse collapse">
					<div class="panel-body">Click on the auction and then on the email icon that is in front of the owner's name.</div>
				</div>
			</div>
		</div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>