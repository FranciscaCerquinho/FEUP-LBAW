<?php $__env->startSection('title', 'Contact Us'); ?>
<?php $__env->startSection('content'); ?>
<div class="contact1">
		<div class="container-contact1">
			<div class="row">
				<div class="col-10">
					<div class="container contact text-center">
						<h2 class="section-heading text-center" style="color:#437ab2;">Contact Us</h2>
						<hr class="style17" style="color:grey;">
						<div class="row">
							<div class="col">
								<i class="fa fa-phone fa-3x mb-3 sr-contact mb-3 sr-icons" style="color: #437ab2;"></i>
								<p style="color: #437ab2;">123-456-6789</p>
							</div>
							<div class="col">
								<i class="fas fa-at fa-3x mb-3 sr-contact mb-3 sr-icons" style="color: #437ab2;"></i>
								<p>
									<a href="mailto:your-email@your-domain.com" style="color: #437ab2;">topbid@geral.com</a>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-2 col-xs-10">
					<form class="contact1-form validate-form" action="<?php echo e(route('emailUs')); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<span class="contact1-form-title">
							Get in touch
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
								<span>Send Email
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