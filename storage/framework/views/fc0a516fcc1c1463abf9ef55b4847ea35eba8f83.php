<?php $__env->startSection('content'); ?>
<div id="loginPage">
		<div class="row">
			<div class="col-lg-6 col-sm-8 col-md-8 offset-lg-3 offset-sm-0 offset-md-2 ">
				<div class="card text-center">
					<div class="card-header">
						<ul class="nav nav-tabs card-header-tabs text-center">
							<li class="nav-item">
								<a class="nav-link active" href="#" id="login-form-link">Login</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" id="register-form-link">Register</a>
							</li>
						</ul>
					</div>
					<div class="card-block">
						<div class="card-body">
							<div class="container-fluid">
								<form id="login-form" action="<?php echo e(route('login')); ?>" method="post" style="display: block;">
									<?php echo e(csrf_field()); ?>

                                    <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-envelope fa" aria-hidden="true"></i>
													</span>
													<input type="text" class="form-control" name="email" <?php if(old('email')): ?>value="<?php echo e(old('email')); ?>"<?php endif; ?> placeholder="Enter your Email" />
												</div>
											</div>
									<?php if($errors->has('email')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
                                        <?php echo e($errors->first('email')); ?>

									</div>
                                    <?php endif; ?>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-lock fa-lg" aria-hidden="true"></i>
													</span>
													<input type="password" class="form-control" name="password"  placeholder="Enter your Password" />
												</div>
											</div>
									<?php if($errors->has('password')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
                                        <?php echo e($errors->first('password')); ?>

									</div>
                                    <?php endif; ?>
										</div>
										<div class="col-12">
											<div class="form-group text-center" id="rememberMe">
												<a class="recoverPassword" href="<?php echo e(route('password.reset')); ?>"> Forgot your password? </a>
											</div>
										</div>
										<div class="col-5 button_login">	
											<div class="form-group">
												<div class="text-center">
													<button type="submit"  class="btn btn-primary btn-lg btn-block login-button">Login</button>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="btn-group">
												<div class="g-signin2" data-onsuccess="onSignIn" ></div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="<?php echo e(route('register')); ?>" method="post" style="display: none;">
									<?php echo e(csrf_field()); ?>

                                    <div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-user fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="firstName" id="firstName" <?php if(old('firstName')): ?>value="<?php echo e(old('firstName')); ?>"<?php endif; ?> placeholder="First Name" />
											</div>
										</div>
									</div>
									<?php if($errors->has('firstName')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
                                        <?php echo e($errors->first('firstName')); ?>

									</div>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-user fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="lastName" id="lastName"  <?php if(old('lastName')): ?>value="<?php echo e(old('lastName')); ?>"<?php endif; ?> placeholder="Last Name" />
											</div>
										</div>
									</div>
                                    <?php if($errors->has('lastName')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
                                        <?php echo e($errors->first('lastName')); ?>

									</div>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-envelope fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="email"   <?php if(old('email')): ?>value="<?php echo e(old('email')); ?>"<?php endif; ?> placeholder="Email" />
											</div>
										</div>
									</div>
									<?php if($errors->has('email')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										<?php echo e($errors->first('email')); ?>

									</div>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-phone" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="contact"  <?php if(old('contact')): ?>value="<?php echo e(old('contact')); ?>"<?php endif; ?> placeholder="Contact" />
											</div>
										</div>
									</div>
									<?php if($errors->has('contact')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										<?php echo e($errors->first('contact')); ?>

									</div>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" >
													<i class="fas fa-address-card" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="address" id="address" <?php if(old('address')): ?>value="<?php echo e(old('address')); ?>"<?php endif; ?> placeholder="Address" />
											</div>
										</div>
									</div>
									<?php if($errors->has('address')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										<?php echo e($errors->first('address')); ?>

									</div>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" >
													<i class="fas fa-map-marker" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="country" id="country" <?php if(old('country')): ?>value="<?php echo e(old('country')); ?>"<?php endif; ?> placeholder="City, Country" />
											</div>
										</div>
									</div>
									<?php if($errors->has('country')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										<?php echo e($errors->first('country')); ?>

									</div>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" >
													<i class="fa fa-lock fa-lg" aria-hidden="true"></i>
												</span>
												<input type="password" class="form-control" name="password"  placeholder="Password" />
											</div>
										</div>
									</div>
									<?php if($errors->has('password')): ?>
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										<?php echo e($errors->first('password')); ?>

									</div>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" >
													<i class="fa fa-lock fa-lg" aria-hidden="true"></i>
												</span>
												<input type="password" class="form-control" name="password_confirmation" id="confirm" placeholder="Confirm your Password" />
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-lg-5 " style="width: 150px" >
												<div class="text-center button_login">
													<button  type="submit"  class="btn btn-primary btn-lg btn-block login-button">Register</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>