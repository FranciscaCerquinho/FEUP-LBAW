<?php $__env->startSection('content'); ?>

<section class="" id="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto container-fluid  text-center">
					<h2 class="section-heading text-white text-center">We've got what you need!</h2>
					<hr class="light my-4">
					<p class="text-faded mb-4" style="font-size:18px">Top Bid is a site designed for online auctions, connecting millions of buyers and sellers around the world. Empowering
						people and creating economic opportunity for all.</p>
					<a style="color:white; font-size:20px;" href="index.html">
						<i class="far fa-hand-point-right"></i> Get Started!</a>
				</div>
			</div>
		</div>
	</section>

	<section id="services">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2 class="section-heading" style="color: #444444;">Services</h2>
					<hr class="style17" style="color:grey;">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 text-center">
					<div class="service-box mt-5 mx-auto">
						<i class="far fa-hand-point-up mb-3 sr-icons" style="font-size:80px;color: #437ab2;"></i>
						<h3 class="mb-3" style="color: #444444;">Make Bid</h3>
						<p class="text-muted mb-0">Make a bid for the product you want to buy.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 text-center">
					<div class="service-box mt-5 mx-auto">
						<i class="fas fa-gavel mb-3 sr-icons" style="font-size:80px;color: #437ab2;"></i>
						<h3 class="mb-3" style="color: #444444;">Add an auction</h3>
						<p class="text-muted mb-0">Add an auction and control that!</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 text-center">
					<div class="service-box mt-5 mx-auto">
						<i class="fas fa-comments mb-3 sr-icons" style="font-size:80px;color: #437ab2;"></i>
						<h3 class="mb-3" style="color: #444444;">Text the sellers</h3>
						<p class="text-muted mb-0">Talk to the sellers.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 text-center">
					<div class="service-box mt-5 mx-auto">
						<i class="fas fa-bullhorn mb-3 sr-icons" style="font-size:80px;color: #437ab2;"></i>
						<h3 class="mb-3" style="color: #444444;">Report an auction</h3>
						<p class="text-muted mb-0">Report an auction that you think used offensive messages or comments.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="contact">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto container-fluid text-center">
					<h2 class="section-heading" style="color: #444444;">Let's Get In Touch!</h2>
					<hr class="style17" style="color:grey;">
					<p class="mb-5" style=" color: #437ab2; font-size:18px">Ready to start? That's great! Give us a call or send us an email if you have any question!</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 ml-auto container-fluid text-center">
					<i class="fa fa-phone fa-3x mb-3 sr-contact mb-3 sr-icons" style="color: #437ab2;"></i>
					<p style="color: #437ab2;">123-456-6789</p>
				</div>
				<div class="col-lg-4 mr-auto container-fluid  text-center">
					<i class="fas fa-at fa-3x mb-3 sr-contact mb-3 sr-icons" style="color: #437ab2;"></i>
					<p>
						<a href="mailto:your-email@your-domain.com" style="color: #437ab2;">topbid@geral.com</a>
					</p>
				</div>
			</div>
		</div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>