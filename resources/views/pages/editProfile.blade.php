@extends('layouts.app')

@section('content')
<div id="edit_profile">
		<div class="container">
			<h1>Edit Profile</h1>
			<hr class="style17" style="color:grey;">
			<form action="{{ route('editProfile') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
			{{ csrf_field() }}
			<div class="row">
				<!-- left column -->
				<div class="col-md-3 form-group row">
					<div class="text-center">
						@if(Auth::user()->photo=='perfil_blue.png')
						<img src="images/perfil-icon_grey.png" class="avatar img-circle" alt="avatar">
						@endif
						@if(Auth::user()->photo!='perfil_blue.png')
						<img src="images/{{Auth::user()->photo}}" class="avatar img-circle" alt="avatar">
						@endif
						<br>
						<label class="btn btn-file" style="background-color:#437ab2; color:white; margin-top:20px">
							Change Photo
							<input class="form-control" type="file" name="photo" accept="image/*">
						</label>
					</div>
				</div>
				<!-- edit form column -->
				<div class="col-md-9 personal-info">
				<div class="col-md-10">
					@if(isset($alert))
					@if ($alert!="")
					<div class="alert alert-danger alert-dismissable" role="alert">
						<a class="panel-close close" data-dismiss="alert">x</a>
						<i class="fas fa-bell"></i>
						{!!$alert!!}
					</div>
					@endif
					@endif
					@if(isset($success))
					@if ($success!="")
					<div class="alert alert-success alert-dismissable" role="alert">
						<a class="panel-close close" data-dismiss="alert">x</a>
						<i class="far fa-check-circle"></i>
						{!!$success!!}
					</div>
					@endif
					@endif
					@if ($errors->has('firstName'))
						<div class="alert alert-danger alert-dismissable" role="alert">
							<a class="panel-close close" data-dismiss="alert">x</a>
							<i class="far fa-bell"></i>
							{{ $errors->first('firstName') }}
						</div>
					@endif
					@if ($errors->has('lastName'))
						<div class="alert alert-danger alert-dismissable" role="alert">
							<a class="panel-close close" data-dismiss="alert">x</a>
							<i class="far fa-bell"></i>
							{{ $errors->first('lastName') }}
						</div>
					@endif
					@if ($errors->has('contact'))
						<div class="alert alert-danger alert-dismissable" role="alert">
							<a class="panel-close close" data-dismiss="alert">x</a>
							<i class="far fa-bell"></i>
							{{ $errors->first('contact') }}
						</div>
					@endif
					@if ($errors->has('address'))
						<div class="alert alert-danger alert-dismissable" role="alert">
							<a class="panel-close close" data-dismiss="alert">x</a>
							<i class="far fa-bell"></i>
							{{ $errors->first('address') }}
						</div>
					@endif
					@if ($errors->has('country'))
						<div class="alert alert-danger alert-dismissable" role="alert">
							<a class="panel-close close" data-dismiss="alert">x</a>
							<i class="far fa-bell"></i>
							{{ $errors->first('country') }}
						</div>
					@endif
				</div>
						<div class="form-group row">
							<label class="col-lg-2 col-control-label">First name:</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" name="firstName" value="{{Auth::user()->firstname}}" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2 control-label">Last name:</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" name="lastName" value="{{Auth::user()->lastname}}" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2 control-label">Email:</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" name="email" value="{{Auth::user()->email}}"  disabled>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-lg-2 control-label">Contact:</label>
							<div class="col-lg-8">
								<input class="form-control" type="number" name="contact" value="{{Auth::user()->contact}}" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 control-label">Address:</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="address" value="{{Auth::user()->address}}" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 control-label">City,Country:</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="country" value="{{Auth::user()->country}}" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 control-label">Password:</label>
							<div class="col-md-8">
								<input class="form-control" type="password" name="password" value="11111122333" >
							</div>
						</div>
					
						<div class="form-group row">
							<label class="col-md-2 control-label">Confirm password:</label>
							<div class="col-md-8">
								<input class="form-control" type="password" name="confirmPassword" value="11111122333" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-8">
								<input type="submit" class="btn" value="Save Changes" style="background-color:#437ab2; color:white">
								<span></span>
								<input type="reset" class="btn btn-default" value="Cancel">
							</div>
						</div>
				</div>
			</div>
			</form>
		</div>
    </div>
@endsection