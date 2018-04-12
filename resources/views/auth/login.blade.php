@extends('layouts.app')

@section('content')
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
								<form id="login-form" action="{{ route('login') }}" method="post" role="form" style="display: block;">
									{{ csrf_field() }}
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
                                            @if ($errors->has('email'))
                                                <span class="error">
                                                {{ $errors->first('email') }}
                                                </span>
                                            @endif
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
                                            @if ($errors->has('password'))
                                                <span class="error">
                                                {{ $errors->first('password') }}
                                                </span>
                                            @endif
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
								<form id="register-form" action="{{ route('register') }}" method="post" role="form" style="display: none;">
									{{ csrf_field() }}
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
                                    @if ($errors->has('firstName'))
                                        <span class="error">
                                        {{ $errors->first('firstName') }}
                                        </span>
                                    @endif
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
                                    @if ($errors->has('lastName'))
                                        <span class="error">
                                        {{ $errors->first('lastName') }}
                                        </span>
                                    @endif
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-envelope fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="email" id="registerEmail" placeholder="Email" />
											</div>
										</div>
									</div>
                                    @if ($errors->has('registerEmail'))
                                        <span class="error">
                                        {{ $errors->first('registerEmail') }}
                                        </span>
                                    @endif
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
                                    @if ($errors->has('contact'))
                                        <span class="error">
                                        {{ $errors->first('contact') }}
                                        </span>
                                    @endif
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
                                    @if ($errors->has('address'))
                                        <span class="error">
                                        {{ $errors->first('address') }}
                                        </span>
                                    @endif
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
                                    @if ($errors->has('country'))
                                        <span class="error">
                                        {{ $errors->first('country') }}
                                        </span>
                                    @endif
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-lock fa-lg" aria-hidden="true"></i>
												</span>
												<input type="password" class="form-control" name="password" id="registerPassword" placeholder="Password" />
											</div>
										</div>
									</div>
                                    @if ($errors->has('registerPassword'))
                                        <span class="error">
                                        {{ $errors->first('registerPassword') }}
                                        </span>
                                    @endif
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
@endsection
