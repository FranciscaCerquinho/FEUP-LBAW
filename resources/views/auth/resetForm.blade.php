@extends('layouts.app')

@section('content')
<div id="loginPage">
		<div class="row">
			<div class="col-lg-6 col-sm-8 col-md-8 offset-lg-3 offset-sm-0 offset-md-2 ">
				<div class="card text-center">
					<div class="card-header">
						<ul class="nav nav-tabs card-header-tabs text-center">
							<li class="nav-item">
								<a class="nav-link active" href="#" id="login-form-link">Reset Your Password</a>
							</li>
						</ul>
					</div>
					<div class="card-block">
						<div class="card-body">
							<div class="container-fluid">
								<form id="resetPassword-form" action="{{ route('resetPassword') }}" method="post" role="form" style="display: block;">
									{{ csrf_field() }}
									<input type="hidden" name="token" value="{{Request::segment(3)}}"></input>
                                    <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<div class="input-group-prepend">
													<span class="input-group-text">
														<i class="fa fa-envelope fa" aria-hidden="true"></i>
													</span>
													<input type="text" class="form-control" name="email" id="email" @if(old('email'))value="{{old('email')}}"@endif placeholder="Enter your Email" />
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
										</div>
                                    <div class="form-group">
										<div class="cols-sm-10">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">
													<i class="fa fa-lock fa-lg" aria-hidden="true"></i>
												</span>
												<input type="password" class="form-control" name="password" id="password" placeholder="Password" />
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
										<div class="col-5" id="button_login">	
											<div class="form-group">
												<div class="text-center">
													<button target="_blank" type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button">Continue</button>
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
