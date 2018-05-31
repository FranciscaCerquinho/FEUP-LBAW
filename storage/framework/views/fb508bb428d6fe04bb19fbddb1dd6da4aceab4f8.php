<?php $__env->startSection('title', 'Owner Page'); ?>
<?php $__env->startSection('content'); ?>
<div class="contact1">
		<div class="container-contact1">
			<div class="row col-12">
				<div class="col-lg-3" id="profile_pic">
                <?php if($owner->photo=='perfil_blue.png'): ?>
                    <img src="http://placehold.it/300x290" alt="ownerPhoto" class="img-rounded img-responsive img-fluid" />
                <?php else: ?>  
					<?php if(preg_match('/https:\//',$owner->photo, $matches, PREG_OFFSET_CAPTURE)): ?>
						<img src="<?php echo e($owner->photo); ?>" class="img-rounded img-responsive img-fluid" alt="ownerPhoto">
					<?php else: ?>
						<img src="images/<?php echo e($owner->photo); ?>" class="img-rounded img-responsive img-fluid" alt="ownerPhoto">
					<?php endif; ?>
				<?php endif; ?>
				</div>
				<div class="col-lg-5">
					<div class="user_infomation">
						<h4><?php echo e($owner->firstname); ?> <?php echo e($owner->lastname); ?></h4>
						<small>
							<cite title="San Francisco, USA"><?php echo e($owner->country); ?>

								<i class="fas fa-map-marker-alt" style="margin-left:10px;"></i>
							</cite>
						</small>
						<p>
							<i class="far fa-envelope"></i> &nbsp; <?php echo e($owner->email); ?>

						</p>
						<p>
							<i class="fas fa-phone"></i> &nbsp; <?php echo e($owner->contact); ?>

						</p>

						<!-- Split button -->
						<button  data-popup-reportUser-open="popup-1" type="button" id="reportA"><span class="reportUserButton fas fa-bullhorn"></span> Report</button>
						<div class="popup-reportUser" data-popup-reportUser="popup-1" data-id="<?php echo e($owner->id_user); ?>">
							<div class="popup-inner-reportUser" >
								<div class="form-group" id="userForm">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="fas fa-comment-alt" aria-hidden="true"></i>
										</span>
										<input type="text" class="form-control reportUserText" name="reason" placeholder="Reason" />
									</div>
								</div>
								<div class="row" id="reportUserButton">
										<div class="col-6 col-xl-5 col-lg-6 col-sm-6 col-md-8" id="buttonReport">
											<div class="text-center">
												<a role="button" target="_blank" id="btn" class="btn btn-primary btn-lg btn-block">Report</a>
											</div>
										</div>
									</div>
								<a class="popup-close-reportUser" data-popup-close-reportUser="popup-1">X</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-xs-10">
					<form class="contact1-form validate-form" action="<?php echo e(route('emailUser',['email'=>$owner->email])); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<span class="contact1-form-title">
							Text <?php echo e($owner->firstname); ?> <?php echo e($owner->lastname); ?>

						</span>
						<div class="wrap-input1 validate-input" data-validate="Name is required">
							<input class="input1" type="text" name="name" placeholder="Name">
							<span class="shadow-input1"></span>
						</div>

						<div class="wrap-input1 validate-input" data-validate="Valid email is required: ex@abc.xyz">
							<input class="input1" type="text" name="email" placeholder="Email">
							<span class="shadow-input1"></span>
						</div>

						<div class="wrap-input1 validate-input" data-validate="Subject is required">
							<input class="input1" type="text" name="subject" placeholder="Subject">
							<span class="shadow-input1"></span>
						</div>

						<div class="wrap-input1 validate-input" data-validate="Message is required">
							<textarea class="input1" name="message" placeholder="Message"></textarea>
							<span class="shadow-input1"></span>
						</div>

						<div class="container-contact1-form-btn">
							<button class="contact1-form-btn">
								<span >Send Email
									<i class="fas fa-arrow-right"></i>
								</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>