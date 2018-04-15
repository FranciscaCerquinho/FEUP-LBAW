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
								<form id="login-form" action="<?php echo e(route('login')); ?>" method="post" role="form" style="display: block;">
									<?php echo e(csrf_field()); ?>

                                    <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-envelope fa" aria-hidden="true"></i>
													</span>
													<input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" />
												</div>
											</div>
                                            <?php if($errors->has('email')): ?>
                                                <span class="error">
                                                <?php echo e($errors->first('email')); ?>

                                                </span>
                                            <?php endif; ?>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-lock fa-lg" aria-hidden="true"></i>
													</span>
													<input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
												</div>
											</div>
                                            <?php if($errors->has('password')): ?>
                                                <span class="error">
                                                <?php echo e($errors->first('password')); ?>

                                                </span>
                                            <?php endif; ?>
										</div>
										<div class="col-12">
											<div class="form-group text-center" id="rememberMe">
												<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
												<label for="remember"> Remember Me</label>
											</div>
										</div>
										<div class="col-5" id="button_login">	
											<div class="form-group">
												<div class="text-center">
													<button target="_blank" type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button">Login</button>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="btn-group">
												<a class='btn btn-danger'>
													<i class="fab fa-google-plus-g"></i>
												</a>
												<a class='btn btn-danger' href='#' id="loginGoogle"> Sign in with Google</a>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="<?php echo e(route('register')); ?>" method="post" role="form" style="display: none;">
									<?php echo e(csrf_field()); ?>

                                    <div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-user fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" />
											</div>
										</div>
									</div>
                                    <?php if($errors->has('firstName')): ?>
                                        <span class="error">
                                        <?php echo e($errors->first('firstName')); ?>

                                        </span>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-user fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" />
											</div>
										</div>
									</div>
                                    <?php if($errors->has('lastName')): ?>
                                        <span class="error">
                                        <?php echo e($errors->first('lastName')); ?>

                                        </span>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-envelope fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="email" id="email" placeholder="Email" />
											</div>
										</div>
									</div>
                                    <?php if($errors->has('email')): ?>
                                        <span class="error">
                                        <?php echo e($errors->first('email')); ?>

                                        </span>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fas fa-phone" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="contact" id="email" placeholder="Contact" />
											</div>
										</div>
									</div>
                                    <?php if($errors->has('contact')): ?>
                                        <span class="error">
                                        <?php echo e($errors->first('contact')); ?>

                                        </span>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fas fa-address-card" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="address" id="address" placeholder="Address" />
											</div>
										</div>
									</div>
                                    <?php if($errors->has('address')): ?>
                                        <span class="error">
                                        <?php echo e($errors->first('address')); ?>

                                        </span>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fas fa-map-marker" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="country" id="country" placeholder="City, Country" />
											</div>
										</div>
									</div>
                                    <?php if($errors->has('country')): ?>
                                        <span class="error">
                                        <?php echo e($errors->first('country')); ?>

                                        </span>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-lock fa-lg" aria-hidden="true"></i>
												</span>
												<input type="password" class="form-control" name="password" id="password" placeholder="Password" />
											</div>
										</div>
									</div>
                                    <?php if($errors->has('password')): ?>
                                        <span class="error">
                                        <?php echo e($errors->first('password')); ?>

                                        </span>
                                    <?php endif; ?>
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-lock fa-lg" aria-hidden="true"></i>
												</span>
												<input type="password" class="form-control" name="password_confirmation" id="confirm" placeholder="Confirm your Password" />
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-lg-5 " style="width: 150px" id="button_login">
												<div class="text-center">
													<button target="_blank" type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button">Register</button>
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