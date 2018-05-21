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
								<form id="login-form" action="{{ route('login') }}" method="post" style="display: block;">
									{{ csrf_field() }}
                                    <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-envelope fa" aria-hidden="true"></i>
													</span>
													<input type="text" class="form-control" name="email" @if(old('email'))value="{{old('email')}}"@endif placeholder="Enter your Email" />
												</div>
											</div>
									@if ($errors->has('email'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
                                        {{ $errors->first('email') }}
									</div>
                                    @endif
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
									@if ($errors->has('password'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
                                        {{ $errors->first('password') }}
									</div>
                                    @endif
										</div>
										<div class="col-12">
											<div class="form-group text-center" id="rememberMe">
												<a class="recoverPassword" href="{{route('password.reset')}}"> Forgot your password? </a>
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
												<a class='btn btn-danger'>
													<i class="fab fa-google-plus-g"></i>
												</a>
												<a class='btn btn-danger' href="{{ route('login') }}" id="loginGoogle"> Sign in with Google</a>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="{{ route('register') }}" method="post" style="display: none;">
									{{ csrf_field() }}
                                    <div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-user fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="firstName" id="firstName" @if(old('firstName'))value="{{old('firstName')}}"@endif placeholder="First Name" />
											</div>
										</div>
									</div>
									@if ($errors->has('firstName'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
                                        {{ $errors->first('firstName') }}
									</div>
                                    @endif
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-user fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="lastName" id="lastName"  @if(old('lastName'))value="{{old('lastName')}}"@endif placeholder="Last Name" />
											</div>
										</div>
									</div>
                                    @if ($errors->has('lastName'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
                                        {{ $errors->first('lastName') }}
									</div>
                                    @endif
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-envelope fa" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="email"   @if(old('email'))value="{{old('email')}}"@endif placeholder="Email" />
											</div>
										</div>
									</div>
									@if ($errors->has('email'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										{{ $errors->first('email') }}
									</div>
                                    @endif
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-phone" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="contact"  @if(old('contact'))value="{{old('contact')}}"@endif placeholder="Contact" />
											</div>
										</div>
									</div>
									@if ($errors->has('contact'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										{{ $errors->first('contact') }}
									</div>
                                    @endif
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" >
													<i class="fas fa-address-card" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="address" id="address" @if(old('address'))value="{{old('address')}}"@endif placeholder="Address" />
											</div>
										</div>
									</div>
									@if ($errors->has('address'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										{{ $errors->first('address') }}
									</div>
                                    @endif
									<div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" >
													<i class="fas fa-map-marker" aria-hidden="true"></i>
												</span>
												<input type="text" class="form-control" name="country" id="country" @if(old('country'))value="{{old('country')}}"@endif placeholder="City, Country" />
											</div>
										</div>
									</div>
									@if ($errors->has('country'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										{{ $errors->first('country') }}
									</div>
                                    @endif
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
									@if ($errors->has('password'))
									<div class="alert alert-danger alert-dismissable" role="alert">
										<a class="panel-close close" data-dismiss="alert">x</a>
										<i class="far fa-bell"></i>
										{{ $errors->first('password') }}
									</div>
                                    @endif
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
@endsection
